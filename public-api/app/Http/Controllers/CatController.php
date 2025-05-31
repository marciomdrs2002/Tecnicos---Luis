<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatController extends Controller
{
    private $baseUrl;
    private $headers;

    public function __construct()
    {
        $this->baseUrl = config('catapi.baseUrl');
        $this->headers = [
            'x-api-key' => config('catapi.key')
        ];
    }

    public function getRandomCat()
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get("{$this->baseUrl}/images/search");

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()[0]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch cat image',
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getBreeds()
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get("{$this->baseUrl}/breeds");

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch cat breeds',
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCatsByBreed($breedId)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get("{$this->baseUrl}/images/search", [
                    'breed_ids' => $breedId,
                    'limit' => 10
                ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch cats by breed',
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function voteOnImage(Request $request)
    {
        try {
            $request->validate([
                'image_id' => 'required|string',
                'value' => 'required|integer|in:1,-1'
            ]);

            $response = Http::withHeaders($this->headers)
                ->post("{$this->baseUrl}/votes", [
                    'image_id' => $request->image_id,
                    'value' => $request->value
                ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vote recorded successfully',
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to record vote',
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getFavorites()
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get("{$this->baseUrl}/favourites");

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch favorites',
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function addToFavorites(Request $request)
    {
        try {
            $request->validate([
                'image_id' => 'required|string'
            ]);

            $response = Http::withHeaders($this->headers)
                ->post("{$this->baseUrl}/favourites", [
                    'image_id' => $request->image_id
                ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Image added to favorites',
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to add image to favorites',
                'error' => $response->body()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 