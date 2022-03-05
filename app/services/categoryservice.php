<?php
namespace Services;

use Repositories\CategoryRepository;

class CategoryService {

    private $repository;
    function __construct()
    {
        $this->repository = new CategoryRepository();
    }

    public function getAll() {
        return $this->repository->getAll();
    }
}
?>