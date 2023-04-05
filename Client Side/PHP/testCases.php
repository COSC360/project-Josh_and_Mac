<?php
use PHPUnit\Framework\TestCase;

class Tests extends PHPUnit\Framework\TestCase
{
    public function testDatabaseConnection()
    {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'gptdb2';
        
        $mockConnection = $this->getMockBuilder(mysqli::class)
                              ->disableOriginalConstructor()
                              ->getMock();

        $mockConnection->expects($this->once())
                       ->method('connect')
                       ->with($this->equalTo($DATABASE_HOST), $this->equalTo($DATABASE_USER), $this->equalTo($DATABASE_PASS), $this->equalTo($DATABASE_NAME))
                       ->will($this->returnValue(true));

        $con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        $this->assertTrue($con->connect_errno === 0);
    }
}
