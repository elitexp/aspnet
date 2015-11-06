<?php
namespace Elitexp\AspNet\Validation;
class ValidationResult{
	/**
	* errorMessage: The error message from the server side validation
	*/
	public $errorMessage;

	/**
	* field: The property of the model against which the validation failed.
	*/
	public $field;

	

	function __construct($errorMessage,$field){
		$this->errorMessage=$errorMessage;
		$this->field=$field;
	}
}
?>