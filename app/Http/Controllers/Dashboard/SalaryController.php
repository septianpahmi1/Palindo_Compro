<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Salary;
use App\Models\Journal;
use App\Models\Payment;
use App\Models\Employee;
use App\Models\Estimation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    public function index()
    {
        $title = 'Salary';

        $data = Salary::all();
        $employee = Employee::all();
        $estimation = Estimation::all();
        return view('dashboard.salary.index', compact('data', 'title', 'employee', 'estimation'));
    }

    public function delete($id)
    {
        $data = Salary::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function post(Request $request)
    {
        $salary = preg_replace('/\D/', '', $request->salary);
        $allowance = preg_replace('/\D/', '', $request->allowance);
        $deduction = preg_replace('/\D/', '', $request->deduction);
        $total = preg_replace('/\D/', '', $request->total);
        $request->merge([
            'total' => $total,
            'salary' => $salary,
            'allowance' => $allowance,
            'deduction' => $deduction,
        ]);
        $request->validate([
            'date' => 'required|date',
            'date_expired' => 'required|date',
            'salary' => 'required|numeric:min:1',
            'allowance' => 'nullable|numeric:min:0',
            'deduction' => 'nullable|numeric:min:0',
            'total' => 'required|numeric:min:1',
            'estimation_id' => 'required|exists:estimations,id',
            'employee_id' => 'required|exists:employees,id'
        ]);
        $employee = Employee::findOrFail($request->employee_id);
        $nikCode = substr($employee->nik, -3); // Ambil 3 digit terakhir NIK

        $date = Carbon::parse($request->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $count = Salary::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $numbering = str_pad($count, 3, '0', STR_PAD_LEFT);

        $generatedNumber = "{$numbering}/{$nikCode}/PALINDO/SALARY/{$month}/{$year}";
        Salary::create([
            'estimation_id' => $request->estimation_id,
            'employee_id' => $request->employee_id,
            'number' => $generatedNumber,
            'date' => $request->date,
            'salary' => $request->salary,
            'allowance' => $request->allowance,
            'deduction' => $request->deduction,
            'total' => $request->total,
            'date_expired' => $request->date_expired,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Data berhasil dibuat.');
    }

    public function status($id)
    {
        $data = Salary::find($id);

        $estimation = Estimation::findOrFail($data->estimation_id);
        $noAccount = $estimation->no_account;

        $date = Carbon::parse($data->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $transactionCount = Payment::where('estimation_id', $data->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;

        $serial = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        $generatedNumber = "{$noAccount}/PALINDO/SALARY/{$month}/{$year}/{$serial}";

        Payment::create([
            'estimation_id' => $data->estimation_id,
            'number' => $generatedNumber,
            'date' => $data->date,
            'total' => $data->total,
            'description' => $data->description,
        ]);

        Journal::create([
            'estimation_id' => $data->estimation_id,
            'number' => $generatedNumber,
            'date' => $data->date,
            'total' => $data->total,
            'title' => $data->description,
        ]);

        $estimation = Estimation::find($data->estimation_id);
        $estimation->end_balance -= $data->total;
        $estimation->save();

        $data->status = "Success";
        $data->save();
        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    protected function invoice($year, $id)
    {
        $data = Salary::where('id', $id)->first();

        $employee = Employee::where('id', $data->employee_id)->first();
        $nik = $employee->nik;

        $date = Carbon::parse($data->date);
        $month = $date->format('m');
        $year = $date->format('Y');
        $transactionCount = Salary::where('estimation_id', $data->estimation_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count() + 1;
        $idPadded = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);
        return "{$idPadded}/{$nik}/SALARY/{$year}";
    }
    public function quotation($id)
    {
        $data = Salary::with(['employee'])->findOrFail($id);
        $year = optional($data->date)->format('Y') ?? now('Asia/Jakarta')->year;
        $invoiceNumber = $this->invoice($year, $data->id);

        return view('dashboard.salary.invoice', compact('data', 'invoiceNumber'));
    }
}
