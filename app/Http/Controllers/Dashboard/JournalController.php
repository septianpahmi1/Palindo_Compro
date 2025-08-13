<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Journal;
use App\Models\Estimation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JournalController extends Controller
{
    public function index()
    {
        $title = 'General Journal';

        $data = Journal::all();
        $estimation = Estimation::all();
        return view('dashboard.journal.index', compact('title', 'data', 'estimation'));
    }
    public function delete($id)
    {
        $data = Journal::find($id);
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
            'title' => 'required|string',
            'date' => 'required|date',
            'total' => 'required|numeric|min:1',
            'estimation_id' => 'required|exists:estimations,id'
        ]);
        $estimation = Estimation::findOrFail($request->estimation_id);
        $noAccount = $estimation->no_account;

        $date = Carbon::parse($request->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $transactionCount = Journal::where('estimation_id', $request->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $serial = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        $generatedNumber = "{$noAccount}/PALINDO/JOURNAL/{$month}/{$year}/{$serial}";
        Journal::create([
            'estimation_id' => $request->estimation_id,
            'number' => $generatedNumber,
            // 'transaction_number' => $request->transaction_number,
            'date' => $request->date,
            'total' => $request->total,
            'title' => $request->title,
        ]);

        $estimation = Estimation::find($request->estimation_id);
        $estimation->end_balance -= $request->total;
        $estimation->save();

        return redirect()->back()->with('success', 'Data behasil dibuat');
    }
}
