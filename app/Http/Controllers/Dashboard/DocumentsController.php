<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Documents;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\categories;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function index()
    {
        $title = "Document";
        $data = DocumentStatus::orderBy('created_at', 'desc')->get();
        $category = categories::all();
        return view('dashboard.document.index', compact('title', 'data', 'category'));
    }

    public function delete($id)
    {
        $data = DocumentStatus::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $document_id = Documents::find($data->document_id_id);

        if ($document_id) {
            $document_id->delete();
        }

        $data->delete();
        return redirect('document')->with('success', 'Document berhasil dihapus.');
    }


    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'nation' => 'required|string|max:100',
        ]);
        $prefix = 'ALH2025';
        $random = strtoupper(Str::random(3)) . rand(100, 999);
        $generateRegistrationId = $prefix . $random;

        $document = Documents::create([
            'user_id' => Auth::user()->id,
            'registration_id' => $generateRegistrationId,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email, //nullable
            'address' => $request->address, //nullable
            'nation' => $request->nation,
        ]);

        DocumentStatus::create([
            'document_id' => $document->id,
            'category_id' => $request->category_id,
            'status' => 'Submitted',
            'file' => null,
        ]);

        return redirect('document')->with('success', 'Dokumen Berhasil ditambah.');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:2048',
            ],
            'status' => 'required|string',
        ]);

        $data = DocumentStatus::findOrFail($id);
        $data->status = $request->status;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('file/documents'), $fileName);
            $data->file = $fileName;
        }

        $data->save();

        return redirect('document')->with('success', 'Document berhasil diupdate.');
    }
}
