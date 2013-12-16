<h1>How to install Bookcase</h1>

<div class="bookmarks">
<ul>
<li><a href="#first-things-first">First things first</a></li>
<li><a href="#">Installation: step by step</a></li>
<li><a href="#">Basis settings</a></li>
</ul>
</div>

<h2>First things first</h2>
<p>Bookcase is a CodeIgniter extension. So before using the Bookcase-libraries, you should be familiar with CodeIgniter.<br/><strong>You don't need to master it, but the basic practice should be there.</strong>

<h2>Installation: step by step</h2>
<table class="table table-bordered">
	<tr>
		<td><strong>1.</strong></td>
		<td>Download the latest Bookcase version</td>
		<td><a href="https://github.com/pellens/Bookcase">https://github.com/pellens/Bookcase</a></td>
	</tr>
	<tr>
		<td><strong>2.</strong></td>
		<td colspan="2">Unpack and move the folder to your server (or localhost)</td>
	</tr>
	<tr>
		<td><strong>3.</strong></td>
		<td>Provide a base url</td>
		<td><code>/application/config/config.php</code></td>
	</tr>
	<tr class="warning">
		<td colspan="3">If you are not working in a subdirectory, skip the next step!</td>
	</tr>
		<td><strong>4.</strong></td>
		<td>Provide the subdirectory in the .htacess file</td>
		<td><code>/.htaccess</code></td>
	</tr>
	<tr>
		<td><strong>5.</strong></td>
		<td>Provide database settings</td>
		<td><code>/application/config/database.php</code></td>
	</tr>
</table>

<h2>Basic setup</h2>
<p>After installing step by step, you will see a message telling that Bookcase is installed!</p>
<p>We now got an installation with:</p>
<ul>
	<li>Autoloaded <a href="?page=core">Core Library</a></li>
	<li>Autoloaded <a href="?page=translate">Translate Library</a></li>
	<li>A basic admin-area with some basic features that most likely will come in very handy.</li>
</ul>