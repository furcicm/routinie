<link rel="stylesheet" href="css/books.css" />
<div id="add-new">
	<ul>
		<li>
			<span class="label">Title</span>
			<input type="text" name="title">
		</li>
		<li>
			<span class="label">Author</span>
			<input type="text" name="author">
		</li>
		<li>
			<span class="label">Gene</span>
			<input type="text" name="gene">
		</li>
		<li>
			<span class="label">Pages</span>
			<input type="text" name="pages">
		</li>
		<input type="hidden" value=<?php echo $sid; ?>>
	</ul>
	<div class="clearfix"></div>
</div>