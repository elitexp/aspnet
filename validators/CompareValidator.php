<?php
namespace Elitexp\AspNet\Validators;

use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\AspNet\Validation\ValidationResult;
use Elitexp\AspNet\Validation\ClientValidationRule;

	class CompareValidator extends ValidationRule{	
		
		private $other;
		
		function isValid($value){
			$ret=true;
			$err=new ValidationResult($this->errorMessage,$this->field);
			$otherValue=$this->getModelValueAttribute($this->other);
			if($value!=$otherValue)
				return $err;
			return $ret;
		}

		function GetClientValidationRule(){
			$rule=new ClientValidationRule();
			$rule->ValidationType="equalto";
			$rule->ValidationParameters['other']="*.$this->other";
			$rule->errorMessage=$this->errorMessage;
			return $rule;
		}
		function SetValidationData($message,$params=array()){
			if(count($params)!=1)
				throw new \Exception("Invalid Parameter for CompareAttribute");
			$this->other=$params[0];
			$this->errorMessage=$message;
			if($this->errorMessage=="")
				$this->errorMessage="$this->field and $this->other fields do not match";
		}
		
	}
?>