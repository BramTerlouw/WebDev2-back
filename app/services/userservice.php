<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function authUser($username, $password) {
        return $this->repository->authUser($username, $password);
    }
}

?>