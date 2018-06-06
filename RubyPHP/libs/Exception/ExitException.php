<?php

namespace Swoole\Exception;

class ExitException extends \Exception{
	public function __constructor($message, $code = 0){
		parent::__construct($message, $code);
	}

    public function __toString() {  
        return __CLASS__.':['.$this->code.']:'.$this->message.'\n';  
    }
}
