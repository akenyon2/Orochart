<?php

class GenericException extends Exception{
	public function errorMessage() {
    //error message
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
		.': <b>'.$this->getMessage().'</b> is not valid input.';
		return $errorMsg;
	}
}

class RegexException extends GenericException {}

class EmailException extends GenericException {}

class ProfileEmailMismatch extends GenericException {}

class ProfileEmailInvalid extends GenericException {}

class ProfileEmailExists extends GenericException {}

?>