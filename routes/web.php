<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;

Route::get('/', [WhatsAppController::class, 'showForm'])->name('uploadForm');
Route::post('/send-messages', [WhatsAppController::class, 'sendMessages'])->name('sendMessages');
