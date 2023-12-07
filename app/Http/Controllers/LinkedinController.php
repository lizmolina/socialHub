<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class LinkedinController extends Controller
{
    public function postToLinkedIn(Request $request)
    {
        $user = Auth::user();
        $accessToken = $user->token;

        $client = new Client();

        $response = $client->post('https://api.linkedin.com/v2/shares', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'x-li-format' => 'json',
            ],
            'json' => [
                'content' => [
                    'contentEntities' => [
                        [
                            'thumbnails' => [
                                ['resolvedUrl' => 'https://example.com/thumbnail.jpg'],
                            ],
                        ],
                    ],
                    'title' => 'Mi título de publicación',
                    'description' => 'Mi descripción de publicación',
                ],
                'visibility' => [
                    'code' => 'anyone',
                ],
            ],
        ]);

        // Manejar la respuesta según tus necesidades
        $statusCode = $response->getStatusCode();

        if ($statusCode == 201) {
            return "Publicación exitosa en LinkedIn";
        } else {
            return "Error al publicar en LinkedIn: " . $statusCode;
        }
    }
}
