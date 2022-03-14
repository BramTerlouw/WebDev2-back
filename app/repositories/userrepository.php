<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;
use Models\User;

class UserRepository extends Repository
{
    public function authUser($username, $password) {
        $sqlquery = 
        "SELECT user_ID, name, email, username, password, role 
            FROM user
            WHERE username=:un";
        
        $stmt = $this->connection->prepare($sqlquery);
        $stmt->bindParam(':un', $username);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\User');

        $user = $stmt->fetch();
        
        if ($user == null)
            return false;

        if ($user->password != $password)
            return false;
        
        $user->password = "";
        return $user;
    }
}
