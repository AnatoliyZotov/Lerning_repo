<?php
class paginator
{
	// Класс рендерит пейджинг, основываясь на принятых допущениях: в метод передается первой переменной номер страницы. 
	// Если это не так, то в метод надо передать значения предыдущих переменных, разделив слешами
	private $classname;
	private $method;
	private $page;
	private $pages_count;
	
	function __construct($classname,$method,$page,$pages_count)
	{
		$this->classname = $classname;
		$this->method = $method;
		$this->page = $page;
		$this->pages_count = $pages_count;
	}
	
	public function render()
	{
		$baseurl = "/{$this->classname}/{$this->method}";
		$result = "<ul class=\"paginator\">";
		for ($i=1;$i<=$this->pages_count;$i++)
		{
			if ($i!==$this->page)
			{
				$result .= "<li><a href=\"{$baseurl}"."/"."{$i}\">{$i}</a></li>";
			}
			else
			{
				$result .= "<li class=\"active\">{$i}</li>";
			}
		}
		$result .= "</ul>";
		return $result;
	}
}
?>