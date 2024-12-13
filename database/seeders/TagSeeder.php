<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Business',
            'Health',
            'Education',
            'Environment',
            'Science',
            'Art & Culture',
            'Finance',
            'Social Issues',
            'Leadership',
        ];

        foreach ($categories as $category) {
            $tags=new Tag;
            $tags->name=$category;
            $tags->save();
        }
    }
}
