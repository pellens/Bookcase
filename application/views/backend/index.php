<?php
    require "less/lessc.inc.php";
    $less = new lessc;
    $less->checkedCompile("less/backend.less", "css/backend/backend.css");
?>
<!DOCTYPE html>
<html>
	<head>
    	<title>Bookcase</title>

    	<meta http-equiv="Content-Type"         content="text/html; charset=utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/bootstrap.css"/>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/ui.fancytree.css"/>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/backend.css"/>
    	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    	<script type="text/javascript" src="<?=base_url("js/core")?>/jquery.1.10.2.js"></script>
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.js"></script>
    	<!--<script type="text/javascript" src="<?=base_url("js/core")?>/bootstrap.js"></script>-->
    	<script type="text/javascript" src="<?=base_url("js/backend")?>/custom.js"></script>
      <script type="text/javascript" src="<?=base_url("ckeditor/ckeditor.js?rand=".rand()*100000);?>"></script>
    	<script type="text/javascript" src="<?=base_url("js/backend")?>/jquery.fancytree-all.js"></script>
    	<script type="text/javascript" src="<?=base_url("js/backend")?>/jquery.fancytree-dnd.js"></script>
    	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script>

    	<script type="text/javascript">
    $(function(){
      $("#tree").fancytree({
      extensions: ["dnd"],
      dnd: {
        preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
        preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
        autoExpandMS: 400,
        dragStart: function(node, data) {
          /** This function MUST be defined to enable dragging for the tree.
           *  Return false to cancel dragging of node.
           */
          return true;
        },
        dragEnter: function(node, data) {
          /** data.otherNode may be null for non-fancytree droppables.
           *  Return false to disallow dropping on node. In this case
           *  dragOver and dragLeave are not called.
           *  Return 'over', 'before, or 'after' to force a hitMode.
           *  Return ['before', 'after'] to restrict available hitModes.
           *  Any other return value will calc the hitMode from the cursor position.
           */
          // Prevent dropping a parent below another parent (only sort
          // nodes under the same parent)
/*           if(node.parent !== data.otherNode.parent){
            return false;
          }
          // Don't allow dropping *over* a node (would create a child)
          return ["before", "after"];
*/
           return true;
        },
        dragDrop: function(node, data) {
          /** This function MUST be defined to enable dropping of items on
           *  the tree.
           */
          data.otherNode.moveTo(node, data.hitMode);
        }
      },
      activate: function(e, data) {
        window.location = data.node.data.href;
      }
    });
    });
  </script>

	</head>
	<body>

	<div class="container">

		<div class="header">
			<h1><?=$this->core->website_title;?></h1>
			<nav>
			<ul>

				<li <?=($active_link == "website")  ? "class='active'" : "";?>><?=anchor("admin","Website");?></li>
				<li <?=($active_link == "lib")      ? "class='active'" : "";?>><?=anchor("admin/modules","Modules");?></li>
				<li <?=($active_link == "settings") ? "class='active'" : "";?>><?=anchor("admin/settings/website_settings","Settings");?></li>
				
			</ul>
			</nav>

      <?=langswitch();?>
      
		</div>

		<div class="sidebar">
			<?
				switch($this->uri->segment(3))
				{
					case "" 		:
					case "page"		: $this->load->view("backend/sidebar-website"); break;
					case "settings" : $this->load->view("backend/sidebar-settings"); break;
					default 		: $this->load->view("backend/sidebar-modules"); break;
				}
			?>
		</div>

		<div class="main">
			<?=$this->load->view($main);?>
		</div>

	</div>

	<div class="container">
    		

			
			<div class="main">

				<h3>Users</h3>

				<?=$this->users->users(true);?>

			</div>
		
		</div>
	</div>

	</body>
</html>