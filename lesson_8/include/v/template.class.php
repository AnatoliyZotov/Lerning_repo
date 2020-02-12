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
					$$key = $value;
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
		
		if (file_exists($this->root_dir.$filename))
		{
			include($this->root_dir.$filename);
		}
	}
}

?>