<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalkProposalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewerController;

Route::middleware('login_status')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/get-login', [LoginController::class, 'get_login'])->name('get-login');
});

Route::middleware(['auth:speakers'])->namespace('Speaker')->prefix('speaker')->group(function () {
    Route::get('/talk-proposals', [TalkProposalController::class, 'talk_proposals'])->name('talk-proposals');

    Route::get('/new-talk-proposal', [TalkProposalController::class, 'new_talk_proposal'])->name('new-talk-proposal');

    Route::post('/create-talk-proposal', [TalkProposalController::class, 'create_talk_proposal'])->name('create-talk-proposal');

    Route::get('/edit-talk-proposal/{proposal_id}', [TalkProposalController::class, 'edit_talk_proposal'])->name('edit-talk-proposal');

    Route::post('/update-talk-proposal', [TalkProposalController::class, 'update_talk_proposal'])->name('update-talk-proposal');

    Route::get('/speaker-logout', [LoginController::class, 'speaker_logout'])->name('speaker-logout');
});

Route::middleware(['auth:web'])->namespace('Reviewer')->prefix('reviewer')->group(function () {
    Route::get('/dashboard', [ReviewerController::class, 'dashboard'])->name('reviewer-dashboard');
    Route::post('/submit-review', [ReviewerController::class, 'submit_review'])->name('submit-review');
    Route::get('/reviewer-logout', [ReviewerController::class, 'reviewer_logout'])->name('reviewer-logout');
});