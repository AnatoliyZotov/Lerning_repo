

    <div class="container">

      <div class="starter-template">
        <h1>Are u sure to delete user <?php echo $login; ?>?</h1>
		<label class="control-label" for=""><?php echo $error; ?></label>
<form class="form-horizontal" role="form" action="/site/clearuser/<?php echo $id; ?>" method="POST">
  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger">Yes, go for it!</button>&nbsp;<a href="/" class="btn btn-info" role="button">No, what was i thinking?</a>
    </div>
  </div>
</form>

      </div>

    </div><!-- /.container -->
