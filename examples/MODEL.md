## AspNet Model Example Generated

<b>Command: </b><i>php artisan make:aspnetmodel Client</i><br/>
<b>Generated File: </b><i>App/Client.php</i><br/>


<pre>
&lt;?php

namespace App;
use Elitexp\AspNet\Model;

class Test extends Model
{   

	/*
		@table: 	tablename where the model data is stored.
	*/
    protected $table='tests';

    /*
    	@fillable:	mass-assignable field names
    */
    protected $fillable=[];

    /*
    	@hidden:	excluded fields from JSON
    */
    protected $hidden=[];

    /*
    	@guarded:	not mass-assignable field names
    */
    protected $guarded=[];

    /*
    	@rules:	validation rules for reach field.
    	e.g. $rules=[
    					"name"=>"required|between:5,8",
    					"email"=>"required|email"
    				];
    */
    public static $rules=[];

    /*
    	@messages:	validation messages for reach field.
    	e.g. $messages=[
    					"name.required"=>"Please enter your name.",
    					"email.email"=>"Please enter email correctly."
    				];
    */
    public static $messages=[];

}

</pre>