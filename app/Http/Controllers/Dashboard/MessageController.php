<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $title = "Consultation";
        $data = Message::latest()->paginate(20);
        $query = $request->input('q');

        $data = Message::when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
                ->orWhere('subject', 'like', "%{$query}%")
                ->orWhere('message', 'like', "%{$query}%");
        })->orderBy('created_at', 'desc')->paginate(50);

        if ($request->ajax()) {
            return view('dashboard.message.table', compact('title', 'data'))->render();
        }
        return view('dashboard.message.index', compact('title', 'data'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $data = Message::where('name', 'like', '%' . $query . '%')
            ->orWhere('subject', 'like', '%' . $query . '%')
            ->orWhere('message', 'like', '%' . $query . '%')
            ->paginate(50);

        return view('dashboard.message.index', compact('data'));
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false], 400);
        }

        Message::whereIn('id', $ids)->delete();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Message::where('id', $id)->delete();
        return redirect('/consultation')->with('success', 'Konsultasi berhasil dihapus.');
    }

    public function detail($id)
    {
        $title = "Read Consultation";
        $data = Message::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'ID tidak ditemukan');
        }
        return view('dashboard.message.detail', compact('title', 'data'));
    }
}
