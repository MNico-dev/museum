<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
    }

    public function login()
    {
        return view('auth.login');

    }
    public function postLogin(Request $request)
    {
        $options = [
            'form_params' => [
                "email" => $request->email,
                "password" => $request->password,
                "remember_me" => true
            ]
        ];

        $client = new GuzzleHttp\Client(['base_uri' => '127.0.0.1:8000/api']);
        $response = $client->post('127.0.0.1:8000/api/auth/login',$options);

        $response = json_decode( $response->getBody()->getContents());

        $user = Auth::user();
        $user->api_token = $response->access_token;
        $user->save();

        return redirect()->route('cuadros.index');

//
//        // Validate credentials
//        $this->validate($request, [
//            'email' => 'required',
//            'password' => 'required',
//        ]);
//
//
//        if ( Auth::attempt( $request->only('username', 'password') ) ) {
//        }
//
//        return redirect()->back()->withErrors(
//            'Credenciales incorrectas'
//        );
//


    }


    public function logout()
    {
        $access_token = Auth::user()->api_token;

        $headers = [
            'headers' => [
                'Authorization' => 'Bearer'." ".$access_token,
                'X-HTTP-USER-ID' => Auth::user()->id
            ]
        ];

        $client = new GuzzleHttp\Client(['base_uri' => '127.0.0.1:8000/api/logout']);
        $response = $client->post('127.0.0.1:8000/api/auth/login',$headers);

        $user = Auth::user();
        $user->api_token = null;
        $user->save();

        return redirect()->route('home');
    }
}
