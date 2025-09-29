<?php

namespace App\Http\Controllers;

   use App\Models\Lead;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $leads = Lead::all();
        return view('leads.index', compact('leads'));
    }

 

public function scrapeAll()
{
    $leads = Lead::all();
    $client = HttpClient::create();

    foreach ($leads as $lead) {
        $url = url('sample-sites/' . basename($lead->website));
        try {
            $response = $client->request('GET', $url);
            $html = $response->getContent();

            $crawler = new Crawler($html);
            $title = $crawler->filter('title')->count() ? $crawler->filter('title')->text() : '';
            $paragraphs = $crawler->filter('p')->each(fn($node) => $node->text());
            $body = implode(' ', $paragraphs);

            $lead->website_analysis = trim($title . ' ' . $body);
            $lead->save();
        } catch (\Exception $e) {
            $lead->website_analysis = 'Error: ' . $e->getMessage();
            $lead->save();
        }
    }

    return "All sample sites scraped successfully!";
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lead $lead)
    {
        //
    }
}
