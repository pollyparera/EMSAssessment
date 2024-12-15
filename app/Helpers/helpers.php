<?php

use App\Models\Tag;
use App\Models\Review;
use App\Models\Speaker;

if (!function_exists('get_tag_name')) {
    function get_tag_name($tag_id)
    {
        return Tag::where('id',$tag_id)->value('name');
    }
}

if (!function_exists('get_overall_rating')) {
    function get_overall_rating($proposal_id)
    {
        $rating=Review::where('talk_proposal_id',$proposal_id)->avg('rating');
        return !empty($rating) ? number_format($rating,1) : 0;
    }
}

if (!function_exists('get_submitted_rating')) {
    function get_submitted_rating($proposal_id,$user_id)
    {
        $rating=Review::where('talk_proposal_id',$proposal_id)->where('reviewer_id',$user_id)->value('rating');
        return !empty($rating) ? $rating : 0;
    }
}

if (!function_exists('get_submitted_review')) {
    function get_submitted_review($proposal_id,$user_id)
    {
        $review= Review::where('talk_proposal_id',$proposal_id)->where('reviewer_id',$user_id)->value('comments');
        return !empty($review) ? $review : 'NA';
    }
}

if (!function_exists('get_speaker_name')) {
    function get_speaker_name($speaker_id)
    {
        return Speaker::where('id',$speaker_id)->value('name');
    }
}
