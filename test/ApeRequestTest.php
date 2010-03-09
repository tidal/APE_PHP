<?php
require_once 'PHPUnit/Framework.php';

require_once '../lib/ApeRequest.php';

/**
 * Test class for ApeRequest.
 */
class ApeRequestTest extends PHPUnit_Framework_TestCase {

	protected $request;
	
	
    protected function setUp(){
       $this->request = new ApeRequest('testcommand');
    }

    public function testSecondConstructorArgument(){
        $request = new ApeRequest($command, array('foo'=>'bar'));
		$this->assertEquals('bar', $request->getParam('foo')); 
    }    
    
    public function testGetRequestCommand(){
		$this->assertEquals('testcommand', $this->request->getRequestCommand()); 
    }

    public function testSetParam(){
    	$this->request->setParam('foo', 'bar');
    }

    public function testGetParam(){
    	$this->request->setParam('foo', 'bar');
    	$this->assertEquals('bar', $this->request->getParam('foo'));
    	$this->assertEquals(NULL, $this->request->getParam('bar'));
    }

    public function testSetParams(){
    	$params = array(
    		'foo' => 'bar',
    		'test' => 'test'
    	);
    	$this->request->setParams($params);
    }

    public function testGetParams(){
    	$params = array(
    		'foo' => 'bar',
    		'test' => 'test'
    	);
    	$this->request->setParams($params);
    	$this->assertEquals($params, $this->request->getParams());
    }

    public function testGetRequestData(){
        $cmd = 'testcommand';
    	$params = array(
    		'foo' => 'bar',
    		'test' => 'test'
    	);
    	$data = array( 
  			'cmd' => $cmd, 
  			'params' =>  $params 
		);
    	$this->request->setParams($params);
    	$this->assertEquals($data, $this->request->getRequestData());
    }

    public function testGetJsonString(){
        $cmd = 'testcommand';
    	$params = array(
    		'foo' => 'bar',
    		'test' => 'test'
    	);
    	$data = array( 
  			'cmd' => $cmd, 
  			'params' =>  $params 
		);
    	$this->request->setParams($params);
    	$json = json_encode(array($data));
    	$this->assertEquals($json, $this->request->getJsonString());
    }

    public function testGetUrlString(){
        $cmd = 'testcommand';
    	$params = array(
    		'foo' => 'bar',
    		'test' => 'test'
    	);
    	$data = array( 
  			'cmd' => $cmd, 
  			'params' =>  $params 
		);
    	$this->request->setParams($params);
    	$encoded = rawurlencode(json_encode(array($data)));
    	$this->assertEquals($encoded, $this->request->getUrlString());
    }
}
?>
