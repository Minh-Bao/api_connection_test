<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttachmentController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



/**
 * Users
 */
Route::prefix('users')->group(function () {
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::get('index', [UserController::class, 'index'])->name('user.index');
    Route::get('{id}', [UserController::class, 'show'])->name('user.show');
    
    /**
     * Attachment
     */
    Route::prefix('attachment')->group(function() {
        Route::get('list/{user_id}', [AttachmentController::class, 'index']);
        Route::post('upload', [AttachmentController::class, 'uploadAttachment'])
        ->middleware([HandlePrecognitiveRequests::class])
        ->name('user.attachment.upload');
    });

     /**
     * Mail
     */
    Route::prefix('{id}/mail')->group(function() {
        Route::get('create', [MailController::class, 'create'])->name('user.mail.create');
        Route::post('send', [MailController::class, 'send'])->name('user.mail.send');
    });
});
