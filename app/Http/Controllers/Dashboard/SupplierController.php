<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        $title = 'Supplier';

        $data = Supplier::all();
        return view('dashboard.supplier.index', compact('title', 'data'));
    }

    public function delete($id)
    {

        $data = Supplier::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function post(Request $request)
    {
        $request->validate([
            'position' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|numeric|min:10',
            'phone_business' => 'nullable|numeric|min:10',
            'whatsapp' => 'nullable|numeric|min:10',
            'address' => 'nullable|string',
            'website' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Supplier::create([
            'position' => $request->position,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_business' => $request->phone_business,
            'whatsapp' => $request->whatsapp,
            'address' => $request->address,
            'website' => $request->website,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Dibuat');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'position' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|numeric|min:10',
            'phone_business' => 'nullable|numeric|min:10',
            'whatsapp' => 'nullable|numeric|min:10',
            'address' => 'nullable|string',
            'website' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $data = Supplier::find($id);
        $data->position = $request->position;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->phone_business = $request->phone_business;
        $data->whatsapp = $request->whatsapp;
        $data->address = $request->address;
        $data->website = $request->website;
        $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Data Berhasil Dibuat');
    }
}
