<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class StockRepository extends Repository
{
    
    function insert($stock)
    {
        try {
            $sqlquery = "INSERT into stock (product_ID, amount) VALUES (:id, :amount)";
            $stmt = $this->connection->prepare($sqlquery);

            $stmt->bindParam(':id', $stock->product_ID);
            $stmt->bindParam(':amount', $stock->amount);

            $stmt->execute();

            $stock->stock_ID = $this->connection->lastInsertId();
            return $stock;

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
