<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * Controlador para la autenticación y la interacción con la API de Twitter.
 */
class LoginTwitterController extends Controller
{
    private $twitter_api_key;
    private $twitter_api_key_secret;

    /**
     * Constructor del controlador.
     * Inicializa las claves de la API de Twitter con valores de las variables de entorno.
     */
    public function __construct()
    {
        $this->twitter_api_key_secret = env('TWITTER_SECRET');
        $this->twitter_api_key = env('TWITTER_KEY');
    }

    /**
     * Inicia el proceso de autenticación con Twitter.
     * Redirige al usuario a la página de autorización de Twitter.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginTwitter(Request $request)
    {
        $callback = route('k'); // Modificar con el nombre de la ruta de callback apropiada
        $_twitter_connect = new TwitterOAuth($this->twitter_api_key, $this->twitter_api_key_secret);
        $_twitter_connect->setApiVersion('2');
        $access_token = $_twitter_connect->oauth("oauth/request_token", ["oauth_callback" => $callback]);
        $route = $_twitter_connect->url('oauth/authorize', ['oauth_token' => $access_token['oauth_token']]);
        return redirect($route);
    }

    /**
     * Maneja la respuesta de Twitter después de la autenticación.
     * Obtiene y almacena el token de acceso de Twitter.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getToken(Request $request)
    {
        $response = $request->all();

        $oauth_token = $response['oauth_token'];
        $oauth_verifier = $response['oauth_verifier'];
        $_twitter_connect = new TwitterOAuth($this->twitter_api_key, $this->twitter_api_key_secret, $oauth_token, $oauth_verifier);
        $_twitter_connect->setApiVersion('2');
        $token = $_twitter_connect->oauth('oauth/access_token', ['oauth_verifier' => $oauth_verifier]);
        $oauth_token = $token['oauth_token'];
        $oauth_token_secret = $token['oauth_token_secret'];

        // Aquí asumo que el usuario está autenticado y se actualiza su registro en la base de datos.
        // Deberías adaptar esta parte según la lógica de tu aplicación.
        $user = User::query()->update(
            [
                'twitter_oauth_token' => $oauth_token,
                'twitter_oauth_token_secret' => $oauth_token_secret,
            ]
        );

        return redirect('dashboard-user'); // Redirige al dashboard del usuario.
    }

    /**
     * Publica un tweet en la cuenta del usuario autenticado.
     *
     * @param string $oauth_token Token de OAuth del usuario.
     * @param string $oauth_token_secret Secreto del token de OAuth del usuario.
     * @param string $post Texto del tweet a publicar.
     */
    public function postTweet($oauth_token, $oauth_token_secret, $post)
    {
        $push = new TwitterOAuth($this->twitter_api_key, $this->twitter_api_key_secret, $oauth_token, $oauth_token_secret);
        $push->setApiVersion('2');
        $response = $push->post('tweets', ['text' => $post], true);

        // Aquí podrías manejar la respuesta de la API de Twitter, por ejemplo, verificar si el tweet se publicó correctamente.
    }
}
