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
        $categories = $this->service->getAll();
        $this->respond($categories);
    }
}
