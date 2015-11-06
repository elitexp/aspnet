<?php
namespace Elitexp\AspNet\Validators;

use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\AspNet\Validation\ValidationResult;
use Elitexp\AspNet\Validation\ClientValidationRule;

	class RequiredValidator extends ValidationRule{		
		
		function isValid($value){
			$err=new ValidationResult($this->errorMessage,$this->field);
			if($value==null || !isset($value))
				return $err;
			if(empty($value))
				return $err;

			return true;
		}

		function GetClientValidationRule(){
			$rule=new ClientValidationRule();
			$rule->ValidationType="required";
			$rule->errorMessage=$this->errorMessage;
			return $rule;
		}
		function SetValidationData($errorMessage,$params=array()){			
			$this->errorMessage=$errorMessage;
			if($this->errorMessage=='')
				$this->errorMessage="$this->field is a required field.";


		}
		
	}
?>