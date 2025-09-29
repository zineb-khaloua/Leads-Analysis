<?php
require __DIR__ . '/vendor/autoload.php'; // autoload for Faker

use Faker\Factory as Faker;

$faker = Faker::create();

// Directory to save sample HTML files
$dir = __DIR__ . '/public/sample-sites/';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// Predefined industries for more realistic data
$industries = ['Technology', 'Food', 'Healthcare', 'Education', 'Finance', 'Retail', 'Marketing', 'Logistics', 'Energy', 'Entertainment'];

for ($i = 0; $i < 50; $i++) {
    // Generate company name and pick an industry
    $companyName = $faker->company;
    $industry = $industries[array_rand($industries)];

    // Clean URL-friendly file name
    $websiteSlug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $companyName));
    $websiteSlug = trim($websiteSlug, '-'); // remove leading/trailing hyphens
    $fileName = $websiteSlug . '.html';

    $filePath = $dir . $fileName;

    // Generate simple HTML content
    $html = "<!DOCTYPE html>
<html>
<head>
    <title>$companyName</title>
    <meta name='description' content='$companyName operates in the $industry industry, providing solutions for businesses.'>
</head>
<body>
    <h1>Welcome to $companyName</h1>
    <p>$companyName specializes in $industry solutions to help businesses grow and succeed.</p>
</body>
</html>";

    file_put_contents($filePath, $html);
    echo "Created: $fileName\n";
}

echo "\nAll 50 sample HTML pages generated in public/sample-sites/\n";
