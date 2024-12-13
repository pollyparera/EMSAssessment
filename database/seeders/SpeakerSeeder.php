<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Speaker;

class SpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $speakers = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'bio' => 'Alice is an experienced technology speaker with expertise in AI and Machine Learning.',
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob.smith@example.com',
                'bio' => 'Bob is a startup mentor and business strategist specializing in finance and entrepreneurship.',
            ],
            [
                'name' => 'Carol Lee',
                'email' => 'carol.lee@example.com',
                'bio' => 'Carol is a public health advocate and researcher focusing on mental health initiatives.',
            ],
            [
                'name' => 'David Kim',
                'email' => 'david.kim@example.com',
                'bio' => 'David is a software engineer and an open-source contributor in the field of DevOps.',
            ],
            [
                'name' => 'Emma Brown',
                'email' => 'emma.brown@example.com',
                'bio' => 'Emma is an environmental scientist working on sustainability and climate change solutions.',
            ],
        ];

        foreach ($speakers as $speaker) {
            Speaker::create($speaker);
        }
    }
}
