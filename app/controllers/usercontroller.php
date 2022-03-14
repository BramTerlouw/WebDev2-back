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
    function __construct()
    {
        $this->service = new UserService();
    }

    public function login() {
        try {
            $data = $this->createObjectFromPostedJson("Models\\User");
            $user = $this->service->authUser($data->username, $data->password);

            if (!$user) {
                $this->respondWithError(401, "Wrong credentials");
                return;
            }

            $this->auth($user);
            
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    private function auth($user) {
        $payload = array(
            "iss" => "http://localhost",
            "aud" => "http://localhost",
            "iat" => time(),
            "nbf" => time(),
            "exp" => time() + 600,
            "data" => array(
                "username" => $user->username,
            )
        );

        $jwt = JWT::encode($payload, $_SESSION['jwt'], 'HS256');
        $this->respond(["username" => $user->username,"token" => $jwt]);
    }
}
