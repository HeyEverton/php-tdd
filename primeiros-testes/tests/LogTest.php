<?php 
namespace Code;

use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    protected function assertPreConditions() : void
    {
        $this->assertTrue(class_exists(Log::class));
    }

    public function testSeOLogEFeitoComSucesso()
    {
        $log = new Log();



        $this->assertEquals('Logando dados no sistema: Testando save de log no sistema', $log->log('Testando save de log no sistema'));
    }
}