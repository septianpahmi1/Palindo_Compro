<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\SubmissionStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $title = "Submission";
        $data = SubmissionStatus::orderBy('created_at', 'desc')->get();
        return view('dashboard.submission.index', compact('title', 'data'));
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
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('file/submission'), $fileName);
        }

        $quantity = $request->quantity;
        $price = $request->price;
        $totalCount = $price * $quantity;
        $data = Submission::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'image' => $fileName,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $totalCount,
            'importance' => $request->importance,
            'description' => $request->description
        ]);

        SubmissionStatus::create([
            'submission_id' => $data->id,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Dibuat');
    }

    public function update($id, Request $request)
    {
        $data = SubmissionStatus::find($id);
        $data->status = $request->status;
        $data->note = $request->note;
        $data->save();
        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {

        $data = SubmissionStatus::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $submission = Submission::find($data->submission_id);

        if ($submission) {
            $submission->delete();
        }

        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
