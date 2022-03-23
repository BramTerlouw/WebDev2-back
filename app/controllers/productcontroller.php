<?php

namespace Controllers;

use Exception;
use Services\ProductService;

class ProductController extends Controller
{
    private $service;
    function __construct() {
        $this->service = new ProductService();
    }


    // ## get all products
    public function getAll() {

        // verify token, no token => return
        $jwt = $this->verifyToken();
        if (!$jwt)
            return;

        $offset = NULL;
        $limit = NULL;

        // if exist, get offset and limit for paging
        if (isset($_GET['offset']) && isset($_GET['limit'])){
            $offset = $_GET['offset'];
            $limit = $_GET['limit'];
        }

        $products = $this->service->getAll($offset, $limit);
        $this->respond($products);
    }


    // ## get one product
    public function getOne($id) {
        try {
            $product = $this->service->getOne($id);
            if (!$product) {
                $this->respondWithError(404, "Product not found");
            } else {
                $this->respond($product);
            }
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }


    // ## update one product
    public function update($id) {
        try {
            $product = $this->createObjectFromPostedJson("Models\Product");
            $this->service->update($product, $id);
            $this->respond($product);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }


    // ## delete one product
    public function delete($id) {
        try {
            $this->service->delete($id);
            $this->respond(true);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }


    // ## create a new product
    public function create() {
        try {
            $product = $this->createObjectFromPostedJson("Models\\Product");
            $this->service->insert($product);
            $this->respond($product);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }
}
