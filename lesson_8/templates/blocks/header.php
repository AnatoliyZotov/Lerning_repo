<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if (isset($title)) echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/custom.css" media="screen" />
</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Sooo... CRUD!</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
          </ul>
        </div>
		<!--/.nav-collapse -->
        <div class="collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="/site/logout">Exit</a></li>
          </ul>
        </div>

      </div>
    </div>