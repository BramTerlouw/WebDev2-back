<?php
namespace Services;

use Repositories\StockRepository;

class StockService {

    private $repository;
    function __construct() {
        $this->repository = new StockRepository();
    }


    // ## insert new stock
    // params: stock
    public function insert($stock) {       
        return $this->repository->insert($stock);        
    }
}
?>