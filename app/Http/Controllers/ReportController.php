<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Journal;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\Estimation;
use App\Models\PurchaseInvoice;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $title = "Report";
        return view('dashboard.reports.index', compact('title'));
    }

    public function generalJournal()
    {
        $title = "Report";
        return view('dashboard.reports.journal', compact('title'));
    }
    public function salesReport()
    {
        $title = "Report";
        return view('dashboard.reports.sales', compact('title'));
    }
    public function purchaseReport()
    {
        $title = "Report";
        return view('dashboard.reports.purchase', compact('title'));
    }

    public function getData(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $month = Carbon::createFromFormat('Y-m', $request->month)->month;
        $year  = Carbon::createFromFormat('Y-m', $request->month)->year;

        $periodStart = Carbon::createFromDate($year, $month, 1);
        $periodEnd   = $periodStart->copy()->endOfMonth();

        // Semua penerimaan bulan ini
        $accounts = Estimation::all()->keyBy('no_account');

        // Ambil transaksi bulan ini (contoh dari tabel 'journals')
        $transactions = Journal::with('estimation')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $revenues = [];
        $cogs = [];
        $operationalExpenses = [];
        $nonOperatingIncome = [];
        $nonOperatingExpenses = [];
        $prefixesCogs = ['11031', '11032', '12001', '21011', '21012', '500'];
        foreach ($transactions as $trx) {
            if (!$trx->estimation) continue;

            $amount = $trx->total; // langsung ambil total

            if (str_starts_with($trx->estimation->no_account, '300')) {
                $revenues[] = ['name' => $trx->estimation->title, 'amount' => $amount];
            } elseif (str_starts_with($trx->estimation->no_account, '400')) {
                $cogs[] = ['name' => $trx->estimation->title, 'amount' => $amount];
            } elseif (collect($prefixesCogs)->contains(fn($p) => str_starts_with($trx->estimation->no_account, $p))) {
                $operationalExpenses[] = ['name' => $trx->estimation->title, 'amount' => $amount];
            } elseif (str_starts_with($trx->estimation->no_account, '600')) {
                $nonOperatingIncome[] = ['name' => $trx->estimation->title, 'amount' => $amount];
            } elseif (str_starts_with($trx->estimation->no_account, '700')) {
                $nonOperatingExpenses[] = ['name' => $trx->estimation->title, 'amount' => $amount];
            }
        }

        // Hitung total
        $totalRevenues = array_sum(array_column($revenues, 'amount'));
        $totalCogs = array_sum(array_column($cogs, 'amount'));
        $grossProfit = $totalRevenues - $totalCogs;

        $totalOperational = array_sum(array_column($operationalExpenses, 'amount'));
        $operatingIncome = $grossProfit - $totalOperational;

        $totalNonOpIncome = array_sum(array_column($nonOperatingIncome, 'amount'));
        $totalNonOpExpense = array_sum(array_column($nonOperatingExpenses, 'amount'));
        $totalNonOp = $totalNonOpIncome - $totalNonOpExpense;

        $netProfit = $operatingIncome + $totalNonOp;

        return view('dashboard.reports.profit_loss', compact(
            'revenues',
            'cogs',
            'operationalExpenses',
            'nonOperatingIncome',
            'nonOperatingExpenses',
            'totalRevenues',
            'totalCogs',
            'grossProfit',
            'totalOperational',
            'operatingIncome',
            'totalNonOpIncome',
            'totalNonOpExpense',
            'totalNonOp',
            'netProfit',
            'month',
            'year',
            'periodStart',
            'periodEnd',
        ));
    }

    public function journalBymonth(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $month = Carbon::createFromFormat('Y-m', $request->month)->month;
        $year  = Carbon::createFromFormat('Y-m', $request->month)->year;

        $periodStart = Carbon::createFromDate($year, $month, 1);
        $periodEnd   = $periodStart->copy()->endOfMonth();

        // Ambil data jurnal
        $journals = Journal::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get()
            ->map(function ($item) {
                $item->type = $this->mapTransactionType($item->number);
                return $item;
            });

        return view('dashboard.reports.report-journal', compact('journals', 'periodStart', 'periodEnd'));
    }

    private function mapTransactionType($number)
    {
        if (str_contains($number, '/PALINDO/LOAD/')) return 'Pencatatan Beban';
        if (str_contains($number, '/PALINDO/PAY/')) return 'Pembayaran';
        if (str_contains($number, '/PALINDO/FPR/')) return 'Faktur Pembelian';
        if (str_contains($number, '/PALINDO/RECEIPT/')) return 'Penerimaan';
        if (str_contains($number, '/PALINDO/SALARY/')) return 'Pembayaran';
        if (str_contains($number, '/PALINDO/FSL/')) return 'Faktur Penjualan';
        return 'Lainnya';
    }

    public function salesBymonth(Request $request)
    {

        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $month = Carbon::createFromFormat('Y-m', $request->month)->month;
        $year  = Carbon::createFromFormat('Y-m', $request->month)->year;

        $periodStart = Carbon::createFromDate($year, $month, 1);
        $periodEnd   = $periodStart->copy()->endOfMonth();

        // Ambil data jurnal
        $sales = SalesInvoice::with('category')->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('status', 'Success')
            ->get();

        // Kelompokkan per item
        $grouped = $sales->groupBy('category_id')->map(function ($items) {
            return [
                'items' => $items,
                'total_quantity' => $items->sum('quantity'),
                'total_amount'   => $items->sum('total'),
                'product_name'   => $items->first()->category->name ?? 'Tanpa Nama'
            ];
        });

        return view('dashboard.reports.sales-report', [
            'salesData'  => $grouped,
            'periodStart'  => $periodStart,
            'periodEnd'    => $periodEnd,
            'companyName' => 'PT. Ghaleb Palindo International',
            'branch'     => '[Semua Cabang]'
        ]);
    }
    public function purchaseBymonth(Request $request)
    {

        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $month = Carbon::createFromFormat('Y-m', $request->month)->month;
        $year  = Carbon::createFromFormat('Y-m', $request->month)->year;

        $periodStart = Carbon::createFromDate($year, $month, 1);
        $periodEnd   = $periodStart->copy()->endOfMonth();

        // Ambil data jurnal
        $sales = PurchaseInvoice::with('category')->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('status', 'Success')
            ->get();

        // Kelompokkan per item
        $grouped = $sales->groupBy('category_id')->map(function ($items) {
            return [
                'items' => $items,
                'total_quantity' => $items->sum('quantity'),
                'total_amount'   => $items->sum('total'),
                'product_name'   => $items->first()->category->name ?? 'Tanpa Nama'
            ];
        });

        return view('dashboard.reports.purchase-report', [
            'salesData'  => $grouped,
            'periodStart'  => $periodStart,
            'periodEnd'    => $periodEnd,
            'companyName' => 'PT. Ghaleb Palindo International',
            'branch'     => '[Semua Cabang]'
        ]);
    }
}
