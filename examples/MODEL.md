## AspNet Model Example Generated

<b>Command: </b><i>php artisan make:aspnetmodel Client</i><br/>
<b>Generated File: </b><i>App/Client.php</i><br/>


<div style="background: #ffffff; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #557799">&lt;?php</span>

<span style="color: #008800; font-weight: bold">namespace</span> App;
<span style="color: #008800; font-weight: bold">use</span> Elitexp\AspNet\Model;

<span style="color: #008800; font-weight: bold">class</span> <span style="color: #BB0066; font-weight: bold">Client</span> <span style="color: #008800; font-weight: bold">extends</span> Model
{   

    <span style="color: #888888">/*</span>
<span style="color: #888888">        @table:     tablename where the model data is stored.</span>
<span style="color: #888888">    */</span>
    <span style="color: #008800; font-weight: bold">protected</span> <span style="color: #996633">$table</span><span style="color: #333333">=</span><span style="background-color: #fff0f0">&#39;clients&#39;</span>;

    <span style="color: #888888">/*</span>
<span style="color: #888888">        @fillable:  mass-assignable field names</span>
<span style="color: #888888">    */</span>
    <span style="color: #008800; font-weight: bold">protected</span> <span style="color: #996633">$fillable</span><span style="color: #333333">=</span>[<span style="background-color: #fff0f0">&quot;name&quot;</span>,<span style="background-color: #fff0f0">&quot;email&quot;</span>,<span style="background-color: #fff0f0">&quot;phone&quot;</span>,<span style="background-color: #fff0f0">&quot;mobile&quot;</span>];

    <span style="color: #888888">/*</span>
<span style="color: #888888">        @hidden:    excluded fields from JSON</span>
<span style="color: #888888">    */</span>
    <span style="color: #008800; font-weight: bold">protected</span> <span style="color: #996633">$hidden</span><span style="color: #333333">=</span>[<span style="background-color: #fff0f0">&quot;mobile&quot;</span>];

    <span style="color: #888888">/*</span>
<span style="color: #888888">        @guarded:   not mass-assignable field names</span>
<span style="color: #888888">    */</span>
    <span style="color: #008800; font-weight: bold">protected</span> <span style="color: #996633">$guarded</span><span style="color: #333333">=</span>[];

    <span style="color: #888888">/*</span>
<span style="color: #888888">        @rules: validation rules for reach field.</span>
<span style="color: #888888">        e.g. $rules=[</span>
<span style="color: #888888">                        &quot;name&quot;=&gt;&quot;required|between:5,8&quot;,</span>
<span style="color: #888888">                        &quot;email&quot;=&gt;&quot;required|email&quot;</span>
<span style="color: #888888">                    ];</span>
<span style="color: #888888">    */</span>
    <span style="color: #008800; font-weight: bold">public</span> <span style="color: #008800; font-weight: bold">static</span> <span style="color: #996633">$rules</span><span style="color: #333333">=</span>[
            <span style="background-color: #fff0f0">&quot;name&quot;</span><span style="color: #333333">=&gt;</span><span style="background-color: #fff0f0">&quot;required|between:5,128&quot;</span>,
            <span style="background-color: #fff0f0">&quot;email&quot;</span><span style="color: #333333">=&gt;</span><span style="background-color: #fff0f0">&quot;required|email&quot;</span>,            
        ];

    <span style="color: #888888">/*</span>
<span style="color: #888888">        @messages:  validation messages for reach field.</span>
<span style="color: #888888">        e.g. $messages=[</span>
<span style="color: #888888">                        &quot;name.required&quot;=&gt;&quot;Please enter your name.&quot;,</span>
<span style="color: #888888">                        &quot;email.email&quot;=&gt;&quot;Please enter email correctly.&quot;</span>
<span style="color: #888888">                    ];</span>
<span style="color: #888888">    */</span>
    <span style="color: #008800; font-weight: bold">public</span> <span style="color: #008800; font-weight: bold">static</span> <span style="color: #996633">$messages</span><span style="color: #333333">=</span>[
                            <span style="background-color: #fff0f0">&quot;name.required&quot;</span><span style="color: #333333">=&gt;</span><span style="background-color: #fff0f0">&quot;Please enter your name.&quot;</span>,
                            <span style="background-color: #fff0f0">&quot;name.between&quot;</span><span style="color: #333333">=&gt;</span><span style="background-color: #fff0f0">&quot;Name should be between 5 and 128 characters long.&quot;</span>,
                            <span style="background-color: #fff0f0">&quot;email.required&quot;</span><span style="color: #333333">=&gt;</span><span style="background-color: #fff0f0">&quot;Please enter your email address for contacting you.&quot;</span>,
                            <span style="background-color: #fff0f0">&quot;email.email&quot;</span><span style="color: #333333">=&gt;</span><span style="background-color: #fff0f0">&quot;Please enter email correctly.&quot;</span>
                        ];

}
</pre></div>
