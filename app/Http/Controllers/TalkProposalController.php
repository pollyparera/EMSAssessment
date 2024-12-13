<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TalkProposalController extends Controller
{
    public function new_talk_proposal(){
        return view('TalkProposal.create');
    }
}
