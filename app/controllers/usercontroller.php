<?php

namespace Controllers;

use Exception;
use Services\UserService;
use Models\User;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserController extends Controller
{
    private $service;
    function __construct() {
        $this->service = new UserService();
    }


    // ## logging in of the user
    public function login() {
        try {
            $data = $this->createObjectFromPostedJson("Models\\User");
            $user = $this->service->authUser($data->username, $data->password); // => check if user exists

            // no user found. give http error and return
            if (!$user) {
                $this->respondWithError(401, "Wrong credentials");
                return;
            }

            // call function to create jwt token
            $this->auth($user);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }


    // ## create JWT and send to front end
    private function auth($user) {
        $payload = array(
            "iss" => "http://localhost", // <= issuer
            "aud" => "http://localhost", // <= audience
            "iat" => time(),             // <= issued at
            "nbf" => time(),             // <= not before
            "exp" => time() + 600,       // <= experation time
            "data" => array(
                "username" => $user->username, // <= data included in jwt token
            )
        );

        // create hashed token with secret key, saved in a session variable
        $jwt = JWT::encode($payload, $_SESSION['jwt'], 'HS256');
        $this->respond(["username" => $user->username,"token" => $jwt, "role" => $user->role]);
    }
}
