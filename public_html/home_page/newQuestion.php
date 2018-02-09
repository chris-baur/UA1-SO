<?php include("header.php");
   ?>
<!--Body-->
<div class="container">
	<div class="form-control">
		<span class="col-lg-2">Tilte  </span>
		<input class="col-lg-10" type="text" placeholder="Title of your question" name="search">		
	</div>
	<div class="form-control">
		<textarea class="form-control" rows="10"></textarea>
	</div>
	<div class="form-control">
		<label>Tags</label>
		<div></div>
	</div>
	<div>
		<button type="button" class="btn btn-primary btn-md"> Ask it! </button>
	</div>

</div>

<?php
//footer
include("footer.php");
?>