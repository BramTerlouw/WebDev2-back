<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class ProductRepository extends Repository
{
    function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $sqlquery = 
            "SELECT p.product_ID, p.name, p.price, p.image, p.category_ID, c.name as category_Name, 
            s.amount as amount 
                FROM product AS p
                    INNER JOIN category AS c
                        ON p.category_ID = c.category_ID
                    INNER JOIN stock AS s
                        ON p.product_ID = s.product_ID";

            if (isset($limit) && isset($offset)) {
                $sqlquery .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($sqlquery);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Product');
            $articles = $stmt->fetchAll();

            return $articles;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $sqlquery = 
            "SELECT p.product_ID, p.name, p.price, p.image, p.category_ID, c.name as category_Name, 
            s.amount as amount 
                FROM product AS p
                    INNER JOIN category AS c
                        ON p.category_ID = c.category_ID
                    INNER JOIN stock AS s
                        ON p.product_ID = s.product_ID
                 WHERE p.product_ID = :id";

            $stmt = $this->connection->prepare($sqlquery);

            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Product');
            $product = $stmt->fetch();

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($product)
    {
        try {
            $stmt = $this->connection->prepare("INSERT into product (name, price, description, image, category_id) VALUES (?,?,?,?,?)");

            $stmt->execute([$product->name, $product->price, $product->description, $product->image, $product->category_id]);

            $product->id = $this->connection->lastInsertId();

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function update($product, $id)
    {
        try {
            $sqlquery = "UPDATE product SET name=:name, price=:price, image=:image, category_ID=:category WHERE product_ID=:id";
            $stmt = $this->connection->prepare($sqlquery);

            $stmt->bindParam(':name', $product->name);
            $stmt->bindParam('price', $product->price);
            $stmt->bindParam(':image', $product->image);
            $stmt->bindParam(':category', $product->category_ID);
            $stmt->bindParam(':id', $product->product_ID);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM product WHERE product_ID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
