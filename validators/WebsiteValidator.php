<?php
namespace Elitexp\AspNet\Validators;
use Elitexp\AspNet\Validators\RegexValidator;

class WebsiteValidator extends RegexValidator{	
	
	function SetValidationData($message,$params=array()){
				
		$pattern="^(http(s?):\/\/)?(www\.)?[a-zA-Z0-9\.\-\_]+(\.[a-zA-Z]{2,4})+(\/[a-zA-Z0-9\_\-\s\.\/\?\%\#\&\=]*)?$";
		parent::SetValidationData($message,[$pattern]);
		$this->errorMessage=$message;			
		if($this->errorMessage=='')
			$this->errorMessage="$this->field is not a valid website address.";
	}
	
}
?>