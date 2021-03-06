<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class ProductRepository extends Repository
{

    // ## get all products
    // params: offset, limit
    function getAll($offset = NULL, $limit = NULL) {
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

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\Product');
            $products = $stmt->fetchAll();

            return $products;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    // ## get one product
    // params: id
    function getOne($id) {
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

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\Product');
            $product = $stmt->fetch();

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    // ## update an existing product
    // params: product, id
    function update($product, $id) {
        try {
            $sqlquery = "UPDATE product SET name=:name, price=:price, image=:image, category_ID=:category WHERE product_ID=:id";
            $stmt = $this->connection->prepare($sqlquery);

            $stmt->bindParam(':name', $product->name);
            $stmt->bindParam('price', $product->price);
            $stmt->bindParam(':image', $product->image);
            $stmt->bindParam(':category', $product->category_ID);
            $stmt->bindParam(':id', $product->product_ID);

            $stmt->execute();
            return $this->getOne($product->product_ID);

        } catch (PDOException $e) {
            echo $e;
        }
    }


    // ## delete a product
    // params: id
    function delete($id) {
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


    // ## insert a new product
    // params: product
    function insert($product) {
        try {
            $sqlquery = "INSERT into product (name, price, category_ID, image) VALUES (:name, :price, :category, :image)";
            $stmt = $this->connection->prepare($sqlquery);

            $stmt->bindParam(':name', $product->name);
            $stmt->bindParam('price', $product->price);
            $stmt->bindParam(':category', $product->category_ID);
            $stmt->bindParam(':image', $product->image);

            $stmt->execute();

            $product->product_ID = $this->connection->lastInsertId();
            return $product;

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
