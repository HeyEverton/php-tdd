<?php 
namespace CodeTests\Controller;

class ProductController
{
    public function index()
    {
        return 'Controller Product';
    }

    public function show($id)
    {
        return 'Rota com parametro & parametro é igual a ' . $id;
    }

}