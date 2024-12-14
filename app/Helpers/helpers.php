<?php

use App\Models\Tag;

if (!function_exists('get_tag_name')) {
    function get_tag_name($tag_id)
    {
        return Tag::where('id',$tag_id)->value('name');
    }
}