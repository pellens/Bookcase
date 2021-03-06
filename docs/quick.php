<h1>Quick functions</h1>

<div class="bookmarks">
<ul>
<li><a href="#products">Products</a></li>
</ul>
</div>


<h2>Products</h2>

<pre class="prettyprint linenums">// OVERVIEWS
$this->products->products_overview( $lang )
$this->products->categories_overview( $parent , $lang , $view )

// GET PRODUCT AND LINKED VIDEOS & LOCATIONS
$this->products->product($product);
$this->products->product_videos();
$this->products->product_locations();

// GET CATEGORY AND LINKED PRODUCTS & VIDEOS & LOCATIONS
$this->products->category($category);
$this->products->category_products();
$this->products->category_videos();
$this->products->category_locations();</pre>

<pre class="prettyprint linenums">$this->products->products_overview( $lang )</pre>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Parameter</th>
			<th>Value</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>$lang</code></td>
			<td><code>true</code> Default</td>
			<td>Returns only products within the <strong>current language</strong></td>
		</tr>
		<tr>
			<td><code>$lang</code></td>
			<td><code>false</code></td>
			<td>Returns all the products</td>
		</tr>
		<tr>
			<td><code>$lang</code></td>
			<td><code>string</code></td>
			<td>Returns all the products within the <strong>$lang</strong> language (iso)</td>
		</tr>
	</tbody>
</table>

<pre class="prettyprint linenums">$this->products->categories_overview( $parent , $lang , $view )</pre>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Parameter</th>
			<th>Value</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>$parent</code></td>
			<td><code>null</code> Default</td>
			<td>Returns all categories</td>
		</tr>
		<tr>
			<td><code>$parent</code></td>
			<td><code>string | int</code></td>
			<td>Returns all categories with <strong>$parent</strong> as parent category (0 = maincategories).</td>
		</tr>
		<tr>
			<td><code>$lang</code></td>
			<td><code>true</code> Default</td>
			<td>Returns only categories within the <strong>current language</strong></td>
		</tr>
		<tr>
			<td><code>$lang</code></td>
			<td><code>false</code></td>
			<td>Returns all the categories</td>
		</tr>
		<tr>
			<td><code>$lang</code></td>
			<td><code>string</code></td>
			<td>Returns all the categories within the <strong>$lang</strong> language (iso)</td>
		</tr>
		<tr>
			<td><code>$view</code></td>
			<td><code>false</code> Default</td>
			<td>Returns all the categories in an object</td>
		</tr>
		<tr>
			<td><code>$view</code></td>
			<td><code>select | list</code></td>
			<td>Returns html-code</td>
		</tr>
	</tbody>
</table>