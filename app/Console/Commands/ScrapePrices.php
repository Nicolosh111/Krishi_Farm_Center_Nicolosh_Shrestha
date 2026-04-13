<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CropPrice;
use Carbon\Carbon;

class ScrapePrices extends Command
{
    protected $signature = 'prices:scrape';
    protected $description = 'Scrape daily crop prices from Kalimati Market website';

    public function handle()
    {
        $this->info("Starting Kalimati Market scraping...");

        // Fetch data
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
        ])->get('https://kalimatimarket.gov.np/price');

        if (!$response->successful()) {
            $this->error('Failed to fetch crop prices.');
            return;
        }

        $html = $response->body();

        $dom = new \DOMDocument();
        @$dom->loadHTML($html);

        $rows = $dom->getElementsByTagName('tr');

        $count = 0;
        $date = Carbon::today()->toDateString();

        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');

            // Ensure correct table format
            if ($cols->length >= 5) {

                $crop = trim($cols->item(0)->nodeValue);

                $unit = trim($cols->item(1)->nodeValue);
                $unit = $this->normalizeUnit($unit);

                // FIXED LOCATION
                $location = 'Kalimati';

                $min = floatval($this->nepaliToNumber($cols->item(2)->nodeValue));
                $max = floatval($this->nepaliToNumber($cols->item(3)->nodeValue));
                $avg = floatval($this->nepaliToNumber($cols->item(4)->nodeValue));

                // Skip invalid rows
                if (!$crop || !$avg) {
                    continue;
                }

                // Save or update
                CropPrice::updateOrCreate(
                    [
                        'crop_name' => $crop,
                        'date' => $date
                    ],
                    [
                        'location'  => $location,
                        'unit'      => $unit,
                        'min_price' => $min,
                        'max_price' => $max,
                        'price'     => $avg
                    ]
                );

                $this->info("Saved: $crop ($unit) => Rs. $avg");
                $count++;
            }
        }

        $this->info(" Scraping completed. Total saved: $count crops.");
    }

    /**
     * Convert Nepali digits to English numbers
     */
    private function nepaliToNumber($str)
    {
        $nepaliDigits = ['०','१','२','३','४','५','६','७','८','९'];
        $latinDigits  = ['0','1','2','3','4','5','6','7','8','9'];

        $str = str_replace($nepaliDigits, $latinDigits, $str);
        return preg_replace('/[^\d.]/u', '', $str);
    }

    /**
     * Normalize units (Nepali → English)
     */
    private function normalizeUnit($unit)
    {
        $map = [
            'के जी' => 'Kg',
            'के.जी.' => 'Kg',
            'केजी' => 'Kg',
            'किलो' => 'Kg',
            'लिटर' => 'Litre',
            'दर्जन' => 'Dozen',
            'प्रति गोटा' => 'Piece'
        ];

        return $map[$unit] ?? $unit;
    }
}
