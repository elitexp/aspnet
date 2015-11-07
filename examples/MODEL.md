## AspNet Model Example Generated

<u>Command:</u><i>php artisan <b>make:aspnetmodel</b> Client</i><br/>
<u>Generated File:</u><i>App/Client.php</i><br/>


<pre>
<?php

namespace App;

use Elitexp\AspNet\Model;

class Client extends Model
{
    //
    protected $table='clients';
    
    protected $fillable=['name','phone','mobile'];

    //protected $hidden=['created_at','updated_at'];

    public static $rules=array(
    		"name"=>"required|website",
    		"next"=>"remote:/clients/test,name,_token" 		

    	);
    public static $messages=[
    	"name.required"=>"Please enter your website address.",
    	"name.website"=>"Please provide your website address correctly.",
    	"next.remote"=>"The next field validation failed from the server."
    ];
}
</pre>