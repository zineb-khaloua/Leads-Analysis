<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class WebsiteAnalyzer
{
    public static function analyze(string $filename): string
    {
        $path = public_path('sample-sites/' . $filename);

        if (!file_exists($path)) {
            return "File not found: $filename";
        }

        $html = file_get_contents($path);
        $crawler = new Crawler($html);

        $title = $crawler->filter('title')->count() ? $crawler->filter('title')->text() : 'No Title';
        $description = $crawler->filter('meta[name="description"]')->count()
            ? $crawler->filter('meta[name="description"]')->attr('content')
            : 'No Description';
        $paragraph = $crawler->filter('p')->count()
            ? $crawler->filter('p')->first()->text()
            : 'No Content';

        return "Title: $title | Description: $description | Content: $paragraph";
    }
}
