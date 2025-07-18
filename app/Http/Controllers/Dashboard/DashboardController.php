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
}
