<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Dashboard\BurdenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DocumentsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\SubmissionController;
use App\Http\Controllers\TrackingRegistrationController;
use App\Http\Controllers\Dashboard\DocumentStatusController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\EstimationController;
use App\Http\Controllers\Dashboard\ExpensesController as DashboardExpensesController;
use App\Http\Controllers\Dashboard\JournalController;
use App\Http\Controllers\Dashboard\NewsletterController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\PurchaseController;
use App\Http\Controllers\Dashboard\ReceiptController;
use App\Http\Controllers\Dashboard\SalaryController;
use App\Http\Controllers\Dashboard\SalesInvoiceController;
use App\Http\Controllers\Dashboard\SupplierController;
use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/generate-sitemap', [SitemapController::class, 'generate'])
    ->name('sitemap.generate');

Route::get('/track-document', [TrackingRegistrationController::class, 'track'])->name('track.document');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'dashboardData'])->name('dashboard.data');
    // Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoriesController::class, 'post'])->name('categories.post');
    Route::post('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');

    Route::get('/document', [DocumentsController::class, 'index'])->name('documents');
    Route::post('/document/post', [DocumentsController::class, 'post'])->name('documents.post');
    Route::post('/document/update/{id}', [DocumentsController::class, 'update'])->name('documents.update');
    Route::get('/document/delete/{id}', [DocumentsController::class, 'delete'])->name('documents.delete');
    Route::get('/document/{id}', [DocumentStatusController::class, 'quotation'])->name('documents.quotation');

    Route::get('/daily-expenses', [DashboardExpensesController::class, 'index'])->name('expense');
    Route::post('/daily-expenses', [DashboardExpensesController::class, 'post'])->name('expense.post');
    Route::post('/daily-expenses/{id}', [DashboardExpensesController::class, 'update'])->name('expense.update');
    Route::get('/daily-expenses/{id}', [DashboardExpensesController::class, 'delete'])->name('expense.delete');

    Route::get('/submission', [SubmissionController::class, 'index'])->name('submission');
    Route::post('/submission', [SubmissionController::class, 'post'])->name('submission.post');
    Route::post('/submission/{id}', [SubmissionController::class, 'update'])->name('submission.update');
    Route::get('/submission/{id}', [SubmissionController::class, 'delete'])->name('submission.delete');
    // Route::get('/submission/filter', [SubmissionController::class, 'filterByMonth'])->name('submission.filter');

    Route::get('/estimation', [EstimationController::class, 'index'])->name('estimation');
    Route::post('/estimation', [EstimationController::class, 'post'])->name('estimation.post');
    Route::post('/estimation/{id}', [EstimationController::class, 'update'])->name('estimation.update');
    Route::get('/estimation/{id}', [EstimationController::class, 'delete'])->name('estimation.delete');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee', [EmployeeController::class, 'post'])->name('employee.post');
    Route::post('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');

    Route::get('/salary', [SalaryController::class, 'index'])->name('salary');
    Route::post('/salary', [SalaryController::class, 'post'])->name('salary.post');
    Route::get('/salary/{id}', [SalaryController::class, 'delete'])->name('salary.delete');
    Route::get('/salary/status/{id}', [SalaryController::class, 'status'])->name('salary.status');

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment', [PaymentController::class, 'post'])->name('payment.post');
    Route::get('/payment/{id}', [PaymentController::class, 'delete'])->name('payment.delete');

    Route::get('/burden', [BurdenController::class, 'index'])->name('burden');
    Route::post('/burden', [BurdenController::class, 'post'])->name('burden.post');
    Route::get('/burden/{id}', [BurdenController::class, 'delete'])->name('burden.delete');
    Route::get('/burden/status/{id}', [BurdenController::class, 'status'])->name('burden.status');

    Route::get('/receipt', [ReceiptController::class, 'index'])->name('receipt');
    Route::post('/receipt', [ReceiptController::class, 'post'])->name('receipt.post');
    Route::get('/receipt/{id}', [ReceiptController::class, 'delete'])->name('receipt.delete');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customer', [CustomerController::class, 'post'])->name('customer.post');
    Route::post('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer/{id}', [CustomerController::class, 'delete'])->name('customer.delete');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('/supplier', [SupplierController::class, 'post'])->name('supplier.post');
    Route::post('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/supplier/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');

    Route::get('/salary', [SalaryController::class, 'index'])->name('salary');
    Route::post('/salary', [SalaryController::class, 'post'])->name('salary.post');
    Route::get('/salary/{id}', [SalaryController::class, 'delete'])->name('salary.delete');
    Route::get('/salary/status/{id}', [SalaryController::class, 'status'])->name('salary.status');
    Route::get('/salary/invoice/{id}', [SalaryController::class, 'quotation'])->name('salary.invoice');

    Route::get('/journal', [JournalController::class, 'index'])->name('journal');
    Route::post('/journal', [JournalController::class, 'post'])->name('journal.post');
    Route::get('/journal/{id}', [JournalController::class, 'delete'])->name('journal.delete');

    Route::get('/sales-invoice', [SalesInvoiceController::class, 'index'])->name('sales-invoice');
    Route::post('/sales-invoice', [SalesInvoiceController::class, 'post'])->name('sales.post');
    Route::get('/sales-invoice/{id}', [SalesInvoiceController::class, 'delete'])->name('sales.delete');
    Route::get('/sales-invoice/status/{id}', [SalesInvoiceController::class, 'status'])->name('sales.status');
    Route::get('/sales-invoice/invoice/{id}', [SalesInvoiceController::class, 'quotation'])->name('sales.invoice');

    Route::get('/purchase-invoice', [PurchaseController::class, 'index'])->name('purchase');
    Route::post('/purchase-invoice', [PurchaseController::class, 'post'])->name('purchase.post');
    Route::get('/purchase-invoice/{id}', [PurchaseController::class, 'delete'])->name('purchase.delete');
    Route::get('/purchase-invoice/status/{id}', [PurchaseController::class, 'status'])->name('purchase.status');
    Route::get('/purchase-invoice/invoice/{id}', [PurchaseController::class, 'quotation'])->name('purchase.invoice');

    Route::get('/consultation', [MessageController::class, 'index'])->name('consultation');
    Route::get('/consultation/read/{id}', [MessageController::class, 'detail'])->name('consultation.detail');
    Route::get('/consultation/{id}', [MessageController::class, 'destroy'])->name('consultation.destroy');
    Route::get('/consultation/search', [MessageController::class, 'search'])->name('consultation.search');
    Route::post('/consultation/delete', [MessageController::class, 'delete'])->name('consultation.delete');

    Route::get('/task', [TaskController::class, 'index'])->name('task');
    Route::post('/task', [TaskController::class, 'post'])->name('task.post');
    Route::get('/task/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::get('/tasks/filter', [TaskController::class, 'filterByMonth'])->name('tasks.filter');

    Route::get('/profit-loss', [ReportController::class, 'index'])->name('profit-loss');
    Route::post('/profit-loss/search', [ReportController::class, 'getData'])->name('profit-loss.get');
    Route::get('/general-journal', [ReportController::class, 'generalJournal'])->name('general-journal');
    Route::post('/general-journal/search', [ReportController::class, 'journalBymonth'])->name('general-journal.get');
    Route::get('/sales-report', [ReportController::class, 'salesReport'])->name('salesReport');
    Route::post('/sales-report/search', [ReportController::class, 'salesBymonth'])->name('sales-report.get');
    Route::get('/purchase-report', [ReportController::class, 'purchaseReport'])->name('purchaseReport');
    Route::post('/purchase-report/search', [ReportController::class, 'purchaseBymonth'])->name('purchase-report.get');
});
Route::post('/chatbot', [ChatController::class, 'respond']);
Route::post('/send-message', [ChatController::class, 'send'])->name('send-message');
Route::post('/subscribe-newsletter', [NewsletterController::class, 'store'])->name('subscribed');
require __DIR__ . '/auth.php';
