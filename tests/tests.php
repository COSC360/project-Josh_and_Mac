<?php
use PHPUnit\Framework\TestCase;
include "connectDB2.php";
class Tests extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

     /**
     * Tests connectDB() function against making a manual connection
     * @return void
     */
    public function testDatabaseConnection() {
        // set up expected connection
        $expected = mysqli_connect('localhost', 'root', '', 'gptdb2');
        
        // call to our connectToDatabase function
        $result = connectToDatabase();
    
        // Assert equals
        $this->assertEquals($expected->connect_errno, $result->connect_errno);
        $this->assertEquals($expected->connect_error, $result->connect_error);
        $this->assertEquals($expected->errno, $result->errno);
        $this->assertEquals($expected->error, $result->error);
        
        
        // Close the database connection
        mysqli_close($expected);
    }

    public function testDataBaseConnection2(){
        $result = connectToDatabase(); 
       $this->assertEquals($result->connect_errno, 0);
    }
    
    
    
    
    
    
}
