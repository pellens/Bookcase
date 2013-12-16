<h1>How to create a library</h1>

<div class="bookmarks">
<ul>
<li><a href="#first-things-first">First things first</a></li>
<li><a href="#">Installation: step by step</a></li>
<li><a href="#">Basis settings</a></li>
</ul>
</div>

<h2>Philosophy</h2>

	<p>To create a library (aka module) for Bookcase, we want all modules to be included without adjusting the core setup. Because we work in CodeIgniter, the module is written as a library, but in this article we will continue by calling it a module.</p>

<h2>Preperation</h2>

	<p>Let's say we want to create a <strong>blog</strong> module. We start by creating a default folderstructure, to organize our files and make them readable for Bookcase. Most modules will contain a helper-file, library-file and some views:</p>
	<pre class="prettyprint linenums">libraries/Blog/
helpers/Blog/
views/backend/Blog/</pre>

	<p>We got our basic folderstructure, so now we define the functionalities we will need for this module:</p>

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

<h2>Create the module</h2>

	<p>So we know what functions we will need to create a module, let's start building up the library.<br/>
	We do so by creating 2 files in the <strong>libraries/Blog/</strong> folder:</p>
	<pre class="prettyprint linenums">libraries/Blog/
- libraries/Blog/Blog.php
- libraries/Blog/config.php</pre>

	<ul>
		<li><strong>Blog.php</strong> is the library, the general PHP Class where all the magic happens (CRUD).</li>
		<li><strong>config.php</strong> is the setup (instructions) you give to the Bookcase environment so it can understand your module.</li>
	</ul>

	<h2>Creating the library</h2>

	<p>So we allready thought about the functions we want, and about the functionnames we want to give them (see table above). Now it's very easy to build up the basic setup. Let's start by creating the <strong>Blog.php</strong> (library) file:</p>

	<pre class="prettyprint linenums">&lt;?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog {

    public function add_post()
    {
        $CI =& get_instance();
    }

    public function edit_post()
    {
        $CI =& get_instance();
    }

    public function delete_post()
    {
        $CI =& get_instance();
    }

    public function overview_posts()
    {
        $CI =& get_instance();
    }

    public function add_category()
    {
        $CI =& get_instance();
    }

    public function edit_category()
    {
        $CI =& get_instance();
    }

    public function del_category()
    {
        $CI =& get_instance();
    }

    public function overview_categories()
    {
        $CI =& get_instance();
    }

}</pre>

<h2>Creating the config file</h2>

<pre class="prettyprint linenums">//---------------------------------------------
// Some general information about your module
//---------------------------------------------

$config = array(
    "title"       => "Blog",
    "description" => "Handles a blog CRUD including categories.",
    "author" => array(
        "name"    => "Gert Pellens",
        "url"     => "http://gerardo.be",
        "twitter" => "@gpellens",
        "github"  => "pellens"
    ),
    "version"     => "0.1"
);

//---------------------------------------------
// Building up the backend navigation
//---------------------------------------------

$nav = array(
    "title" => "Blog",
    "nav"   => array(
        /* This part is available for the general user */
        "General" => array(
            "Posts overview"      => "admin/lib/blog/overview_posts",
            "Add post"            => "admin/lib/blog/add_post",
            "Categories overview" => "admin/lib/blog/overview_categories",
            "Add category"        => "admin/lib/blog/add_category"
        ),
        /* This part is only available for the superadmin */
        "Administrators" => array()
    )
);

//---------------------------------------------
// Interaction with the functions and views
//---------------------------------------------

$admin = array(
    "fn" => array(
        "posts_overview" => array(
            "view" => "backend/Blog/posts_overview",
            "fn"   => array(
                "list" => "posts_overview"
            )
        ),
        "categories_overview" => array(
            "view" => "backend/Blog/categories_overview",
            "fn"   => array(
                "list" => "categories_overview"
            )
        ),
        "add_post" => array(
            "view"     => "backend/Locations/add-post",
            "submit"   => "add_post",
            "redirect" => "admin/lib/blog/posts_overview"
        ),
        "edit_post" => array(
            "view"     => "backend/Locations/add-post",
            "submit"   => "edit_post",
            "item"     => "post_item",
            "redirect" => "admin/lib/blog/oists_overview"
        )
    )
);
</pre>


<h2>Creating views</h2>

<p>The views you create (the add, edit, overview, ... pages) for the backend, are located in a folder containing the same name as the library.</p>

<pre class="prettyprint linenums">views/backend/Blog/
- views/backend/Blog/add-blog-item.php
- views/backend/Blog/posts-overview.php
- views/backend/Blog/add-categorie.php
- views/backend/Blog/categories-overview.php</pre>

<h2>Total result</h2>

<p>If we follow these steps, we will have a folder containing the following structure:</p>
<pre class="prettyprint linenums">libraries/Blog/
- libraries/Blog/Blog.php
- libraries/Blog/config.php
views/backend/Blog/
- views/backend/Blog/add-blog-item.php
- views/backend/Blog/blog-overview.php
- views/backend/Blog/add-categorie.php
- views/backend/Blog/categories-overview.php</pre>