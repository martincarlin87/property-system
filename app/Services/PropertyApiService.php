<?php

namespace App\Services;

use App\Jobs\ImportPropertiesApiPageJob;
use App\Models\Property;
use App\Models\PropertyType;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PropertyApiService
{

    public string $apiUrl;
    public string $apiKey;
    public int $pageSize = 50;

    public function __construct()
    {
        $this->apiUrl = config('services.property_api.url');
        $this->apiKey = config('services.property_api.key');

        Log::debug($this->apiUrl);
        Log::debug($this->apiKey);
    }

    public function sync(): void
    {
        $response = $this->importPage();

        $this->dispatchRemainingRequests($response->object());
    }

    public function importPage(?int $page = 1, ?int $pageSize = 30): PromiseInterface|Response
    {
        $response = Http::retry(3, 100)
            ->withHeaders(
                [
                    'User-Agent' => 'Martin Carlin <martin@martincarlin.uk>',
                ]
            )
            ->accept('application/json')
            ->get(
                $this->apiUrl,
                [
                    'page[number]' => $page,
                    'page[size]' => $this->pageSize,
                    'api_key' => $this->apiKey,
                ]
            );

        Log::debug(print_r($response->json(), true));


        $this->saveProperties($response->object());

        return $response;
    }

    private function dispatchRemainingRequests($responseObject): void
    {
        // the response object contains a last_page attribute,
        // we will dispatch a job for each of the remaining pages from the current page to the last

        $currentPage = $responseObject->current_page + 1;
        $lastPage = $responseObject->last_page;

        while ($currentPage <= $lastPage) {
            // use a brief pause (0.5 seconds) to avoid a 429 / Too Many Attempts response
            usleep(500000);
            ImportPropertiesApiPageJob::dispatch($currentPage);
            $currentPage++;
        }
    }

    private function saveProperties($response)
    {
        foreach ($response->data as $responseProperty) {

            Property::updateOrCreate(
                [
                    'uuid' => $responseProperty->uuid,
                ],
                [
                    'uuid' => $responseProperty->uuid,
                    'property_type_id' => $responseProperty->property_type_id,
                    'county' => $responseProperty->county,
                    'country' => $responseProperty->country,
                    'town' => $responseProperty->town,
                    'description' => $responseProperty->description,
                    'address' => $responseProperty->address,
                    'image_full' => $responseProperty->image_full,
                    'image_thumbnail' => $responseProperty->image_thumbnail,
                    'latitude' => $responseProperty->latitude,
                    'longitude' => $responseProperty->longitude,
                    'num_bedrooms' => $responseProperty->num_bedrooms,
                    'num_bathrooms' => $responseProperty->num_bathrooms,
                    'price' => $responseProperty->price,
                    'type' => $responseProperty->type,
                    'created_at' => $responseProperty->created_at,
                    'updated_at' => $responseProperty->updated_at,
                ]
            );

            PropertyType::updateOrCreate(
                [
                    'id' => $responseProperty->property_type_id,
                ],
                [
                    'id' => $responseProperty->property_type_id,
                    'title' => $responseProperty->property_type->title,
                    'description' => $responseProperty->property_type->description,
                    'created_at' => $responseProperty->property_type->created_at,
                    'updated_at' => $responseProperty->property_type->updated_at,
                ]
            );
        }
    }

}
