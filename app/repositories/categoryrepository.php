<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class CategoryRepository extends Repository
{
    function getAll()
    {
        try {
            $sqlquery = "SELECT category_ID, name FROM category";
            $stmt = $this->connection->prepare($sqlquery);

            $stmt = $this->connection->prepare($sqlquery);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Category');
            $categories = $stmt->fetchAll();

            return $categories;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
