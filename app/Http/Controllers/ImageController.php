<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function search(Request $request)
    {
        $provider = $request->input('provider');
        $q = $request->input('q') ?? '';
        $q = $this->sanitizeQuery($q);
        $mediaType = $request->input('mediaType') ?? 'photos';
        $page = $request->input('page') ?? 1;
        $resultsPerPage = 15;

        if($provider === 'pexels'){
            $client = new \GuzzleHttp\Client();
            $headers = [
                'Authorization' => env('PEXELS_API_KEY'),
            ];
            $query = [
                'per_page' => $resultsPerPage,
                'page' => $page,
            ];

            $apiBaseURL = 'https://api.pexels.com';

            if(isset($q) && $q) {
                if ($mediaType === 'videos') {
                    $queryURL = '/videos/search';
                }else {
                    $queryURL = '/v1/search';
                }
                $query['query'] = $q;
            }else{
                if ($mediaType === 'videos') {
                    $queryURL = '/videos/popular';
                } else {
                    $queryURL = '/v1/curated';
                }
            }

            $response = $client->request('GET', $apiBaseURL . $queryURL, [
                'headers' => $headers,
                'query' => $query
            ]);

            $responseBody = $response->getBody();
            $photos = json_decode($responseBody->getContents());
            
            return json_encode($photos);
        } else if ($provider === 'pixabay') {
            $client = new \GuzzleHttp\Client();
            $apiKey = env('PIXABAY_API_KEY');
            $query = [
                'key' => $apiKey,
                'per_page' => $resultsPerPage,
                'page' => $page,
            ];

            $apiBaseURL = 'https://pixabay.com/api';
            
            if ($mediaType === 'videos') {
                $queryURL = '/videos';
                if (isset($q) && $q) {
                    $query['q'] = $q;
                    $query['editors_choice'] = false;
                } else {
                    $query['editors_choice'] = true;
                }
            } else if (
                $mediaType === 'photos' ||
                $mediaType === 'vectors' ||
                $mediaType === 'illustrations'
            ) {
                $queryURL = '/';
                $query['image_type'] = substr($mediaType, 0, -1);
                if (isset($q) && $q) {
                    $query['q'] = $q;
                    $query['editors_choice'] = false;
                } else {
                    $query['editors_choice'] = true;
                }
            }

            $response = $client->request('GET', $apiBaseURL . $queryURL, [
                'query' => $query
            ]);

            $responseBody = $response->getBody();
            $photos = json_decode($responseBody->getContents());

            return json_encode($photos);
        }

        return 'No provider given';
    }

    public function store(Request $request)
    {
        
    }

    private function sanitizeQuery($query)
    {
        if ($query > 100) { // trim to 100 chars specified in pixabay api guidelines
            $query = substr($query, 0, 100);
        }
        return $query;
    }
}
