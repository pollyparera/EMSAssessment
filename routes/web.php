<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalkProposalController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TalkProposalController::class, 'new_talk_proposal'])->name('new-talk-proposal');
