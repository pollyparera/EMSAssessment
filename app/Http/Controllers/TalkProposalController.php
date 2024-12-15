<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\TalkProposal;
use App\Models\TalkProposalRevision;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use Auth;

class TalkProposalController extends Controller
{
    public function index(){
        $talkProposals = TalkProposal::all();

        return response()->json($talkProposals);
    }

    public function talk_proposals(Request $request){
        if ($request->ajax()) {
            $talk_proposals=TalkProposal::where('speaker_id',Auth::guard('speakers')->user()->id)->orderBy('id', 'DESC');

            return DataTables::of($talk_proposals)
                            ->addColumn('tag', function($row){
                                return get_tag_name($row->tag_id);
                            })
                            ->addColumn('uploaded_document', function($row){
                                return '<a href="'.url('presentation_pdf/' . $row->pdf_path).'" download>Download Document</a>';
                            })
                            ->addColumn('description', function($row){
                                return !empty($row->description) ? substr(strip_tags($row->description),0,75)."..." : 'NA';
                            })
                            ->addColumn('average_rating', function($row){
                                return get_overall_rating($row->id);
                            })
                            ->addColumn('action', function($row){
                                $html='<a href="'.route('edit-talk-proposal', ['proposal_id' => Crypt::encryptString($row->id)]).'" class="btn btn-primary view_button">Edit</a>';

                                return $html;
                            })
                            ->rawColumns(['action','description','uploaded_document'])
                            ->make(true);
        }
        return view('TalkProposal.talk_proposals');
    }

    public function new_talk_proposal(){
        $tags=Tag::orderBy('name','ASC')->get();

        return view('TalkProposal.new_talk_proposal',compact('tags'));
    }

    public function create_talk_proposal(Request $request){
        $request->validate([
            'tag' => 'required',
            'title' => 'required',
            'presentation_pdf' => 'required|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('presentation_pdf')) {
            $file = $request->file('presentation_pdf');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $filePath = 'presentation_pdf/' . $fileName;

            $file->move(public_path('presentation_pdf'), $fileName);
        }

        $talk_proposal=new TalkProposal;
        $talk_proposal->speaker_id=Auth::guard('speakers')->user()->id;
        $talk_proposal->tag_id=$request->tag;
        $talk_proposal->title=$request->title;
        $talk_proposal->description=$request->description;
        $talk_proposal->pdf_path=$fileName;

        $talk_proposal->save();

        return redirect()->route('talk-proposals')->with('message', 'Proposal added successfull');
    }

    public function edit_talk_proposal(Request $request){
        try{
            $tags=Tag::orderBy('name','ASC')->get();

            $talk_proposal=TalkProposal::where('id',Crypt::decryptString($request->proposal_id))->first();

            return view('TalkProposal.edit_talk_proposal',compact('tags','talk_proposal'));
        }
        catch(\Exception $e){
            abort(403);
        }
    }

    public function update_talk_proposal(Request $request){
        $request->validate([
            'tag' => 'required',
            'title' => 'required',
            'presentation_pdf' => 'mimes:pdf|max:2048'
        ]);

        $fileName='';

        if ($request->hasFile('presentation_pdf')) {
            $file = $request->file('presentation_pdf');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $filePath = 'presentation_pdf/' . $fileName;

            $file->move(public_path('presentation_pdf'), $fileName);
        }

        //save the old record in revision table
        $old_data=TalkProposal::where('id',Crypt::decryptString($request->proposal_id))->first()->toArray();

        $revision=new TalkProposalRevision;
        $revision->talk_proposal_id=Crypt::decryptString($request->proposal_id);
        $revision->changes=json_encode($old_data);
        $revision->user_id=Auth::guard('speakers')->user()->id;
        $revision->changed_at=date('Y-m-d h:i:s');

        $revision->save();
        //revison saved

        $talk_proposal=TalkProposal::find(Crypt::decryptString($request->proposal_id));
        $talk_proposal->speaker_id=Auth::guard('speakers')->user()->id;
        $talk_proposal->tag_id=$request->tag;
        $talk_proposal->title=$request->title;
        $talk_proposal->description=$request->description;

        if($fileName!=''){
            $talk_proposal->pdf_path=$fileName;
        }

        $talk_proposal->update();

        return redirect()->route('talk-proposals')->with('message', 'Proposal added successfull');
    }
}
