<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ChatController;

Route::post('/chatbot', [ChatController::class, 'respond']);
