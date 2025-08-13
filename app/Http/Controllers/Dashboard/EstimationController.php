<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Estimation;
use Illuminate\Http\Request;

class EstimationController extends Controller
{
    public function index()
    {
        $title = 'Estimation';

        $data = Estimation::all();
        return view('dashboard.estimation.index', compact('title', 'data'));
    }

    public function delete($id)
    {

        $data = Estimation::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function post(Request $request)
    {
        $balance = preg_replace('/\D/', '', $request->balance);
        $request->merge([
            'balance' => $balance,
        ]);
        $request->validate([
            'title' => 'required|string',
            'no_account' => 'required|unique:estimations,no_account',
            'balance' => 'required|numeric|min:1',
            'end_balance' => 'numeric|min:1',
        ]);
        $exist = Estimation::where('no_account', $request->no_account)->exists();
        if ($exist) {
            return redirect()->back()->with('error', 'the account number is already registered');
        }
        Estimation::create([
            'title' => $request->title,
            'no_account' => $request->no_account,
            'balance' => $request->balance,
            'end_balance' => $request->balance,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Dibuat');
    }

    public function update($id, Request $request)
    {
        $balance = preg_replace('/\D/', '', $request->balance);
        $request->merge([
            'balance' => $balance,
        ]);
        $request->validate([
            'title' => 'required|string',
            'no_account' => 'required|numeric|min:1',
            'balance' => 'required|numeric|min:1',
        ]);
        $existing = Estimation::where('no_account', $request->no_account)
            ->orderByDesc('id')
            ->first();

        $balance = (float) $request->balance;
        $endBalance = $existing ? $existing->end_balance + $balance : $balance;
        $data = Estimation::find($id);
        $data->title = $request->title;
        $data->no_account = $request->no_account;
        $data->balance = $balance;
        $data->end_balance = $endBalance;
        $data->save();

        return redirect()->back()->with('success', 'Data Berhasil Diperbarui');
    }
}
