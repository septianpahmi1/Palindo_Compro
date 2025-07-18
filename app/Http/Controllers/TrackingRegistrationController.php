<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;

class TrackingRegistrationController extends Controller
{
    public function track(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|string'
        ]);

        $document = Documents::with('statuses')->where('registration_id', $request->registration_id)->first();

        if (!$document) {
            return response()->json(['status' => false, 'message' => 'Document not found']);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'document_type' => $document->document_type,
                'latest_status' => $document->statuses->first()->status ?? 'Submitted',
                'file' => $document->statuses->first()->file ?? null,
                'note' => $document->statuses->first()->note ?? null,
            ]
        ]);
    }
}
