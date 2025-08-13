<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Burden;
use App\Models\Journal;
use App\Models\Payment;
use App\Models\Estimation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BurdenController extends Controller
{
    public function index()
    {
        $title = "Load Record";
        $data = Burden::all();
        $estimation = Estimation::all();
        return view('dashboard.burden.index', compact('title', 'data', 'estimation'));
    }

    public function delete($id)
    {
        $data = Burden::find($id);
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
            'date_expired' => 'required|date',
            'total' => 'required|numeric|min:1',
            'estimation_id' => 'required|exists:estimations,id'
        ]);
        $estimation = Estimation::findOrFail($request->estimation_id);
        $noAccount = $estimation->no_account;

        $date = Carbon::parse($request->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $transactionCount = Burden::where('estimation_id', $request->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $serial = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        $generatedNumber = "{$noAccount}/PALINDO/LOAD/{$month}/{$year}/{$serial}";
        Burden::create([
            'estimation_id' => $request->estimation_id,
            'number' => $generatedNumber,
            'date' => $request->date,
            'date_expired' => $request->date_expired,
            'total' => $request->total,
            'description' => $request->description,
            'status' => "Pending",
        ]);

        return redirect()->back()->with('success', 'Data behasil dibuat');
    }

    public function status($id)
    {
        $data = Burden::find($id);

        $estimation = Estimation::findOrFail($data->estimation_id);
        $noAccount = $estimation->no_account;

        $date = Carbon::parse($data->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $transactionCount = Payment::where('estimation_id', $data->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $serial = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        $generatedNumber = "{$noAccount}/PALINDO/LOAD/{$month}/{$year}/{$serial}";

        Payment::create([
            'estimation_id' => $data->estimation_id,
            'number' => $generatedNumber,
            'date' => $data->date,
            'total' => $data->total,
            'description' => $data->description,
        ]);

        Journal::create([
            'estimation_id' => $data->estimation_id,
            'number' => $generatedNumber,
            'date' => $data->date,
            'total' => $data->total,
            'title' => $data->description,
        ]);

        $estimation = Estimation::find($data->estimation_id);
        $estimation->end_balance -= $data->total;
        $estimation->save();

        $data->status = "Success";
        $data->save();
        return redirect()->back()->with('success', 'Data behasil ubah.');
    }
}
