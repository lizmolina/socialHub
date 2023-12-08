<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LinkedinController extends Controller
{
    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from LinkedIn.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleLinkedInCallback()
    {
        $user = Socialite::driver('linkedin')->user();


        // Autenticar al usuario o registrar según tu lógica
        auth()->login($user, true);

        // Redirigir a la ruta deseada después de la autenticación
        return redirect()->route('home');
    }



    /*public function postToLinkedIn(Request $request)
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

        $statusCode = $response->getStatusCode();

        if ($statusCode == 201) {
            return "Publicación exitosa en LinkedIn";
        } else {
            return "Error al publicar en LinkedIn: " . $statusCode;
        }
    }*/
}
