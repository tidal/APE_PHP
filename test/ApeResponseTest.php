<?php
require_once 'PHPUnit/Framework.php';

require_once '../lib/ApeResponse.php';
require_once '../lib/ApeException.php';

class ApeResponseTest extends PHPUnit_Framework_TestCase {
    /**
     * @var ApeResponse
     */
    protected $testJSON = '[{"time":"1234567890","raw":"pushed","data":{"value":"ok"}}]';
    protected $errJSON = '[{"time":"1234567890","raw":"ERR","data":{"code":"401", "value":"UNKNOWN_CHANNEL"}}]';


    public function testConstruction(){
    	$response = new ApeResponse($this->testJSON);
    }

    public function testIsSuccess(){
       $response = new ApeResponse($this->testJSON);
       $this->assertTrue($response->isSuccess());
    }
    
    public function testConstructionEmptyResponse(){
    	$response = new ApeResponse('');
    	$this->assertFalse($response->isSuccess());
    }    

    public function testConstructionMisformattedResponse(){
    	$response = new ApeResponse("['success'=>'true', 'data'=>'foo'}]");
    	$this->assertFalse($response->isSuccess());
    }     

    public function testApeResponseError(){
    	$response = new ApeResponse($this->errJSON);
    	$this->assertFalse($response->isSuccess());
    }     

    public function testGetResult(){
        $result = array_shift(json_decode($this->testJSON));
     	$response = new ApeResponse($this->testJSON);
    	$this->assertEquals($result, $response->getResult());   	
    }

    public function testGetRawResult(){
     	$response = new ApeResponse($this->testJSON);
    	$this->assertEquals($this->testJSON, $response->getRawResult());
    }
}
?>
