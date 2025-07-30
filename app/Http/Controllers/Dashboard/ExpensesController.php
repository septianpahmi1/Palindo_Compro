<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Spending;
use Illuminate\Http\Request;
use App\Models\SpendingStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    public function index()
    {
        $title = "Daily Expenses";
        $user = Auth::user();

        if ($user->role === 'super admin') {
            // Tampilkan semua data
            $data = SpendingStatus::orderBy('created_at', 'desc')->get();
        } else {
            // Hanya tampilkan data milik user yang sedang login
            $data = SpendingStatus::with('spending')
                ->whereHas('spending', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('dashboard.expenses.index', compact('title', 'data'));
    }

    public function post(Request $request)
    {
        $price = preg_replace('/\D/', '', $request->price);
        $request->merge([
            'price' => $price,
        ]);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('file/invoice'), $fileName);
        }
        $quantity = $request->quantity;
        $price = $request->price;
        $totalCount = $price * $quantity;
        $data = Spending::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'image' => $fileName,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $totalCount,
            'status' => $request->status
        ]);

        SpendingStatus::create([
            'spending_id' => $data->id,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Dibuat');
    }

    public function update($id, Request $request)
    {
        $data = SpendingStatus::find($id);
        $data->status = $request->status;
        $data->note = $request->note;
        if (!$data->status) {
            return redirect()->back()->with('error', 'Status tidak boleh kosong');
        }
        $data->save();
        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $data = SpendingStatus::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $spending = Spending::find($data->spending_id);

        if ($spending) {
            $spending->delete();
        }

        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
