<?php
namespace Services;

use Repositories\StockRepository;

class StockService {

    private $repository;

    function __construct()
    {
        $this->repository = new StockRepository();
    }

    public function insert($data) {       
        return $this->repository->insert($data);        
    }
}

?>