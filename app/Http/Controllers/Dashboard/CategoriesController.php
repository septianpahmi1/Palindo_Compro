<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $title = 'Categories';
        $data = categories::orderBy('created_at', 'desc')->get();
        return view('dashboard.categories.index', compact('title', 'data'));
    }

    public function delete($id)
    {
        $data = categories::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Category berhasil dihapus');
    }

    public function post(Request $request)
    {
        $cost = preg_replace('/\D/', '', $request->cost);
        $benefit = preg_replace('/\D/', '', $request->benefit);

        $request->merge([
            'cost' => $cost,
            'benefit' => $benefit
        ]);
        $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric|min:1',
            'benefit' => 'nullable|numeric|min:0'
        ]);
        $cost = $request->cost;
        $benefit = $request->benefit;
        $totalAll = $cost + $benefit;
        categories::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'benefit' => $request->benefit,
            'total' => $totalAll
        ]);

        return redirect()->back()->with('success', 'Category berhasil dibuat');
    }

    public function update($id, Request $request)
    {

        $cost = preg_replace('/\D/', '', $request->cost);
        $benefit = preg_replace('/\D/', '', $request->benefit);

        $request->merge([
            'cost' => $cost,
            'benefit' => $benefit
        ]);

        $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric|min:1',
            'benefit' => 'nullable|numeric|min:0'
        ]);
        $cost = $request->cost;
        $benefit = $request->benefit;
        $totalAll = $cost + $benefit;

        $data = categories::find($id);
        $data->name = $request->name;
        $data->cost = $request->cost;
        $data->benefit = $request->benefit;
        $data->total = $totalAll;
        $data->save();
        return redirect()->back()->with('success', 'Category berhasil diubah');
    }
}
