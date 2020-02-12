<?php
class template
{
	private $root_dir;
		
	function __construct($config = FALSE) 
	{
		if ($config !== FALSE)
		{
			$this->root_dir = $config['root_dir'];
		}
		else
		{
			$this->root_dir = "K:\\home\\test1.ru\\www\\"; // заглушка под локальную винду ну и пока нету конфига
		}
	}
		
		
	public function show($filename,$data = FALSE)
	{

		
		// подготовка данных, если они требуются
		if ($data !== FALSE)
		{
			if (count($data))
			{
				foreach($data as $key => $value)
				{
					// тут следует сделать проверку на целочисленный тип покруче
					if (((int)$key)>0) continue;
					$$key = $value; // разыменовываем и присваиваем
				}
			}
			else
			{
				$content = $data;
			}
		}
		// определяем наличие файла
		
		$filename = str_replace('.php','',$filename);
		$filename = $filename.'.php';
		
		if (file_exists($this->root_dir."templates\\".$filename))
		{
			include($this->root_dir."templates\\".$filename);
		}
		else
		{
			echo "Ошибка загрузки шаблона! ".$this->root_dir."templates\\".$filename; die();
		}
	}
}

?>