<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $title = "Task Report";

        $data = Task::orderBy('created_at', 'desc')->get();

        return view('dashboard.task.index', compact('title', 'data'));
    }

    public function delete($id)
    {
        $data = Task::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $data->delete;
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function post(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string',
            'start_at' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('file/task'), $fileName);
        }

        Task::create([
            'user_id' => Auth::user()->id,
            'image' => $fileName,
            'title' => $request->title,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambah');
    }

    public function filterByMonth(Request $request)
    {
        $month = $request->month; // format: YYYY-MM atau null

        $data = Task::with('user')
            ->when($month, function ($query) use ($month) {
                // filter hanya kalau month ada
                $query->whereMonth('start_at', substr($month, 5, 2))
                    ->whereYear('start_at', substr($month, 0, 4));
            })
            ->get();

        return response()->json([
            'html' => view('dashboard.task.tabel', compact('data'))->render()
        ]);
    }
}
