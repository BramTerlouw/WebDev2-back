<?php

namespace Controllers;

use Exception;
use Services\StockService;

class StockController extends Controller
{
    private $service;
    function __construct()
    {
        $this->service = new StockService();
    }

    public function create()
    {
        try {
            $stock = $this->createObjectFromPostedJson("Models\Stock");
            $this->service->insert($stock);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($stock);
    }
}
