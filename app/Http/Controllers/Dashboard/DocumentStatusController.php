<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DocumentStatus;
use Illuminate\Http\Request;

class DocumentStatusController extends Controller
{
    protected function makeInvoiceNumber($year, $id)
    {
        $idPadded = str_pad($id, 4, '0', STR_PAD_LEFT); // 5 digit, ubah sesuai kebutuhan
        return "ALH{$year}-{$idPadded}";
    }
    public function quotation($id)
    {
        $data = DocumentStatus::with(['document', 'category'])->findOrFail($id);
        $paymentDue = optional($data->created_at)->copy()->addMonth()->format('d/m/Y');
        $year = optional($data->created_at)->format('Y') ?? now('Asia/Jakarta')->year;

        $invoiceNumber = $this->makeInvoiceNumber($year, $data->id);

        return view('dashboard.document.invoice', compact('data', 'invoiceNumber', 'paymentDue'));
    }
}
