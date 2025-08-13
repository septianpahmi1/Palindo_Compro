<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Journal;
use App\Models\Receipt;
use App\Models\Estimation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    public function index()
    {
        $title = "Receipt";
        $data = Receipt::all();
        $estimation = Estimation::all();
        return view('dashboard.receipt.index', compact('title', 'data', 'estimation'));
    }

    public function delete($id)
    {
        $data = Receipt::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data behasil dihapus');
    }

    public function post(Request $request)
    {
        $total = preg_replace('/\D/', '', $request->total);
        $request->merge([
            'total' => $total,
        ]);
        $request->validate([
            'date' => 'required|date',
            'total' => 'required|numeric|min:1',
            'estimation_id' => 'required|exists:estimations,id'
        ]);
        $estimation = Estimation::findOrFail($request->estimation_id);
        $noAccount = $estimation->no_account;

        $date = Carbon::parse($request->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $transactionCount = Receipt::where('estimation_id', $request->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $serial = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        $generatedNumber = "{$noAccount}/PALINDO/RECEIPT/{$month}/{$year}/{$serial}";
        Receipt::create([
            'estimation_id' => $request->estimation_id,
            'number' => $generatedNumber,
            'date' => $request->date,
            'total' => $request->total,
            'description' => $request->description,
        ]);

        Journal::create([
            'estimation_id' => $request->estimation_id,
            'number' => $generatedNumber,
            'date' => $request->date,
            'total' => $request->total,
            'title' => $request->description,
        ]);

        $estimation = Estimation::find($request->estimation_id);
        $estimation->end_balance += $request->total;
        $estimation->save();

        return redirect()->back()->with('success', 'Data behasil dibuat');
    }
}
