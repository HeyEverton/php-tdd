<?php 
namespace CodeTests\QueryBuilder\Query;

use Code\QueryBuilder\Query\Insert;
use PHPUnit\Framework\TestCase;


class InsertTest extends TestCase
{
    private $insert;
    protected function assertPreConditions(): void
    {
        $this->assertTrue(class_exists(Insert::class));
    }
    protected function setUp(): void
    {
        $this->insert = new Insert('products', ['name', 'price']);
    }

    public function testIfQueryInsertionHasGeneratedWithSuccess()
    {
        $sql = 'INSERT INTO products(name, price) VALUES(:name, :price)';
        $sql2 = 'INSERT INTO products VALUES(:name, :price)';

        $this->assertEquals($sql, $this->insert->getSql());
        
    }
}