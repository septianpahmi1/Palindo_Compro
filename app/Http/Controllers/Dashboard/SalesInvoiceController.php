<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\categories;
use App\Models\Estimation;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\Receipt;

class SalesInvoiceController extends Controller
{
    public function index()
    {
        $title = "Sales Invoice";
        $data = SalesInvoice::all();
        $customer = Customer::all();
        $category = categories::all();
        $estimation = Estimation::all();
        return view('dashboard.sales.index', compact('title', 'data', 'customer', 'category', 'estimation'));
    }

    public function delete($id)
    {
        $data = SalesInvoice::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data behasil dihapus');
    }

    public function post(Request $request)
    {
        $price = preg_replace('/\D/', '', $request->price);
        $discount = preg_replace('/\D/', '', $request->discount);
        $total = preg_replace('/\D/', '', $request->total);
        $request->merge([
            'price' => $price,
            'discount' => $discount,
            'total' => $total,
        ]);
        $request->validate([
            'date' => 'required|date',
            'price' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'customer_id' => 'required|exists:customers,id',
            'estimation_id' => 'required|exists:estimations,id'
        ]);
        $estimation = Estimation::findOrFail($request->estimation_id);
        $noAccount = $estimation->no_account;

        $date = Carbon::parse($request->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $transactionCount = SalesInvoice::where('estimation_id', $request->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $serial = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        $generatedNumber = "{$noAccount}/PALINDO/FSL/{$month}/{$year}/{$serial}";
        SalesInvoice::create([
            'customer_id' => $request->customer_id,
            'category_id' => $request->category_id,
            'estimation_id' => $request->estimation_id,
            'number' => $generatedNumber,
            'date' => $request->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'discount' => $request->discount,
            'total' => $request->total,
            'ket' => $request->ket,
            'status' => "Pending",
        ]);

        return redirect()->back()->with('success', 'Data behasil dibuat');
    }

    public function status($id)
    {
        $data = SalesInvoice::find($id);

        $estimation = Estimation::findOrFail($data->estimation_id);
        $noAccount = $estimation->no_account;

        $date = Carbon::parse($data->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $transactionCount = Receipt::where('estimation_id', $data->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $serial = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        $generatedNumber = "{$noAccount}/PALINDO/FSL/{$month}/{$year}/{$serial}";

        Receipt::create([
            'estimation_id' => $data->estimation_id,
            'number' => $generatedNumber,
            'date' => $data->date,
            'total' => $data->total,
            'description' => $data->ket,
        ]);

        Journal::create([
            'estimation_id' => $data->estimation_id,
            'number' => $generatedNumber,
            'date' => $data->date,
            'total' => $data->total,
            'title' => $data->ket,
        ]);

        $estimation = Estimation::find($data->estimation_id);
        $estimation->end_balance += $data->total;
        $estimation->save();

        $data->status = "Success";
        $data->save();
        return redirect()->back()->with('success', 'Data behasil ubah.');
    }

    protected function invoice($year, $id)
    {
        $data = SalesInvoice::where('id', $id)->first();
        $date = Carbon::parse($data->date);
        $month = $date->format('m');
        $year = $date->format('Y');
        $transactionCount = SalesInvoice::where('estimation_id', $data->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;
        $idPadded = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        return "{$idPadded}/SL/{$year}";
    }
    public function quotation($id)
    {
        $data = SalesInvoice::with(['customer', 'category'])->findOrFail($id);
        $year = optional($data->date)->format('Y') ?? now('Asia/Jakarta')->year;

        $invoiceNumber = $this->invoice($year, $data->id);

        return view('dashboard.sales.invoice', compact('data', 'invoiceNumber'));
    }
}
