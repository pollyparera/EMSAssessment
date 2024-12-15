<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Review;
use App\Models\TalkProposal;
use App\Models\Tag;

class AssessmentApiController extends Controller
{
    public function getAllReviewer(Request $request){
        $role_id=Role::where('role','Reviewer')->value('id');

        $reviewers=[];

        $reviewers=User::where('role_id',$role_id)->get()->toArray();

        return response()->json(['status'=>200,'error'=>false,'message' => 'Reviewers fetched successfully','data'=>$reviewers]);
    }

    public function talkProposalReviews(Request $request){
        $reviews=[];

        $talk_proposals_reviews=Review::where('talk_proposal_id',$request->proposal_id)->get();

        foreach($talk_proposals_reviews as $key=>$val){
            $reviews[$key]['review_id']=$val->id;
            $reviews[$key]['review_by']=get_reviewer_name($val->reviewer_id);
            $reviews[$key]['rating']=$val->rating;
            $reviews[$key]['comment']=strip_tags($val->comments);
        }

        return response()->json(['status'=>200,'error'=>false,'message' => 'Reviews fetched successfully','data'=>$reviews]);
    }

    public function talkProposalStatistics(Request $request){
        $total_talk_proposals=TalkProposal::count();

        $average_rating=Review::avg('rating');

        $all_tags=Tag::get();
        
        $tag_wise_proposals=[];

        foreach($all_tags as $key=>$val){
            $tag_wise_proposals[$val->name]=TalkProposal::where('tag_id',$val->id)->count();
        }

        $data_to_send['total_proposals']=$total_talk_proposals;
        $data_to_send['average_rating']=$average_rating;
        $data_to_send['tag_wise_proposals']=$tag_wise_proposals;

        return response()->json(['status'=>200,'error'=>false,'message' => 'Statistics fetched successfully','data'=>$data_to_send]);
    }
}
