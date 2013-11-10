<h1>Contactform(s)</h1>

			
<p>The contactform let's you:
    <ul>
    	<li>CRUD forms</li>
    	<li>Save all submitted forms</li>
    	<li>Save contactpersons</li>
    	<li>Customize the form</li>
    </ul>
</p>
			
			
	<h2>Databases</h2>
	
	<p>The Contactform library will automatically create the following databases:</p>
	
	<table class="table table-bordered">
		<tr>
			<th>Database name</th>
			<th>Description</th>
		</tr>
		
		<tr>
			<td><code>contactform_forms</code></td>
			<td>Storage for different kind of forms.</td>
		</tr>
		<tr>
			<td><code>contactform_fields</code></td>
			<td>Fields (inputs) assigned to a specific form.</td>
		</tr>
		<tr>
			<td><code>contactform_submitted</code></td>
			<td>Storage for submitted forms.</td>
		</tr>
		<tr>
			<td><code>contactform_contacts</code></td>
			<td>Storage for submitters.</td>
		</tr>
	</table>
	

			<h2>Example</h2>
			
			<pre class="prettyprint linenums">// load the library
$this->load->library("contactform");

// Customize form
$config[&quot;full_tag_open&quot;]  = &quot;&lt;div class='contactform'&gt;&quot;;
$config[&quot;full_tag_close&quot;] = &quot;&lt;/div&gt;&quot;;
$config[&quot;row_open&quot;]       = &quot;&lt;p class='row'&gt;&quot;;
$config[&quot;row_close&quot;]      = &quot;&lt;/p&gt;&quot;;
$config[&quot;submit_text&quot;]    = &quot;Submit this form&quot;;

// Load specific form
$config["form"]           = "Basic";
$config["subject"]        = "More information about product #123";	

// Create the form
$this->contactform->initialize($config);
echo $this->contactform->generate();</pre>


			<h2>Functions</h2>
			
			<h3>Retrieve all forms</h3>
			<p><pre class="prettyprint linenums">$this->contactform->all_forms( $view = false , $admin = false )</pre></p>
			<p><code>$view = false</code> Returns an object of all the forms created.</p>
			<p><code>$view = true</code> Returns a basic template with a list of the forms.</p>
			<p><code>$admin = true</code> Returns actions per item for an administrator.</p>
			
			 This you will most likely use in the admin area...
			
			<h3>Initialize form</h3>
			<p><pre class="prettyprint linenums">$this->contactform->initialize($config);</pre></p>
			<table class="table table-bordered">
				<tr>
					<th>Name</th>
					<th>Default</th>
					<th>Description</th>
				</tr>
				
				<tr>
					<td><code>$config["form"]</code></td>
					<td>Basic</td>
					<td>The name of the form you would like to generate.</td>
				</tr>
				<tr>
					<td><code>$config["full_tag_open"]</code></td>
					<td><code>&lt;div&gt;</code></td>
					<td>All the form-elements will be generated between this tag and the end tag.</td>
				</tr>
				
				<tr>
					<td><code>$config["full_tag_close"]</code></td>
					<td><code>&lt;/div&gt;</code></td>
					<td>The end tag closing the whole form.</td>
				</tr>
				<tr>
					<td><code>$config["row_open"]</code></td>
					<td><code>&lt;p&gt;</code></td>
					<td>The opening tag for each form-element.</td>
				</tr>
				
				<tr>
					<td><code>$config["row_close"]</code></td>
					<td><code>&lt;/p&gt;</code></td>
					<td>The closing tag for each form-element.</td>
				</tr>
				<tr>
					<td><code>$config["submit_text"]</code></td>
					<td>Submit form</td>
					<td><span class="label label-important">Dynamisch maken</span> The value text of the submit button.</td>
				</tr>
				<tr>
					<td><code>$config["action"]</code></td>
					<td>self</td>
					<td>The action attribute of the form-tag.
					<br/><b>Note:</b> if you customize the action path, you also need to load the Contactform library in the<br/>destination controller if you want to make use of the Contactform post handler.</td>
				</tr>
				<tr>
					<td><code>$config["method"]</code></td>
					<td>POST</td>
					<td>The method attribute of the form-tag.</td>
				</tr>
				<tr>
					<td><code>$config["submit"]</code></td>
					<td>null</td>
					<td>The method attribute of the form-tag.</td>
				</tr>
				<tr>
					<td><code>$config["subject"]</code></td>
					<td>null</td>
					<td>Subject of the form<br/><b>Note:</b> if you want the subject to be editable for the user, you need to have a field with value <b>subject</b>. <br/>
					This is included in the installed basic form.</td>
				</tr>
			</table>
			
			<h3>Generate form</h3>
			<p><code>$this->contactform->generate()</code></p>
			<p>Returns an object of all the forms created. This you will most likely use in the admin area...</p>

