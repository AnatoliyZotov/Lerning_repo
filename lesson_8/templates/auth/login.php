

    <div class="container">

      <div class="starter-template">
        <h1>No tresspassing!</h1>
		<label class="control-label" for=""><?php echo $error; ?></label>
<form class="form-horizontal" role="form" action="<?php echo $url; ?>" method="POST">
  <div class="form-group">
    <label for="inputLogin3" class="col-sm-2 control-label">Login</label>
    <div class="col-sm-10">
      <input name='user' type="login" class="form-control" id="inputLogin3" placeholder="Login">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input name='password' type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Войти</button>
    </div>
  </div>
</form>


      </div>

    </div><!-- /.container -->
