<?php
namespace Elitexp\AspNet\Validators;

use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\AspNet\Validation\ClientValidationRule;
	class RemoteValidator extends ValidationRule{		
		private $url;
		private $additionalFields;
		
		function isValid($value){
			return true;
		}

		function GetClientValidationRule(){
			$rule=new ClientValidationRule();
			$rule->ValidationType="remote";
			$rule->ValidationParameters['url']=$this->url;
			$rule->ValidationParameters['additionalfields']=$this->additionalFields;
			$rule->errorMessage=$this->errorMessage;
			return $rule;
		}
		function SetValidationData($message,$params=array()){
			if(count($params)==0)
				throw new \Exception("Invalid Parameter for RemoteAttribute");
			$formBuilder=$this->app['form'];
			$this->url=$formBuilder->getAction(["url"=>$params[0]]);
			
			//Others are the additional fields
			$addFields="*.$this->field,";			
			for($index=1;$index<count($params);$index++){
				$addFields.="*.".$params[$index].",";
			}
			if(substr($addFields,strlen($addFields)-1,1)==',')
				$addFields=substr($addFields,0,strlen($addFields)-1);
			$this->additionalFields=$addFields;
			$this->errorMessage=$message;
			if($this->errorMessage=='')
				$this->errorMessage='Server validation failed.';
		}
		
	}
?>