<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssessmentApiController;

Route::get('/get-all-reviewer', [AssessmentApiController::class, 'getAllReviewer']);

Route::get('/talk-proposals-reviews/{proposal_id}', [AssessmentApiController::class, 'talkProposalReviews']);

Route::get('/talk-proposals-statistics', [AssessmentApiController::class, 'talkProposalStatistics']);
