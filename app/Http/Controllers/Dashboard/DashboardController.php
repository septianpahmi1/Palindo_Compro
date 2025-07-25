<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\DocumentStatus;
use App\Models\Spending;
use App\Models\SpendingStatus;
use App\Models\Submission;
use App\Models\SubmissionStatus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $spendingTotal = Spending::sum('total');
        $submissionTotal = Submission::whereHas('statuses', function ($query) {
            $query->where('status', 'approved');
        })->sum('total');

        $totalCost = DocumentStatus::where('status', 'Completed')
            ->with('category')
            ->get()
            ->sum(function ($status) {
                return $status->category->cost ?? 0;
            });
        $totalBenefit = DocumentStatus::where('status', 'Completed')
            ->with('category')
            ->get()
            ->sum(function ($status) {
                return $status->category->benefit ?? 0;
            });

        return view('dashboard.index', compact('title', 'spendingTotal', 'submissionTotal', 'totalCost', 'totalBenefit'));
    }

    public function dashboardData(Request $request)
    {
        $startDate = $request->query('start');
        $endDate   = $request->query('end');

        try {
            $spendingTotal = Spending::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })->sum('total');

            $submissionTotal = Submission::whereHas('statuses', fn($q) => $q->where('status', 'approved'))
                ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                })
                ->sum('total');

            $totalCost = DocumentStatus::where('status', 'Completed')
                ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('document_statuses.updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                })
                ->join('categories', 'document_statuses.category_id', '=', 'categories.id')
                ->sum('categories.cost');

            $totalBenefit = DocumentStatus::where('status', 'Completed')
                ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('document_statuses.updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                })
                ->join('categories', 'document_statuses.category_id', '=', 'categories.id')
                ->sum('categories.benefit');

            return response()->json([
                'status'          => true,
                'spendingTotal'   => (float) $spendingTotal,
                'submissionTotal' => (float) $submissionTotal,
                'totalCost'       => (float) $totalCost,
                'totalBenefit'    => (float) $totalBenefit,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
