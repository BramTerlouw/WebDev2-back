<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;
    function __construct() {
        $this->repository = new UserRepository();
    }


    // ## authenticate user
    // params: username, password
    public function authUser($username, $password) {
        return $this->repository->authUser($username, $password);
    }
}
?>