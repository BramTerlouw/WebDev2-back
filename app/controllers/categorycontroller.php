<?php

namespace Controllers;

use Exception;
use Services\CategoryService;

class CategoryController extends Controller
{
    private $service;
    function __construct()
    {
        $this->service = new CategoryService();
    }

    public function getAll()
    {
        try {
            $categories = $this->service->getAll();
            $this->respond($categories);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
        $categories = $this->service->getAll();
        $this->respond($categories);
    }
}
