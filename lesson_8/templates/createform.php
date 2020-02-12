

    <div class="container">

      <div class="starter-template">
        <h1>Create New User</h1>
		<label class="control-label" for=""><?php echo $error; ?></label>
<form class="form-horizontal" role="form" action="/site/adduser/" method="POST">
  <div class="form-group">
    <label for="inputLogin3" class="col-sm-2 control-label">Login</label>
    <div class="col-sm-10">
      <input name="login" type="text" class="form-control" id="inputLogin3" placeholder="Login" value="<?php echo $login; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputGroup3" class="col-sm-2 control-label">Group</label>
    <div class="col-sm-10">
      <input name="group" type="text" class="form-control" id="inputGroup3" placeholder="Group" value="<?php echo $group; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputComment3" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-10">
      <input name="comment" type="text" class="form-control" id="inputComment3" placeholder="Comment" value="<?php echo $comment; ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>

      </div>

    </div><!-- /.container -->
