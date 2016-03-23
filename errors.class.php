<?php
class Errors{
	public $err;

	public function __construct($e){
		$this->err = $e;
	}

	public function overwrite($e){
		$this->err = $e;
	}

	public function get(){
		return $this->err;
	}
}
?>