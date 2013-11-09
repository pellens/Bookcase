<h1>Products</h1>
			
<p>The products library is specific for offering products, with future extensions in mind (like online payment integration).<br/>
It is more a module than a library, but anyway... It let's you:
	<ul> 
		<li>CRUD products</li>
		<li>CRUD categories &amp; subcategories</li>
		<li>Interact with the <a href="?page=core">Core library</a></li>
		<li>Link a <a href="?page=contactform">form</a></li>
	</ul>
</p>

	<h2>Databases</h2>
	
	<p>The Products library will automatically create the following databases:</p>
	
	<table class="table table-bordered">
		<tr>
			<th>Database name</th>
			<th>Description</th>
		</tr>
		
		<tr>
			<td><code>products_categories</code></td>
			<td>Here you can store product categories.</td>
		</tr>
		<tr>
			<td><code>products_items</code></td>
			<td>Here you can store your products.</td>
		</tr>
		<tr>
			<td><code>products_item_form</code></td>
			<td>Here you can link a specific form (see the <a href="?page=contactforms">Contactforms library</a>) to a product.</td>
		</tr>
	</table>


	<h2>Example</h2>
	
	<p>To continue with the example used in the <a href="?page=core">Core library</a>: let's say there is a page designed for selling guitars.</p>
	
	<div class="alert"><b>Notice:</b> do <b>not</b> call your Controller <u>Products</u>, this name is taken by Products library!</div>
	
	<pre class="prettyprint linenums">&lt;?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    class Guitars extends CI_Controller {
	
        public function __construct()
        {
            parent::__construct();
        }
		 
        public function index()
        {   
            // Load the Products library            
            $this-&gt;load-&gt;library(&quot;products&quot;);

            // Page setttings : see Core library for more information
            $config[&quot;page&quot;] = &quot;products&quot;;
            $this-&gt;core-&gt;initialize($config);
                        			
            $this-&gt;load-&gt;view('products_template');
        }
        
        public function category( $url_title )
        {
            // Load products library            
            $this-&gt;load-&gt;library(&quot;products&quot;);
            
            // We know the url_title of the category,
            // so we can allready initialize that
            $config[&quot;category&quot;] = $url_title;
            $this-&gt;products-&gt;initialize($config);
            
            // Page setttings
            $config[&quot;page&quot;] = &quot;product_category&quot;;
            $this-&gt;core-&gt;initialize($config);
            			
            $this-&gt;load-&gt;view('product_category_template');
        }
        
        public function item( $url_title )
       	{
            // Load the Products library            
            $this-&gt;load-&gt;library(&quot;products&quot;);
            
            // We know the url_title of the product,
            // so we can initialize that
            $config["product"] = $url_title;
            $this->products->initialize($config);
            
            // Page setttings : see Core library for more information
            $config[&quot;page&quot;] = &quot;product_item&quot;;
            $this-&gt;core-&gt;initialize($config);
                        			
            $this-&gt;load-&gt;view('product_item_template');
        }
        
}</pre>

	<p>If you now browse to the controller's url, nothing specific will happen. Everything is now set to add some basic specifications and categories to the product(s).</p>
	<p>So let's add some products and/or product categories. In this specific case it could be something like:</p>
	
	<ul>
		<li>add 2 product categories: Fender &amp; Gibson.</li>
		<li>add for each category a productitem: Gibson Les Paul &amp; Fender Jaguar.</li>
	</ul>
	
	<h2>Use settings</h2>
	
	<p>So we created a a controller for all the products and for a product item. Let's use these...</p>
	<p>In the index controller we just created, we are loading the view <code>products_template</code>.</p>
	
	<pre class="prettyprint linenums">&lt;html&gt;
    &lt;head&gt;
        &lt;?=$this-&gt;core-&gt;metatags();?&gt;
    &lt;/head&gt;
	
    &lt;body&gt;
        &lt;ul&gt;
            &lt;? foreach( $this-&gt;products-&gt;categories() as $category ): ?&gt;
                &lt;li&gt;
                    &lt;?=anchor( &quot;guitars/category/&quot;.$category-&gt;url_title , $category-&gt;title ) ?&gt;
                &lt;/li&gt;
            &lt;? endforeach;?&gt;
        &lt;/ul&gt;
    &lt;/body&gt;
