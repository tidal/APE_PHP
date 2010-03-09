<?php


require_once 'ApeClientTest.php';
require_once 'ApeResponseTest.php';
require_once 'ApeExceptionTest.php';
require_once 'ApeRequestTest.php';
require_once 'ApeAbstractConnectionTest.php';
require_once 'ApeFileConnectionTest.php';
require_once 'ApeCurlConnectionTest.php';

class APE_AllTests extends PHPUnit_Framework_TestSuite{


    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit Framework');
 
        $suite->addTestSuite('ApeClientTest');
        $suite->addTestSuite('ApeResponseTest');
        $suite->addTestSuite('ApeExceptionTest');
        $suite->addTestSuite('ApeRequestTest');
        $suite->addTestSuite('ApeAbstractConnectionTest');
        $suite->addTestSuite('ApeFileConnectionTest');
        $suite->addTestSuite('ApeCurlConnectionTest');
        return $suite;
    }

}