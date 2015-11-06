<?php
namespace Elitexp\AspNet\Validators;
use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\AspNet\Validation\ClientValidationRule;
	class MinValidator extends ValidationRule{
		private $max, $min;
		
		function isValid($value){
			$err=new ValidationResult($this,$this->field);
			
			if(strlen($value)>$this->max)
				return $err;
			if(strlen($value)<$this->min)
				return $err;
			return true;
		}
		function SetValidationData($message,$params=array()){
			if(count($params)!=1)
				throw new \Exception("The parameters should be an array of min.");
			$this->min=$params[0];
			
			if($this->min=='')
				$this->min=0;
			if($this->errorMessage=='')
				$this->errorMessage="$this->field requires the value with minimum of $this->min";
		}

		function GetClientValidationRule(){
			$rule=new ClientValidationRule();
			$rule->errorMessage=$this->errorMessage;
			$rule->ValidationType="min";
			$rule->ValidationParameters['min']=$this->min;
			
			return $rule;
		}
		
	}
?>