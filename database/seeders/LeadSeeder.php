<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use App\Models\Lead;
use App\Services\WebsiteAnalyzer;
use App\Services\AiLeadScore;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $industries = ['Technology', 'Food', 'Healthcare', 'Education', 'Finance', 'Retail'];

        $files = File::files(public_path('sample-sites'));

        $scorer = new AiLeadScore();

        foreach ($files as $file) {
    $filename = $file->getFilename();
    $companyName = ucwords(str_replace('-', ' ', pathinfo($filename, PATHINFO_FILENAME)));
    $websiteUrl = 'http://127.0.0.1:8000/sample-sites/' . $filename;

    $analysis = 'Failed to analyze';
    try {
        $analysis = WebsiteAnalyzer::analyze($filename);
    } catch (\Exception $e) {
        $analysis = "Error: {$e->getMessage()}";
    }

    $lead = Lead::create([
        'company_name' => $companyName,
        'job_title' => $faker->jobTitle,
        'website' => $websiteUrl,
        'industry' => $industries[array_rand($industries)],
        'website_analysis' => $analysis,
    ]);

    try {
        $result = $scorer->classify($analysis);
        $lead->score = $result['score'];
        $lead->category = $result['category'];
    } catch (\Exception $e) {
        $lead->score = null;
        $lead->category = "Error: {$e->getMessage()}";
    }

    $lead->save();
}

    }
}

