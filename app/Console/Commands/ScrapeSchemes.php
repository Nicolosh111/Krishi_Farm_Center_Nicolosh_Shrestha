<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Scheme;

class ScrapeSchemes extends Command
{
    protected $signature = 'schemes:scrape';
    protected $description = 'Scrape government schemes from MoALD website';

    public function handle()
    {
        // Correct URL for notices
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
        ])->get('https://moald.gov.np/category/notice');

        if (!$response->successful()) {
            $this->error('Failed to fetch schemes.');
            return;
        }

        $html = $response->body();
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $links = $dom->getElementsByTagName('a');

        foreach ($links as $link) {
            $title = trim($link->nodeValue);
            $href  = $link->getAttribute('href');

            if ($title && $href) {
                // Fix relative URLs
                if (strpos($href, 'http') !== 0) {
                    $href = 'https://moald.gov.np' . $href;
                }

                Scheme::updateOrCreate(
                    ['title' => $title],
                    [
                        'description' => 'See notice: '.$href,
                        'link' => $href,
                    ]
                );

                // Debug output
                $this->info("Saved: ".$title." => ".$href);
            }
        }

        $this->info('Schemes scraped successfully!');
    }
}
