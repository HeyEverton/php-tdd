<?php

namespace Code;

use PHPUnit\Framework\TestCase;

class CarrinhoTest extends TestCase
{
    private $carrinho;
    private $produto;

    public function setUp() : void
    {
        $this->carrinho = new Carrinho();
        $this->produto = new Produto();
    }

    public function tearDown() : void
    {
        unset($this->carrinho);
        unset($this->produto);
    }

    // public function testSeClasseCarrinhoExiste()
    // {
    //     $classe = class_exists('\\Code\\Carrinho');
    //     $this->assertTrue($classe);
    // }

    protected function assertPreConditions() : void
    {
        $classe = class_exists('\\Code\\Carrinho');
        $this->assertTrue($classe);
    }

    protected function assertPosConditions() : void
    {
        
    }

    public function testAdicaoDeProdutosNoCarrinho()
    {
        $produto = $this->produto;
        $produto->setName('Produto Teste');
        $produto->setPrice(19.99);
        $produto->setSlug('produto-teste');

        $produto2 = $this->produto;
        $produto2->setName('Produto Teste2');
        $produto2->setPrice(19.90);
        $produto2->setSlug('produto-teste2');


        $carrinho = $this->carrinho;
        $carrinho->addProduto($produto);
        $carrinho->addProduto($produto2);

        $this->assertIsArray($carrinho->getProdutos());
        $this->assertInstanceOf('\\Code\\Produto', $carrinho->getProdutos()[0]);
        $this->assertInstanceOf('\\Code\\Produto', $carrinho->getProdutos()[1]);
    }

    public function testSeValoresDeProdutosNoCarrinhoEstaoCorretosConformePassados()
    {
        $produto = $this->produto;
        $produto->setName('Produto Teste');
        $produto->setPrice(19.99);
        $produto->setSlug('produto-teste');

        $carrinho = $this->carrinho;
        $carrinho->addProduto($produto);

        $this->assertEquals('Produto Teste', $carrinho->getProdutos()[0]->getName());
        $this->assertEquals(19.99, $carrinho->getProdutos()[0]->getPrice());
        $this->assertEquals('produto-teste', $carrinho->getProdutos()[0]->getSlug());
    }

    public function testeSeTotalDeProdutosEValorDaCompraEstaoCorretos()
    {
        $produto = $this->produto;
        $produto->setName('Produto Teste');
        $produto->setPrice(19.99);
        $produto->setSlug('produto-teste');

        $produto2 = $this->produto;
        $produto2->setName('Produto Teste2');
        $produto2->setPrice(19.99);
        $produto2->setSlug('produto-teste2');


        $carrinho = $this->carrinho;
        $carrinho->addProduto($produto);
        $carrinho->addProduto($produto2);

        $this->assertEquals(2, $carrinho->getTotalProdutos());
        $this->assertEquals(39.98, $carrinho->getTotalCompra());
        
    }

    public function testIncompleto()
    {
        $this->assertTrue(true);
        $this->markTestIncomplete('Este teste ainda não está completo');
    }

    public function testSeFeatureEspecificaParaVersaoPHP81TrabalhaDeFormaEsperada()
    {
        if(PHP_VERSION != 8.1) {
            $this->markTestSkipped('Este teste foi pulado');
        }
        
        $this->assertTrue(true);
    }
}
