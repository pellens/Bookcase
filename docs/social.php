<h1>Social (media)</h1>

	<ul>
	<li>Why do we need a Facebook app id and secret?</li>
	</ul>
		
	<p>The Social library let's you:
		<ul>
			<li>Load social media JavaScripts</li>
			<li>Display share buttons</li>
			<li>Add Open Graph properties</li>
		</ul>
	</p>


<h2>Example</h2>
			
<h3>Controller</h3>
<pre class="prettyprint linenums">// load the library
$this->load->library("social");

// Facebook like button settings
$config[&quot;fb_app_id&quot;] = &quot;a1b2c3d4&quot;;
$config[&quot;fb_layout&quot;] = &quot;button_count&quot;;

$this->social->initialize($config);</pre>

			<h3>View</h3>
			<pre class="prettyprint linenums">&lt;html&gt;
	&lt;head&gt;
		&lt;?=$this-&gt;social-&gt;load_scripts(&quot;facebook&quot;);?&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;?=$this-&gt;social-&gt;facebook_like();?&gt;
	&lt;/body&gt;
&lt;/html&gt;</pre>

		
		<h2>Functions</h2>
		
		<h3>Loading scripts</h3>
		
		<p><pre class="prettyprint linenums">$this->social->load_scripts( $platform );</pre></p>
		
		<table class="table table-bordered">
			<tr>
			    <th>Name</th>
			    <th>Default</th>
			    <th>Options</th>
			</tr>
			<tr>
				<td><code>$platform</td>
				<td>none</td>
				<td>facebook | google | twitter | pinterest</td>
			</tr>
		</table>

		<p>You can also load the scripts during the configuration:</p>
		<p><pre class="prettyprint linenums">$config["scripts"] = array("facebook","twitter");
$this->social->initialize($config);

echo $this->social->load_scripts();</pre></p>
		
		<h3>Configuration</h3>
		
		<p><pre class="prettyprint linenums">$this->social->initialize( $config );</pre></p>
		
		<table class="table table-bordered">
			<tr>
			    <th>Name</th>
			    <th>Default</th>
			    <th>Description</th>
			</tr>
			<tr>
				<td colspan="3">General</td>
			</tr>
			<tr>
				<td><code>$config["url"]</code></td>
				<td>current_url</td>
				<td>Set u custom url to share.</td>
			</tr>
			<tr>
				<td><code>$config["scripts"]</code></td>
				<td>none</td>
				<td>facebook | google | twitter | pinterest</td>
			</tr>
			
			<tr>
				<td colspan="3">Facebook</td>
			</tr>
			<tr>
				<td><code>$config["fb_app_id"]</code></td>
				<td>none</td>
				<td>Set your website's application id.</td>
			</tr>
			<tr>
				<td><code>$config["fb_layout"]</code></td>
				<td>button_count</td>
				<td>standard | button_count | box_count</td>
			</tr>
			<tr>
				<td><code>$config["fb_send_button"]</code></td>
				<td>false</td>
				<td>Include the send button or not.</td>
			</tr>
			<tr>
				<td><code>$config["fb_width"]</code></td>
				<td>100</td>
				<td>Set the size of the like button (without px)</td>
			</tr>
			<tr>
				<td><code>$config["fb_action"]</code></td>
				<td>like</td>
				<td>like | recommend</td>
			</tr>
			<tr>
				<td><code>$config["fb_show_faces"]</code></td>
				<td>false</td>
				<td>Show friends that like this page or not.</td>
			</tr>
			<tr>
				<td><code>$config["fb_font"]</code></td>
				<td>arial</td>
				<td>arial | lucida grande | trebuchet ms | segoe ui | tahoma | verdana</td>
			</tr>
			
			<tr>
				<td colspan="3">Google</td>
			</tr>
			<tr>
				<td><code>$config["google_annotation"]</code></td>
				<td>none</td>
				<td>The name of the form you would like to generate.</td>
			</tr>
			<tr>
				<td><code>$config["google_size"]</code></td>
				<td>medium</td>
				<td>The name of the form you would like to generate.</td>
			</tr>
			<tr>
				<td><code>$config["google_callback"]</code></td>
				<td>none</td>
				<td>You can set a custom callback function.</td>
			</tr>
		</table>
		
		<h3>Share buttons</h3>
		
		<p><pre class="prettyprint linenums">echo $this->social->facebook_like( $url );
echo $this->social->google_button( $url );
echo $this->social->twitter_button( $url );
echo $this->social->pinterest_button( $url );</pre></p>
		
		<p><code>$url</code> Generates a share button for the current url if empty.</p>
	
		<h3>Twitter feed</h3>
		<p><pre class="prettyprint linenums">$this->social->twitter_feed($username,$limit,$view)</pre></p>
		
		<table class="table table-bordered">
			<tr>
			    <th>Name</th>
			    <th>Default</th>
			    <th>Description</th>
			</tr>
			<tr>
				<td><code>$config["twitter_feed_username"]</code></td>
				<td>null</td>
				<td><strong>Required:</strong> Twitter username</td>
			</tr>
			<tr>
				<td><code>$config["twitter_feed_limit"]</code></td>
				<td>10</td>
				<td>Number of tweets to display</td>
			</tr>
			<tr>
				<td><code>$config["twitter_feed_view"]</code></td>
				<td>false</td>
				<td>False returns an object of Tweets. True returns an unordered list of tweets to display.</td>
			</tr>
		</table>
		
		<p><pre class="prettyprint linenums">$this->social->initialize($config);
print_r($this->social->twitter_feed());
</pre></p>
		
		
		
		<h3>Open Graph metatags</h3>
		<p><pre class="prettyprint linenums">echo $this->social->open_graph_meta();</pre></p>
		
		<table class="table table-bordered">
			<tr>
			    <th>Name</th>
			    <th>Default</th>
			    <th>Description</th>
			</tr>
			<tr>
				<td><code>$config["ogtitle"]</code></td>
				<td><span class="label label-important">Buh ?</span></td>
				<td></td>
			</tr>
			<tr>
				<td><code>$config["ogurl"]</code></td>
				<td>current_url</td>
				<td>Set a custom url for the og:title meta tag.</td>
			</tr>
			<tr>
				<td><code>$config["ogtype"]</code></td>
				<td><span class="label label-important">Buh ?</span></td>
				<td></td>
			</tr>
			<tr>
				<td><code>$config["ogimage"]</code></td>
				<td><span class="label label-important">Buh ?</span></td>
				<td></td>
			</tr>
			<tr>
				<td><code>$config["ogdescription"]</code></td>
				<td><span class="label label-important">Buh ?</span></td>
				<td></td>
			</tr>
		</table>