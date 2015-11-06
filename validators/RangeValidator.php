<?php
namespace Elitexp\AspNet\Validators;
use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\AspNet\Validation\ClientValidationRule;

	class RangeValidator extends ValidationRule{
		private $max, $min;
		
		function isValid($value){
			$err=new ValidationResult($this->errorMessage,$this->field);
			
			if(strlen($value)>$this->max)
				return $err;
			if(strlen($value)<$this->min)
				return $err;
			return true;
		}
		function SetValidationData($message,$params=array()){
			if(count($params)!=2)
				throw new \Exception("The parameters should be an array of min & max.");
			$this->min=$params[0];
			$this->max=$params[1];
			if($this->min=='')
				$this->min=0;
			$this->errorMessage=$message;
			if($this->errorMessage=='')
				$this->errorMessage="Please enter the value between $this->min and $this->max.";
		}

		function GetClientValidationRule(){
			$rule=new ClientValidationRule();
			$rule->errorMessage=$this->errorMessage;
			$rule->ValidationType="range";
			$rule->ValidationParameters['min']=$this->min;
			$rule->ValidationParameters['max']=$this->max;
			return $rule;
		}
		
	}
?>