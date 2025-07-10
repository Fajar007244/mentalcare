<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MoodEntryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientRecordController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\ForumCommentController;
use App\Models\Schedule;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'psychologist') {
                // No redirect, let it fall through to the dashboard view
            }
        }
        return view('dashboard');
    })->name('dashboard');

    Route::resource('courses', CourseController::class);

    // Quiz Routes for Users
    Route::get('quizzes', [QuizController::class, 'userIndex'])->name('quizzes.index'); // Changed to userIndex
    Route::get('quizzes/{quiz}/start', [QuizController::class, 'start'])->name('quizzes.start');
    Route::post('quizzes/{quiz}/store', [QuizController::class, 'storeAttempt'])->name('quizzes.storeAttempt');
    Route::get('quizzes/{quiz}/result/{attempt}', [QuizController::class, 'result'])->name('quizzes.result');

    // Schedule Routes (for Psychologists)
    Route::resource('schedules', ScheduleController::class)->middleware('can:manage-schedules');

    // Appointment Routes (for Users and Psychologists)
    Route::resource('appointments', AppointmentController::class);

    // Mood Entry Routes
    Route::resource('mood-entries', MoodEntryController::class);

    // Payment Routes
    Route::resource('payments', PaymentController::class);

    // Patient Records Routes (for Psychologists)
    Route::resource('patient-records', PatientRecordController::class)->middleware('can:manage-patient-records');

    // Forum Routes
    Route::resource('forum', ForumPostController::class)->except(['destroy']);
    Route::delete('forum/{forumPost}', [ForumPostController::class, 'destroy'])->name('forum.destroy');
    Route::resource('forum.comments', ForumCommentController::class)->shallow()->only(['store', 'update']);
    Route::delete('forum/comments/{comment}', [ForumCommentController::class, 'destroy'])->name('forum.comments.destroy');

    

        // Psychologist Unified Dashboard
    Route::get('/appointments-schedules', [AppointmentController::class, 'showAppointmentsSchedules'])->name('psychologist.dashboard.unified')->middleware('can:manage-schedules');

    // Admin Routes
    Route::middleware(['auth', 'can:access-admin-dashboard'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/psychologists', [AdminController::class, 'listPsychologists'])->name('admin.psychologists.index');
        Route::put('/admin/psychologists/{user}/verify', [AdminController::class, 'verify'])->name('admin.psychologists.verify');

        Route::get('/admin/content', [AdminController::class, 'contentIndex'])->name('admin.content.index');

        // Admin Quiz Management Routes
        Route::resource('admin/quizzes', QuizController::class)->names('admin.quizzes');
        Route::get('admin/quizzes/{quiz}/questions/create', [QuizController::class, 'createQuestion'])->name('admin.quizzes.questions.create');
        Route::post('admin/quizzes/{quiz}/questions', [QuizController::class, 'storeQuestion'])->name('admin.quizzes.questions.store');
        Route::get('admin/quizzes/{quiz}/questions/{question}/edit', [QuizController::class, 'editQuestion'])->name('admin.quizzes.questions.edit');
        Route::put('admin/quizzes/{quiz}/questions/{question}', [QuizController::class, 'updateQuestion'])->name('admin.quizzes.questions.update');
        Route::delete('admin/quizzes/{quiz}/questions/{question}', [QuizController::class, 'destroyQuestion'])->name('admin.quizzes.questions.destroy');
    });
});