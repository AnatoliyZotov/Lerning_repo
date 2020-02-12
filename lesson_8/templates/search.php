

    <div class="container">

      <div class="starter-template">
        <h1>Search results: <?php echo $data['searchvalue']; ?></h1>
<div class="row">
  <div class="col-xs-3">
    <a href="/site/createuser" class="btn btn-primary btn-sm active" role="button">+ Add User</a>
  </div>
  <div class="col-xs-4">
    <form class="form-inline" role="form" action="/site/search" method="POST"><input name="searchvalue" type="text" class="form-control" placeholder="Search by name..."><button type="submit" class="btn btn-default btn-sm">Go!</button></form>
  </div>
</div>
<?php
$okdata = FALSE;
//print_r($data['users']);
if (isset($data['users']))
{
	if ((count($data['users']))&&($data['users']!=''))
	{
		$okdata = TRUE;		
?>
<div class="row">&nbsp;</div>
<div class="row">
<?php echo $data['paginator']; ?>
</div>

<table class="table table-striped">
<tr>
	<th>ID</th>
	<th>Login</th>
	<th>Group</th>
	<th>Comment</th>
	<th></th>
</tr>
<?php
		foreach ($data['users'] as $item)
		{

?>
<tr>
	<td><?php echo $item['id']; ?></td>
	<td><a href="/site/edituser/<?php echo $item['id']; ?>"><?php echo $item['login']; ?></a></td>
	<td><?php echo $item['group']; ?></td>
	<td><?php echo $item['comment']; ?></td>
	<td><a href="/site/edituser/<?php echo $item['id']; ?>" class="btn btn-info" role="button">Edit</a>&nbsp;<a href="/site/deleteuser/<?php echo $item['id']; ?>" class="btn btn-danger" role="button">Delete</a></td>
</tr>
<?php
		}
?>
</table>
<div class="row"><?php echo $data['paginator']; ?></div>

<?php
	}
}
if (!$okdata)
{
	?>
	<p class="bg-danger">No data, we are very sorry. Maybe, something went wrong and're <a href="/">back</a>?</p>
	<?php
}
?>
<div class="row">&nbsp;</div>
<div class="row"><div class="col-xs-3"><a href="/site/createuser" class="btn btn-primary btn-sm active" role="button">+ Add User</a></div></div>
      </div>

    </div><!-- /.container -->


