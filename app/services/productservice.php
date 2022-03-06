<?php
namespace Services;

use Repositories\ProductRepository;

class ProductService {

    private $repository;

    function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function getAll($offset = NULL, $limit = NULL) {
        return $this->repository->getAll($offset, $limit);
    }

    public function getOne($id) {
        return $this->repository->getOne($id);
    }

    public function insert($data) {       
        return $this->repository->insert($data);        
    }

    public function update($data, $id) {       
        $this->repository->update($data, $id);        
    }

    public function delete($data) {       
        return $this->repository->delete($data);        
    }
}

?>