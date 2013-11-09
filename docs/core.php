<h1>Core</h1>
			
	<p>
		<ul>
			<li>CRUD page configuration</li>
		</ul>
	</p>

	
	<h2>Databases</h2>
	
	<p>The Core library will automatically create the following databases when installing Bookcase:</p>
	
	<table class="table table-bordered">
		<tr>
			<th>Database name</th>
			<th>Description</th>
		</tr>
		
		<tr>
			<td><code>core_settings</code></td>
			<td>Provide a database for the website's basic settings.</td>
		</tr>
		<tr>
			<td><code>core_pages</code></td>
			<td>Provide a database to store the pages.</td>
		</tr>
		<tr>
			<td><code>core_admins</code></td>
			<td>Provide a database to store administrators.</td>
		</tr>
		<tr>
			<td><code>core_admins_roles</code></td>
			<td>Provide a database for administrator permissions.</td>
		</tr>
	</table>
	
	<h2>Example</h2>
	
	<p>So, the designer provides us with some awesome templates. For every page, there could be a controller. <br/>Let's say we're going to create a controller for the homepage.</p>
	<div class="alert"><b>Notice:</b> the Core library is autoloaded in Bookcase!</div>
	
	<pre class="prettyprint linenums">&lt;?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Index extends CI_Controller {
	
        public function __construct()
        {
            parent::__construct();
        }
		 
        public function index()
        {
            $config[&quot;page&quot;] = &quot;homepage&quot;;
            $this-&gt;core-&gt;initialize($config);
            			
            $this-&gt;load-&gt;view('homepage_template');
        }
        
}</pre>

	<div class="alert"><b>Notice:</b> you should always initialize the core class as last, since it has some parameters set in other libraries!</div>
	
	<p>If you now browse to the controller's url, you can see that:
	<ul>
		<li>a new row has been added in the <code>core_settings</code> database. Here you can now easily store your general website settings.<br/>
		(It will only add a row the first time you visit your website)</li>
		<li>a new row has been added in the <code>core_pages</code> database.	This can be handy for further (stored) configuration per page.</li>
	</ul>
	</p>
	
	<div class="alert alert-error"><strong>Update:</strong> generate form to edit the settings.</div>
	
	<h2>Use settings</h2>
	
	<p>So we created a page via the controller, and thus we got our general settings saved in the database. Let's use these...
		<br/>In the controller we just created, we are loading the view <code>homepage_template</code>.</p>
	
	<pre class="prettyprint linenums">&lt;html&gt;
    &lt;head&gt;
        &lt;?=$this-&gt;core-&gt;metatags();?&gt;
    &lt;/head&gt;
	
    &lt;body&gt;
        &lt;? // Load content here ?&gt;
    &lt;/body&gt;
&lt;/html&gt;</pre>

	<p>If you now look at the source of your webpage (or element inspector), you can see a bunch of metatags are automatically added to the header. This gives you a great SEO advantage!</p>
	
	<h2>Load metatags</h2>
	
	<pre class="prettyprint linenums">$this->core->metatags()</pre>
	
	<h2>Load scripts</h2>
	<pre class="prettyprint linenums">$this->core->scripts( "jquery" );
$this->core->scripts( array( "jquery", "modernizr" ) );</pre>
	
	<table class="table table-bordered">
		<tr>
			<th>Supported scripts</th>
			<th>About</th>
		</tr>
		
		<tr> <td> <code>jquery</code>    </td> <td><a href="http://jquery.com" title="jQuery">Visit website</a></td></tr>
		<tr> <td> <code>jqueryui</code>  </td> <td><a href="http://jqueryui.com" title="jQuery UI">Visit website</a></td></tr>
		<tr> <td> <code>modernizr</code> </td> <td><a href="http://www.modernizr.com" title="Modernizr">Visit website</a></td></tr>
		<tr> <td> <code>maps</code>      </td> <td><a href="https://developers.google.com/maps/" title="Google Maps API">Visit website</a></td></tr>
		<tr> <td> <code>uploadify</code> </td> <td><a href="http://www.uploadify.com" title="Uploadify">Visit website</a></td></tr>
	</table>
	
	<h2>Pages overview</h2>

	<pre class="prettyprint linenums">$this->core->all_pages( $view = false, $admin = false )</pre>

	<div class="alert alert-error"><strong>Update:</strong> initialize custom template configuration.</div>
	
	<table class="table table-bordered">
		<tr>
			<th>Parameters</th>
			<th>Description</th>
		</tr>
		
		<tr> <td> <code>$view = false</code> </td> <td>Returns an object of all the pages.</td></tr>
		<tr> <td> <code>$view = true</code>  </td> <td>Returns an overview of all the pages in a predefined template.</td></tr>
		<tr> <td> <code>$admin = true</code> </td> <td>Enables adminstrator CRUD.</td></tr>
	</table>
	
	<div class="btn-group">
		<button class="btn" style="float:right;"><a href="?page=contactform">Contactforms library &rarr;</a></button>
	</div>