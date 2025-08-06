<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DocumentsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\SubmissionController;
use App\Http\Controllers\TrackingRegistrationController;
use App\Http\Controllers\Dashboard\DocumentStatusController;
use App\Http\Controllers\Dashboard\ExpensesController as DashboardExpensesController;
use App\Http\Controllers\Dashboard\NewsletterController;
use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\PageController;

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

    Route::get('/message', [MessageController::class, 'index'])->name('consultation');
    Route::get('/message/read/{id}', [MessageController::class, 'detail'])->name('consultation.detail');
    Route::get('/message/{id}', [MessageController::class, 'destroy'])->name('consultation.destroy');
    Route::get('/message/search', [MessageController::class, 'search'])->name('consultation.search');
    Route::post('/message/delete', [MessageController::class, 'delete'])->name('consultation.delete');

    Route::get('/task', [TaskController::class, 'index'])->name('task');
    Route::post('/task', [TaskController::class, 'post'])->name('task.post');
    Route::get('/task/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::get('/tasks/filter', [TaskController::class, 'filterByMonth'])->name('tasks.filter');
});
Route::post('/chatbot', [ChatController::class, 'respond']);
Route::post('/send-message', [ChatController::class, 'send'])->name('send-message');
Route::post('/subscribe-newsletter', [NewsletterController::class, 'store'])->name('subscribed');

Route::get('/', [PageController::class, 'home']);

Route::get('/{slug}', [PageController::class, 'section'])
    ->whereIn('slug', ['about', 'services', 'consultation', 'track']);

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
require __DIR__ . '/auth.php';
