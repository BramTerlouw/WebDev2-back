<?php

namespace Controllers;

use Exception;
use Services\ProductService;

class ProductController extends Controller
{
    private $service;
    function __construct()
    {
        $this->service = new ProductService();
    }

    public function getAll()
    {
        $products = $this->service->getAll();
        $this->respond($products);
    }

    public function getOne($id)
    {
        $product = $this->service->getOne($id);

        if (!$product) {
            $this->respondWithError(404, "Product not found");
        } else {
            $this->respond($product);
        }
    }

    public function update($id)
    {
        try {
            $product = $this->createObjectFromPostedJson("Models\Product");
            $this->service->update($product, $product->product_ID);
            $this->respond($product);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->service->delete($id);
            $this->respond(true);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }





    public function create()
    {
        try {
            $product = $this->createObjectFromPostedJson("Models\Product");
            // something is missing. Shouldn't we update the product in the DB?

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($product);
    }
}
