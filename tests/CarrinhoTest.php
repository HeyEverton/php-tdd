<?php

namespace Code;

use PHPUnit\Framework\TestCase;

class CarrinhoTest extends TestCase
{
    public function testSeClasseCarrinhoExiste()
    {
        $classe = class_exists('\\Code\\Carrinho');
        $this->assertTrue($classe);
    }

    public function testAdicaoDeProdutosNoCarrinho()
    {
        $produto = new Produto();
        $produto->setName('Produto Teste');
        $produto->setPrice(19.99);
        $produto->setSlug('produto-teste');

        $produto2 = new Produto();
        $produto2->setName('Produto Teste2');
        $produto2->setPrice(19.90);
        $produto2->setSlug('produto-teste2');


        $carrinho = new Carrinho();
        $carrinho->addProduto($produto);
        $carrinho->addProduto($produto2);

        $this->assertIsArray($carrinho->getProdutos());
        $this->assertInstanceOf('\\Code\\Produto', $carrinho->getProdutos()[0]);
        $this->assertInstanceOf('\\Code\\Produto', $carrinho->getProdutos()[1]);
    }

    public function testSeValoresDeProdutosNoCarrinhoEstaoCorretosConformePassados()
    {
        $produto = new Produto();
        $produto->setName('Produto Teste');
        $produto->setPrice(19.99);
        $produto->setSlug('produto-teste');

        $carrinho = new Carrinho();
        $carrinho->addProduto($produto);

        $this->assertEquals('Produto Teste', $carrinho->getProdutos()[0]->getName());
        $this->assertEquals(19.99, $carrinho->getProdutos()[0]->getPrice());
        $this->assertEquals('produto-teste', $carrinho->getProdutos()[0]->getSlug());
    }

    public function testeSeTotalDeProdutosEValorDaCompraEstaoCorretos()
    {
        $produto = new Produto();
        $produto->setName('Produto Teste');
        $produto->setPrice(19.99);
        $produto->setSlug('produto-teste');

        $produto2 = new Produto();
        $produto2->setName('Produto Teste2');
        $produto2->setPrice(19.90);
        $produto2->setSlug('produto-teste2');


        $carrinho = new Carrinho();
        $carrinho->addProduto($produto);
        $carrinho->addProduto($produto2);

        $this->assertEquals(2, $carrinho->getTotalProdutos());
        $this->assertEquals(39.89, $carrinho->getTotalCompra());
        
    }
}