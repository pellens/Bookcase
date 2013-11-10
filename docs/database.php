<h1>Database</h1>

			
<p>The database library let's you:
    <ul>
    	<li>List all databases</li>
    	<li>List all fields within a database</li>
    </ul>
</p>

			<h2>Example</h2>
			
			<pre class="prettyprint linenums">// load the library
$this->load->library("database");
$this->database->tables();
$this->database->table_records($table); // return amount of records
$this->database->table_fields($table);</pre>
