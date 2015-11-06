<?php
namespace Elitexp\AspNet\Validators;

use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\AspNet\Validation\ValidationResult;
use Elitexp\AspNet\Validation\ClientValidationRule;

	class RegexValidator extends ValidationRule{		
		public $pattern;
		
		function isValid($value){			
			$err=new ValidationResult($this->errorMessage,$this->field);
			$ret=preg_match_all("/$this->pattern/",$value,$matches,PREG_SET_ORDER);

			//dd($matches);
			if(count($matches)==0)
				return $err;
			$ret=$matches[0][0];
			if(strlen($ret)==strlen($value))
				return true;
			return $err;
		}

		function GetClientValidationRule(){
			$rule=new ClientValidationRule();
			$rule->ValidationType="regex";
			$rule->ValidationParameters['pattern']=$this->pattern;
			$rule->errorMessage=$this->errorMessage;			
			return $rule;
		}
		function SetValidationData($message,$params=array()){

		if(count($params)!=1)
			throw new \Exception("Regex Validation expects a parameter of regex pattern");		
			$this->errorMessage=$message;			
			if($this->errorMessage=='')
				$this->errorMessage="$this->field doesn't match the given pattern.";
			$this->pattern=$params[0];
		}
		
	}
?>