<?php

require_once 'ApeAbstractConnectionTest.php';
require_once '../lib/ApeFileConnection.php';

class ApeFileConnectionTest extends ApeAbstractConnectionTest {


	protected $connection;

	protected function getConnection($port){
		return new ApeFileConnection(APE_PHP_CONNECTION_HOST, $port, APE_PHP_CONNECTION_PROTOCOL);	
	}
	
	
	protected function setUp(){	
		if (!@fsockopen(APE_PHP_CONNECTION_HOST, APE_PHP_CONNECTION_PORT, $errno, $errstr)) {
			//$this->fail('APE server is not running'); return;
			
			$this->markTestSkipped(
				sprintf(
					'APE server is not running on %s:%d.',
					APE_PHP_CONNECTION_HOST,
					APE_PHP_CONNECTION_PORT
				)
            );
        }	
		$this->connection = $this->getConnection(APE_PHP_CONNECTION_PORT);
		$this->request = new ApeRequest('doit');
	}
	
		
    public function testSendRequest(){
    	$res = $this->connection->sendRequest($this->request);
    	$this->assertTrue($res instanceof ApeResponse);	
    }

    public function testSendRequestExceptionReturnsNull(){
    	if (@fsockopen(APE_PHP_CONNECTION_HOST, APE_PHP_CONNECTION_FALSE_TEST_PORT, $errno, $errstr)) {
			$this->markTestSkipped(
				sprintf(
					'Could connect to server on %s:%d.',
					APE_PHP_CONNECTION_HOST,
					APE_PHP_CONNECTION_PORT
				)
            );
        }   	
    	$connection = new ApeFileConnection(APE_PHP_CONNECTION_HOST, APE_PHP_CONNECTION_FALSE_TEST_PORT, APE_PHP_CONNECTION_PROTOCOL);
        $res = $connection->sendRequest($this->request);
    	$this->assertEquals(NULL, $res);	
    }    

    public function testSendRequestReturnsNull(){
		return $this->testSendRequestExceptionReturnsNull();   	
    }    
    
    
	public function testAvailable(){
		ini_set('allow_url_fopen', 1);
		if(!(bool)ini_get('allow_url_fopen')){
			$this->markTestSkipped('"allow_url_fopen" not set in ini');
		}
		$this->assertTrue(ApeFileConnection::available());
	}




}