<?php

class ApeAbstractConnectionStub extends ApeAbstractConnection{

	public static $defaultResponse = '[{"time":"1234567890","raw":"pushed","data":{"value":"ok"}}]';
	
	protected function doSendRequest(ApeRequest $request){
		if($request->getParam('exception') == true){
			throw new ApeException('Triggered Exception');
		}elseif($request->getParam('null') == true){
			return NULL;
		}		
		return self::$defaultResponse;
	}


	public static function available(){
		return true;
	}


}
