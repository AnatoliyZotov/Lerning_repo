<?php

class user
{
	// переменные для постраничности
	private $page; // отданный номер страницы, если отдана страница
	private $pages_count; // общее количество страниц, если отдана страница
	
	function __construct()
	{
		$this->pages_count = FALSE; 
		$this->page = FALSE;
	}
	
	// получение пользователя по id
	public function get_user($id = FALSE)
	{
		if ($id !== FALSE)
		{
			$id = (int) $id;
			$query = "SELECT * FROM `users` WHERE `id` = '{$id}'";
			$result = mysql_query($query);
			// если нашелся пользователь, выдаем  строку из БД в качестве результата
			if ($row = mysql_fetch_assoc($result))
			{
				return $row;
			}
			else
			{
				return FALSE;
			}
			
		}
		return FALSE;
	}
	
	public function get_users($page = 1, $where = '1', $order = 'id',$users_per_page = 10)
	{
		// защищаем переменные
		$page = (int) $page;
		if ($page<1) return FALSE;
		$users_per_page = (int) $users_per_page;
		$order = mysql_real_escape_string ($order);
		//$where = mysql_real_escape_string ($where);
		
		
		// формируем запрос к БД
		$limitstart = ($page - 1) * $users_per_page;
		$query = "SELECT * FROM `users` WHERE {$where} ORDER BY `{$order}` LIMIT {$limitstart}, {$users_per_page}";
		//echo $query;
		$result = mysql_query($query);
		$data = array();
		// пока по запросу удается что-то вытащить...
		while ($row = mysql_fetch_assoc($result))
		{
				
			$data[] = $row;
		}
		if (count($data)>0)
		{
			// тут вывели страницу, так что отложим данные про постраничность
			$query = "SELECT COUNT(*) FROM `users` WHERE {$where}";
			$result = mysql_query($query);
			if ($row = mysql_fetch_row($result))
			{
				$usernum = $row[0];
				$this->pages_count = ceil($usernum/$users_per_page);
				$this->page = $page;
			}
			return $data;
			
		}
		// если ничего не нашлось, то ложь
		return FALSE;
	}
	

	public function search($searchvalue = FALSE,$page = 1)
	{
		$where = "`login` LIKE '%{$searchvalue}%'";
		return $this->get_users($page,$where);
	}
	
	// TODO: защита от инъекций
	public function create_user($data = FALSE)
	{
		if ($data === FALSE) return FALSE; // без данных в функции смысла нет
		if (isset($data['password']))
		{
			if (strlen($data['password'])>0)
			{
				$data['password'] = md5(md5($data['password'])); // двойное шифрование для крутости
			}
		}
		if (count($data))
		{
			$query = "INSERT INTO `users` (`id`,`login`,`password`,`group`,`comment`) VALUES ('','{$data['login']}','{$data['password']}','{$data['group']}','{$data['comment']}')";
			$result = mysql_query($query);
			return $result; // контроль успеха
		}
	}
	
	// TODO: защита от инъекций
	public function update_user($id = FALSE, $data = FALSE)
	{
		if (($id === FALSE)||($data === FALSE)) return FALSE; // без данных в функции смысла нет
		$id = (int) $id;
		
		if (isset($data['password']))
		{
			if (strlen($data['password'])>0)
			{
				$data['password'] = md5(md5($data['password'])); // двойное шифрование для крутости
			}
		}
		if (count($data))
		{
			$query = "UPDATE `users` SET `login` = '{$data['login']}', `password` = '{$data['password']}', `group` = '{$data['group']}', `comment` = '{$data['comment']}' WHERE `id` = '{$id}' LIMIT 1";
			$result = mysql_query($query);
			return $result; // контроль успеха
		}
		
	}
	
	public function delete_user($id = FALSE)
	{
		if ($id === FALSE) return FALSE; // без id в функции смысла нет
		$id = (int) $id;
		
		//echo $id;
		if ($id>0)
		{
			$query = "DELETE FROM `users` WHERE `id` = '{$id}' LIMIT 1";
			$result = mysql_query($query);
			return $result; // контроль успеха
		}
		else
		{
			return FALSE;
		}
		
	}
	
	public function get_page()
	{
		return $this->page;
	}
	
	
	public function get_pages_count()
	{
		return $this->pages_count;
	}

}

?>