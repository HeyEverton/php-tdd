<?php 
namespace CodeTests\QueryBuilder;

use PHPUnit\Framework\TestCase;
use Code\QueryBuilder\Executor;
use Code\QueryBuilder\Query\Insert;

class ExecutorTest extends TestCase
{
    private static $conn = null;

    private static $executor;

    public static function setUpBeforeClass(): void
    {
        self::$conn = new \PDO(dsn: 'mysql:dbname=products;host=localhost',username:'root',password:'ruaViruri175');
        // self::$conn->exec("CREATE SCHEMA products");
        self::$conn->exec("
            CREATE TABLE IF NOT EXISTS products.products (
                id INTEGER PRIMARY KEY,
                name VARCHAR(255),
                price FLOAT,
                created_at TIMESTAMP,
                updated_at TIMESTAMP
            );
        ");
        self::$executor = new Executor(self::$conn);
    }

    public static function tearDownAfterClass(): void
    {
        // self::$conn->exec('DROP TABLE products.products');
        // self::$conn->exec('DROP SCHEMA products');
    }

    public function testInsertANewProductInADatabase()
    {
        $query = new Insert('products', ['id', 'name', 'price', 'created_at', 'updated_at']);
        self::$executor->setQuery($query);

        self::$executor->setParams(':name', 'Product 1')
                        ->setParams(':price', 19.99)
                        ->setParams(':id', 1)
                        ->setParams(':created_at', date('Y-m-d H:i:s'))
                        ->setParams(':updated_at', date('Y-m-d H:i:s'));

        $this->assertEquals(1, self::$executor->execute());
    }    
}