<?php

namespace Code;

use PHPUnit\Framework\TestCase;

class CarrinhoTest extends TestCase
{
    private $carrinho;
    private $produto;

    public function setUp(): void
    {
        $this->carrinho = new Carrinho();
    }

    public function tearDown(): void
    {
        unset($this->carrinho);
    }

    // public function testSeClasseCarrinhoExiste()
    // {
    //     $classe = class_exists('\\Code\\Carrinho');
    //     $this->assertTrue($classe);
    // }

    protected function assertPreConditions(): void
    {
        $classe = class_exists('\\Code\\Carrinho');
        $this->assertTrue($classe);
    }

    protected function assertPosConditions(): void
    {
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


        $carrinho = $this->carrinho;
        $carrinho->addProduto($produto);
        $carrinho->addProduto($produto2);

        $this->assertIsArray($carrinho->getProdutos());
        $this->assertInstanceOf('\\Code\\Produto', $carrinho->getProdutos()[0]);
        $this->assertInstanceOf('\\Code\\Produto', $carrinho->getProdutos()[1]);
    }

    public function testSeValoresDeProdutosNoCarrinhoEstaoCorretosConformePassados()
    {
        // $produto = $this->produto;
        // $produto->setName('Produto Teste');
        // $produto->setPrice(19.99);
        // $produto->setSlug('produto-teste');


        $produtoStub = $this->getStubProduto();

        $carrinho = $this->carrinho;
        $carrinho->addProduto($produtoStub);

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
        $produto2->setPrice(29.99);
        $produto2->setSlug('produto-teste2');

        $produto3 = new Produto();
        $produto3->setName('Produto Teste3');
        $produto3->setPrice(1);
        $produto3->setSlug('produto-teste3');


        $carrinho = $this->carrinho;
        $carrinho->addProduto($produto);
        $carrinho->addProduto($produto2);
        $carrinho->addProduto($produto3);

        $this->assertEquals(3, $carrinho->getTotalProdutos());
        $this->assertEquals(50.98, $carrinho->getTotalCompra());
    }

    // public function testIncompleto()
    // {
    //     $this->assertTrue(true);
    //     $this->markTestIncomplete('Este teste ainda não está completo');
    // }

    /*
     *   @requires PHP == 8.1.6
     * 
     */
    // public function testSeFeatureEspecificaParaVersaoPHP81TrabalhaDeFormaEsperada()
    // {
        // if(PHP_VERSION != 8.1) {
        //     $this->markTestSkipped('Este teste foi pulado');
        // }

    //     $this->assertTrue(true);
    // }

    public function testSeLogESalvoQuandoInformadoParaAdicaoDeProduto()
    {
        $carrinho = new Carrinho();

        $logMock = $this->getMockBuilder(Log::class)->setMethods(['log'])->getMock();

        $logMock->expects($this->once())->method('log')->with($this->equalTo('Adicionando produto no carrinho'));

        $carrinho->addProduto($this->getStubProduto(), $logMock);
    }

    private function getStubProduto()
    {
        $produtoStub = $this->createMock(Produto::class);
        $produtoStub->method('getName')->willReturn('Produto Teste');
        $produtoStub->method('getPrice')->willReturn(19.99);
        $produtoStub->method('getSlug')->willReturn('produto-teste');

        return $produtoStub;
    }
}
