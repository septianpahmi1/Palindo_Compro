<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $title = 'Employee';

        $data = Employee::all();
        return view('dashboard.employee.index', compact('title', 'data'));
    }

    public function delete($id)
    {

        $data = Employee::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function post(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'required|string',
            'nik' => 'required|numeric|min:1',
            'position' => 'required|string',
            'join_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('file/employee'), $fileName);
        }

        Employee::create([
            'image' => $fileName,
            'name' => $request->name,
            'nik' => $request->nik,
            'position' => $request->position,
            'join_date' => $request->join_date,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Dibuat');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'required|string',
            'nik' => 'required|numeric|min:1',
            'position' => 'required|string',
            'join_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('file/employee'), $fileName);
        }
        $data = Employee::find($id);
        $data->image = $fileName;
        $data->name = $request->name;
        $data->nik = $request->nik;
        $data->position = $request->position;
        $data->join_date = $request->join_date;
        $data->save();
        return redirect()->back()->with('success', 'Data Berhasil Diperbarui');
    }
}
