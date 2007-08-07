<?php head(); ?>
<?php common('archive-nav'); ?>
<script type="text/javascript">
/* revealPath is used in revealSwitch(); */
var revealPath = "<?php echo uri('items/'); ?>";


function revealChoice() {
	if(!document.getElementById) return false;
	var detailedView = $('detailed');
	simpleView = $('simple');

	simpleView.onclick = function() {
		revealSwitch( 'view-choice', 'simple-view');
		this.addClassName('current');
		detailedView.removeClassName('current');
		return false;
	}
	detailedView.onclick = function() {
		revealSwitch( 'view-choice', 'detailed-view');
		this.addClassName('current');
		simpleView.removeClassName('current');
		return false;
	}
}

Event.observe(window,'load',revealChoice);

</script>
<div id="primary">
<?php if ( total_results(true) ): ?>

<h1>Browse Items (<?php echo total_results(true);?> items total)</h1>
<a class="add" id="add-item" href="<?php echo uri('items/add'); ?>">Add an Item</a>

<h2 id="search-header" class="close">Search Items</h2>
<?php include('searchform.php'); ?>
<div id="browse-meta">
<div class="pagination"><?php echo pagination_links(); ?></div>
<ul class="navigation" id="view-style">
	<li><a id="simple" href="?view=simple"<?php if($_GET['view'] == 'simple' || $_GET['view'] == '') echo ' class="current"';?>>Simple</a></li>
	<li><a id="detailed" href="?view=detailed"<?php if($_GET['view'] == 'detailed') echo ' class="current"';?>>Detailed</a></li>
</ul>	
</div>
<form action="<?php echo uri('items/powerEdit'); ?>" method="post" accept-charset="utf-8">
	
	<div id="view-choice">
	<?php if($_GET['view'] == 'detailed'):?>
		<?php include('detailed-view.php'); ?>
	<?php elseif($_GET['view'] == 'simple' || $_GET['view'] == ''):?>
		<?php include('simple-view.php'); ?>
	<?php endif; ?>
	</div>

<input type="submit" name="submit" value="Modify these Items" />

</form>

<?php elseif(!total_items(true)): ?>
	<div id="no-items">
	<h2>There are no items in the archive yet.
	
	<?php if(has_permission('Items','add')): ?>
		  Why don't you <a href="<?php echo uri('items/add'); ?>">add some</a>?</h2>
	<?php endif; ?>
</div>
	
<?php else: ?>
	<h2>The query searched <?php total_items(); ?> items and returned no results.</h2>
	
	<h2 id="search-header" class="close">Search Items</h2>
	<?php include('searchform.php'); ?>
<?php endif; ?>

</div>
<?php foot(); ?>