&lt;/html&gt;</pre>

	<p>In the category controller we just created, we are loading the view <code>product_category_template</code>.</p>
	
	<pre class="prettyprint linenums">&lt;html&gt;
    &lt;head&gt;
        &lt;?=$this-&gt;core-&gt;metatags();?&gt;
    &lt;/head&gt;
	
    &lt;body&gt;
        &lt;ul&gt;
            &lt;? foreach( $this-&gt;products-&gt;category_products() as $product ): ?&gt;
                &lt;li&gt;
                    &lt;?=anchor( &quot;guitars/item/&quot;.$product-&gt;url_title , $product-&gt;title ) ?&gt;
                &lt;/li&gt;
            &lt;? endforeach;?&gt;
        &lt;/ul&gt;
    &lt;/body&gt;
&lt;/html&gt;</pre>

	<p>In the item controller we just created, we are loading the view <code>product_item_template</code>.</p>
	
	<pre class="prettyprint linenums">&lt;html&gt;
    &lt;head&gt;
        &lt;?=$this-&gt;core-&gt;metatags();?&gt;
    &lt;/head&gt;
	
    &lt;body&gt;

        &lt;?
            // Note that this function is an example and could be done in the controller!
            $product = $this-&gt;products-&gt;product();
        ?&gt;

        &lt;h1&gt;&lt;?=$product[0]-&gt;title;?&gt;&lt;/h1&gt;
        &lt;p&gt;&lt;?=$product[0]-&gt;description;?&gt;&lt;/p&gt;
        &lt;p&gt;
            &lt;strong&gt;Price:&lt;/strong&gt;
            &lt;?=$product[0]-&gt;price;?&gt; $
        &lt;/p&gt;

    &lt;/body&gt;
&lt;/html&gt;</pre>

	<p>As you can see, we are able to retrieve product categories, products within a specific category and detailed information about a product.</p>
	<p>This is just a basic example... So if you run into a project that has just one specific "service" - like let's say "construction work" - you can set this as a main category in your controller (by initializing it), and retrieve all the subservices within this service.</p>
	
	<h2>Initialize Products library</h2>
	
	<code>$this->products->initialize( $config )</code>
	
	<table class="table table-bordered">
				<tr>
					<th>Name</th>
					<th>Default</th>
					<th>Description</th>
				</tr>
				
				<tr>
					<td><code>$config["product"]</code></td>
					<td><code>id</code> or <code>url_title</code></td>
					<td>A specific product</td>
				</tr>
				<tr>
					<td><code>$config["category"]</code></td>
					<td><code>id</code> or <code>url_title</code></td>
					<td>A specific product category</td>
				</tr>
			</table>

	<h2>Show categories</h2>
	
	<code>$this->products->categories( $parent )</code>
	
	<table class="table table-bordered">
		<tr>
			<th>Parameter</th>
			<th>Values</th>
			<th>Description</th>
		</tr>
		
		<tr>
			<td><code>$parent</code></td>
			<td>empty</td>
			<td>Returns all categories</td>
		</tr>
		<tr>
			<td><code>$parent</code></td>
			<td>string</td>
			<td>Returns a specific category within a parent based on its <u>url_title</u>.</td>
		</tr>
		<tr>
			<td><code>$parent</code></td>
			<td>int</td>
			<td>Returns a specific category within a parent based on its <u>id</u>.</td>
		</tr>
	</table>


	<h2>Products within category</h2>
	
	<code>$this->products->category_products( $category )</code>
	
	<table class="table table-bordered">
		<tr>
			<td><code>$category</code></td>
			<td>empty</td>
			<td>If initialized, returns a specific category based on the configuration.</td>
		</tr>
		<tr>
			<td><code>$category</code></td>
			<td>string</td>
			<td>Returns a specific category based on its <u>url_title</u>.</td>
		</tr>
		<tr>
			<td><code>$category</code></td>
			<td>int</td>
			<td>Returns a specific category based on its <u>id</u>.</td>
		</tr>
	</table>
	
	<div class="alert alert-error"><strong>Update:</strong> also get the child-category products! (if parameter is given)</div>
	
	<h2>Product</h2>
	
	<code>$this->products->product( $product )</code>
	
	<table class="table table-bordered">
		<tr>
			<td><code>$product</code></td>
			<td>empty</td>
			<td>If initialized, returns a specific product based on the configuration.</td>
		</tr>
		<tr>
			<td><code>$product</code></td>
			<td>string</td>
			<td>Returns a specific product based on its <u>url_title</u>.</td>
		</tr>
		<tr>
			<td><code>$product</code></td>
			<td>int</td>
			<td>Returns a specific product based on its <u>id</u>.</td>
		</tr>
	</table>
	
	<div class="alert alert-error"><strong>Update:</strong> also get the child-category products!</div>