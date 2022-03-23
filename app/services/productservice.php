<?php
namespace Services;

use Repositories\ProductRepository;

class ProductService {

    private $repository;
    function __construct() {
        $this->repository = new ProductRepository();
    }


    // ## get all products
    // params: offset, limit
    public function getAll($offset = NULL, $limit = NULL) {
        return $this->repository->getAll($offset, $limit);
    }


    // ## get one product
    // params: id
    public function getOne($id) {
        return $this->repository->getOne($id);
    }


    // ## insert new product
    // params: product
    public function insert($product) {       
        return $this->repository->insert($product);        
    }


    // ## update existing product
    // params: product, id
    public function update($product, $id) {       
        $this->repository->update($product, $id);        
    }


    // ## delete a product
    // params: id
    public function delete($id) {       
        return $this->repository->delete($id);        
    }
}
?>