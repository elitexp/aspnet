<?php 
namespace Elitexp\AspNet\Validation;

abstract class ValidationAttribute{
		protected $errorMessage;
		protected $field;
		
		abstract function isValid($value);
	}

?>