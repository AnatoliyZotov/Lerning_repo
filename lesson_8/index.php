<?php
session_start();
include("./db.php"); 
include("./system/auth.class.php"); 
include("./system/template.class.php"); 
include("./system/paginator.class.php"); 
include("./include/m/user.class.php");//model
include("./include/c/site.class.php");//controller



// путь получим после отработки htaccess
if (isset($_GET['path'])) 
{
	$path = $_GET['path'];

	$routepie = explode('/',$path);
	
	// вытаскиваем класс, к которому обратились
	if (isset($routepie[0]))
	{
		$classname = mysql_real_escape_string($routepie[0]);
		if ($classname==='') // если не прошел метод класса - главная на некоторых настройках
		{
			$classname = 'site';
		}
		// метод класса
		if (isset($routepie[1]))
		{
			$method = $routepie[1];
			$i = 2;
			
			// доп переменные для передачи в метод тоже соберем
			while (isset($routepie[$i]))
			{
				$j = $i - 1;
				//if (strpos($routepie[$i],'?')==1) break;
				$varname = "p$j";
				$$varname = $routepie[$i];
				$i++;
			}
		}
		else
		{
			$method = 'index';
		}
	}
	else
	{
		// если пути нет, то это, должно быть, главная
		$path = '/';
		$classname = 'site';
		$method = 'userlist';
		
	}
}
else
{
	// если пути нет, то это, должно быть, главная
	$path = '/';
	$classname = 'site';
	$method = 'userlist';
}

//eval($evalcode);





//начнем с максимума в три параметра, это можно улучшить и апдейтить
try
{
	$page = new $classname;
	if (isset($p3))
	{
		$page->$method($p1,$p2,$p3);
	}
	else
	{
		if (isset($p2))
		{
			$page->$method($p1,$p2);
		}
		else
		{
			if (isset($p1))
			{

				$page->$method($p1);

			}
			else
			{
				$page->$method();
			}
		}
	}
}
catch(Exception $e)
{
	// класс/метод не найдены, 404
	header("HTTP/1.1 404 Not Found");
	$page = new site;
	$page->e404();
}

?>