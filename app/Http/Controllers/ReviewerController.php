<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalkProposal;
use App\Models\TalkProposalRevision;
use App\Models\Review;
use App\Models\Tag;
use App\Models\Speaker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use DataTables;
use Auth;

class ReviewerController extends Controller
{
    public function dashboard(Request $request){
        if ($request->ajax()) {
            $talk_proposals=TalkProposal::orderBy('id', 'DESC');

            return DataTables::of($talk_proposals)
                            ->addColumn('tag', function($row){
                                return get_tag_name($row->tag_id);
                            })
                            ->addColumn('uploaded_document', function($row){
                                return '<a href="'.url('presentation_pdf/' . $row->pdf_path).'" download>Download Document</a>';
                            })
                            ->addColumn('description', function($row){
                                return !empty($row->description) ? substr(strip_tags($row->description),0,60)."..." : 'NA';
                            })
                            ->addColumn('overall_rating', function($row){
                                return get_overall_rating($row->id);
                            })
                            ->addColumn('submitted_rating', function($row){
                                return get_submitted_rating($row->id,Auth::guard('web')->user()->id);
                            })
                            ->addColumn('submitted_review', function($row){
                                $review=get_submitted_review($row->id,Auth::guard('web')->user()->id);

                                return (strlen($review) > 60) ? substr($review,0,60)."..." : $review;
                            })
                            ->addColumn('speaker', function($row){
                                return get_speaker_name($row->speaker_id);
                            })
                            ->addColumn('action', function($row){
                                $html='<a href="#" data-title="'.$row->title.'" data-proposel-id="'.Crypt::encryptString($row->id).'" class="btn btn-primary submit_rating" data-submitted-rating="'.get_submitted_rating($row->id,Auth::guard('web')->user()->id).'" data-submitted-review="'.get_submitted_review($row->id,Auth::guard('web')->user()->id).'">Submit Rating</a>';

                                return $html;
                            })
                            ->filter(function ($query) use ($request) {
                                if(!empty($request->input('tags'))){
                                    $query->where('tag_id',$request->input('tags'));
                                }

                                if(!empty($request->input('speakers'))){
                                    $query->where('speaker_id',$request->input('speakers'));
                                }

                                if(!empty($request->input('date_submitted'))){
                                    $query->whereRaw('DATE(created_at) = ?', [date('Y-m-d',strtotime($request->input('date_submitted')))]);
                                }
                            })
                            ->rawColumns(['action','description','uploaded_document','submitted_review'])
                            ->make(true);
        }

        $tags=Tag::orderBy('name','ASC')->get();

        $speakers=Speaker::select('id','name')->orderBy('name','ASC')->get();

        return view('Reviewer.dashboard',compact('tags','speakers'));
    }

    public function submit_review(Request $request){
        if ($request->ajax()) {
            //remove previous rating if any
            Review::where('talk_proposal_id',Crypt::decryptString($request->proposal_id))->where('reviewer_id',Auth::guard('web')->user()->id)->delete();

            //submit a new rating
            $review=new Review;
            $review->talk_proposal_id=Crypt::decryptString($request->proposal_id);
            $review->reviewer_id=Auth::guard('web')->user()->id;
            $review->comments=$request->review;
            $review->rating=$request->rating;

            $review->save();

            //send mail for review being added
            $proposal_details=TalkProposal::where('id',Crypt::decryptString($request->proposal_id))->first();

            $toEmail = get_speaker_email($proposal_details->speaker_id);
            
            $subject = 'Review Added';

            $body='Dear '.get_speaker_name($proposal_details->speaker_id).",<br/><br/>";
            
            $body .='A review has been added for your proposal titled '.$proposal_details->title.". The review details includes below:<br/><br/>";
            
            $body .="<strong>Reviewer Name:</strong> ".Auth::guard('web')->user()->name."<br/>";
            
            $body .="<strong>Rating:</strong> ".$request->rating."<br/>";
            
            $body .="<strong>Review Submitted:</strong> ".$request->review."<br/>";

            try{
                Mail::html($body, function ($message) use ($toEmail, $subject) {
                    $message->to($toEmail)
                            ->subject($subject);
                });
            }   
            catch(\Exception $e){
                return false;
            }

            return true;
        }
    }

    public function reviewer_logout(Request $request){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
