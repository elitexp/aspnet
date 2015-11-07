## AspNet Model Example Generated

<b>Command: </b><i>php artisan make:aspnetmodel Client</i><br/>
<b>Generated File: </b><i>App/Client.php</i><br/>


<pre>
&lt;?php

namespace App;
use Elitexp\AspNet\Model;

class Client extends Model
{   

    /*
        @table:     tablename where the model data is stored.
    */
    protected $table='clients';

    /*
        @fillable:  mass-assignable field names
    */
    protected $fillable=["name","email","phone","mobile"];

    /*
        @hidden:    excluded fields from JSON
    */
    protected $hidden=["mobile"];

    /*
        @guarded:   not mass-assignable field names
    */
    protected $guarded=[];

    /*
        @rules: validation rules for reach field.
        e.g. $rules=[
                        "name"=>"required|between:5,8",
                        "email"=>"required|email"
                    ];
    */
    public static $rules=[
            "name"=>"required|between:5,128",
            "email"=>"required|email",            
        ];

    /*
        @messages:  validation messages for reach field.
        e.g. $messages=[
                        "name.required"=>"Please enter your name.",
                        "email.email"=>"Please enter email correctly."
                    ];
    */
    public static $messages=[
                            "name.required"=>"Please enter your name.",
                            "name.between"=>"Name should be between 5 and 128 characters long.",
                            "email.required"=>"Please enter your email address for contacting you.",
                            "email.email"=>"Please enter email correctly."
                        ];

}

</pre>