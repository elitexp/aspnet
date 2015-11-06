<?php
namespace Elitexp\AspNet\Validators;
use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\AspNet\Validation\ClientValidationRule;
	class MaxValidator extends ValidationRule{
		private $max;
		
		function isValid($value){
			$err=new ValidationResult($this->errorMessage,$this->field);
			
			if(strlen($value)>$this->max)
				return $err;
			if(strlen($value)<$this->min)
				return $err;
			return true;
		}
		function SetValidationData($message,$params=array()){
			if(count($params)!=1)
				throw new \Exception("The parameters should be an array of max.");
			$this->max=$params[0];
			
			if($this->max=='')
				$this->max=0;
			if($this->errorMessage=='')
				$this->errorMessage="$this->field requires the value with minimum of $this->max";
		}

		function GetClientValidationRule(){
			$rule=new ClientValidationRule();
			$rule->errorMessage=$this->errorMessage;
			$rule->ValidationType="max";
			$rule->ValidationParameters['max']=$this->max;
			
			return $rule;
		}
		
	}
?>