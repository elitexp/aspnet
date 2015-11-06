<?php
namespace Elitexp\AspNet\Validators;
use Elitexp\AspNet\Validators\RegexValidator;

class EmailValidator extends RegexValidator{	
	
	function SetValidationData($message,$params=array()){	
		parent::SetValidationData($message,["^[a-zA-Z][_a-zA-Z0-9-]*(\.[_a-zA-Z0-9-]+)*@[A-Za-z][A-Za-z0-9-]*(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$"]);
		$this->errorMessage=$message;			
		if($this->errorMessage=='')
			$this->errorMessage="$this->field is not a valid email.";
	}
	
}
?>