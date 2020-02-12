<?php
class authme
{
	private $user;
	private $login_url; // ссылка на форму
	private $error; // хранение ошибок авторизации
	
	// значение формы по умолчанию - это некоторое читерство от ОПП, ну и ладно
	function __construct($login_url = '/site/login' ,$user = FALSE, $password = FALSE)
	{
		$this->login_url = $login_url;
		if ($user === FALSE)
		{
			$this->user = FALSE;
		}
		else
		{
			$this->auth($user, $password);
		}
	}
	
	// авторизуем по сессии, форме или тупо по входным данным
	public function auth($auth_user = FALSE, $auth_password = FALSE)
	{
		$user = FALSE;
		// проверяем авторизация в сессии
		if (isset($_SESSION['user']))
		{
			$user = $_SESSION['user'];
			$password = $_SESSION['password'];
		}
		else
		{
			// а также, проверяем не прилетела ли нам форма с авторизацией
			if (isset($_POST['user']))
			{
				$user = $_POST['user'];
				if ($password !== '')	$password = md5(md5($_POST['password'])); // прилетевший пароль шифрануть ннада
			}
			else
			{
				// авторизация по тому, что передано в функцию в самом конце
				if ($auth_user === FALSE)
				{
					return FALSE;
				}
				else
				{
					$user = $auth_user;
					if ($auth_password !== '')	$password = md5(md5($auth_password));
				}				
			}
		}
		// если пришли данные, надо проверить наличие пользователя в БД
		//echo $user;
		if ($user !== FALSE)
		{
			$query = "SELECT COUNT(*) FROM `users` WHERE (`login` = '{$user}') AND (`password` = '{$password}')";
			//echo $query;
			$result = mysql_query($query);
			if ($row = mysql_fetch_row($result))
			{
				$num = $row[0];
				// тот случай, когда пароль не подошел
				if ($num == 0)
				{
					$this->user = FALSE;
					$this->error = "Incorrect username/password";
					return FALSE;
				}
				else
				{
					// единственный вариант, когда все ок
					$this->user = $user;
					// и в сессию, в сессию записать ннада
					if (!(isset($_SESSION['user'])))
					{
						$_SESSION['user'] = $user;
						$_SESSION['password'] = $password;
					}
					
					return TRUE;
				}
			}
			else
			{
				$this->user = FALSE;
				return FALSE;
			}
		}
		else
		{
			$this->user = FALSE;
			return FALSE;
		}
	}
	
	// проверка, были ли мы авторизованы
	public function authed()
	{
		if ($this->user === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function get_user()
	{
		return $this->user;
	}

	public function get_error()
	{
		return $this->error;
	}
	
	public function set_login_url($url = FALSE)
	{
		if ($url === FALSE) return FALSE;
		$this->login_url = $url;
	}
	
}
?>