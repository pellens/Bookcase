<h1>How to create a library</h1>

<div class="bookmarks">
<ul>
<li><a href="#first-things-first">First things first</a></li>
<li><a href="#">Installation: step by step</a></li>
<li><a href="#">Basis settings</a></li>
</ul>
</div>

<h2>Philosophy</h2>

<p>To create a library (aka module) for Bookcase, we want all modules to be included without adjusting the core setup.</p>

<h2>Preperation</h2>

	<p>Let's say we want to create a <strong>blog</strong> module. We start by creating a default folderstructure, to organize our files and make them readable for Bookcase:</p>
	<pre class="prettyprint linenums">libraries/Blog/
helpers/Blog/
views/backend/Blog/</pre>

	<p>Then we define the functionalities we will need for this module.</p>

	<table class="table table-bordered">
		<tr>
			<th>Functionality</th>
			<th>Function name</th>
		</tr>
		<tr>
			<td>Create a post</td>
			<td><code>add_post()</code></td>
		</tr>
		<tr>
			<td>Edit a post</td>
			<td><code>edit_post()</code></td>
		</tr>
		<tr>
			<td>Delete a post</td>
			<td><code>delete_post()</code></td>
		</tr>
		<tr>
			<td>List of all posts</td>
			<td><code>overview_posts()</code></td></tr>
		<tr>
			<td>Create categories</td>
			<td><code>add_category()</code></td></tr>
		<tr>
			<td>Edit category</td>
			<td><code>edit_category()</code></td></tr>
		<tr>
			<td>Delete category</td>
			<td><code>del_category()</code></td></tr>
		<tr>
			<td>List of categories</td>
			<td><code>overview_categories()</code></td></tr>
		</table>
</ul>

<h2>Create the library</h2>



<h2>Creating views</h2>

<p>The views you create (the add, edit, overview, ... pages) for the backend, are located in a folder containing the same name as the library.</p>

<pre class="prettyprint linenums">views/backend/Blog/
- views/backend/Blog/add-blog-item.php
- views/backend/Blog/blog-overview.php
- views/backend/Blog/add-categorie.php
- views/backend/Blog/categories-overview.php</pre>

<h2>Create the config</h2>