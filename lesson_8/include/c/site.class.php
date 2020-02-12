<?php

class site
{
	private $tpl;
	private $users;
	private $auth;
	
	
	function __construct($config = FALSE) 
	{
		$this->tpl = new template;
		$this->users = new user;

		$this->auth = new authme;		
		

	}
	
	public function index()
	{
		$this->userlist(1);
	}
	
	public function userlist($page = 1)
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}

	
		$page = (int) $page;
		$data['users'] = $this->users->get_users($page);
		
		// постраничность
		$paging = new paginator("site","userlist",$page,$this->users->get_pages_count());
		$data['paginator'] = $paging->render();
		
		
		$d['title'] = "Users List";
		if ($page > 1) $d['title'] = $d['title']." - page {$page}";
		$this->tpl->show('blocks/header',$d);
		$this->tpl->show('list',$data);
		$this->tpl->show('blocks/footer');
		
	}
	
	public function search($searchvalue = FALSE, $page = 1)
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}
		// поисковая строка может прийти как из формы, так и из url
		if ($searchvalue === FALSE)
		{
			if (isset($_POST['searchvalue']))
			{
				$searchvalue = $_POST['searchvalue'];
			}
			else
			{
				return FALSE;
			}
		}
		$page = (int) $page;
		$data['searchvalue'] = $searchvalue;
		$data['users'] = $this->users->search($searchvalue, $page);
		
		// постраничность
		$paging = new paginator("site","search/{$searchvalue}",$page,$this->users->get_pages_count());
		$data['paginator'] = $paging->render();
		
		
		$d['title'] = "Search results";
		if ($page > 1) $d['title'] = $d['title']." - page {$page}";
		$this->tpl->show('blocks/header',$d);
		$this->tpl->show('search',$data);
		$this->tpl->show('blocks/footer');
		
	}
	
	public function edituser($id = FALSE)
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}
		if ($id === FALSE) return FALSE;
		$id = (int) $id;
		$data = $this->users->get_user($id);

		$d['title'] = "Edit user ".$data['login'];
		$this->tpl->show('blocks/header',$d);
		$this->tpl->show('userform',$data);
		$this->tpl->show('blocks/footer');
	}
	
	public function saveuser($id = FALSE)
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}
		if ($id === FALSE) return FALSE;
		$id = (int) $id;
		
		// переносим данные
		$data['id'] = $id;
		$data['login'] = $_POST['login'];
		$data['password'] = $_POST['password'];
		$data['group'] = $_POST['group'];
		$data['comment'] = $_POST['comment'];
		
		// если данные сохранены (тут может быть и валидация, и все что угодно)
		if ($this->users->update_user($id,$data))
		{
			$this->tpl->show('blocks/header',array('title'=>'Success!'));
			$this->tpl->show('savesuccess');
			$this->tpl->show('blocks/footer');
		}
		else
		{
			$data['error'] = mysql_error(); // можно ошибочку передать
			$d['title'] = "Edit user ".$data['login'];
			$this->tpl->show('blocks/header',$d);
			$this->tpl->show('userform',$data);
			$this->tpl->show('blocks/footer');
		}
	}
	
	public function createuser()
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}
		$d['title'] = "Create a new user";
		$this->tpl->show('blocks/header',$d);
		$this->tpl->show('createform');
		$this->tpl->show('blocks/footer');
	}
	
	public function adduser()
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}		
		// переносим данные
		$data['login'] = $_POST['login'];
		$data['password'] = $_POST['password'];
		$data['group'] = $_POST['group'];
		$data['comment'] = $_POST['comment'];
		
		// если данные сохранены (тут может быть и валидация, и все что угодно)
		if ($this->users->create_user($data))
		{
			$this->tpl->show('blocks/header',array('title'=>'Success!'));
			$this->tpl->show('savesuccess');
			$this->tpl->show('blocks/footer');
		}
		else
		{
			$data['error'] = mysql_error(); // можно ошибочку передать
			$d['title'] = "Create a new user";
			$this->tpl->show('blocks/header',$d);
			$this->tpl->show('createuser',$data);
			$this->tpl->show('blocks/footer');
		}
	}
	
	public function deleteuser($id = FALSE)
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}
		
		if ($id === FALSE) return FALSE;
		$id = (int) $id;
		$data = $this->users->get_user($id);

		$d['title'] = "Delete user ".$data['login'];
		$this->tpl->show('blocks/header',$d);
		$this->tpl->show('deleteform',$data);
		$this->tpl->show('blocks/footer');
	}
	
	public function clearuser($id = FALSE)
	{
		$this->auth->auth();
		if ($this->auth->authed())
		{
			// it's okaaaaay :)
		}
		else
		{
			$data['title'] = "Access denied";
			$data['url'] = $_SERVER['REQUEST_URI'];
			$data['error'] = $this->auth->get_error();
			$this->tpl->show('blocks/header',$data);
			$this->tpl->show('auth/login',$data);
			$this->tpl->show('blocks/footer');	
			return FALSE;
		}
		if ($id === FALSE) return FALSE;
		$id = (int) $id;
		
		// переносим данные
		$data['id'] = $id;
		
		// если данные сохранены (тут может быть и валидация, и все что угодно)
		if ($this->users->delete_user($id))
		{
			$this->tpl->show('blocks/header',array('title'=>'Success!'));
			$this->tpl->show('savesuccess');
			$this->tpl->show('blocks/footer');
		}
		else
		{
			$data['error'] = mysql_error(); // можно ошибочку передать
			$d['title'] = "Delete user ".$data['login'];
			$this->tpl->show('blocks/header',$d);
			$this->tpl->show('deleteform',$data);
			$this->tpl->show('blocks/footer');
		}
	}
	
	public function login()
	{
		$this->logout();
	}
	
	public function logout()
	{
		session_unset();
		$this->auth->set_login_url('/');
		$data['url'] = '/';
		$this->tpl->show('blocks/header',$d);
		$this->tpl->show('auth/login',$data);
		$this->tpl->show('blocks/footer');

	}
	
	public function e404()
	{
		$this->tpl->show('blocks/header',array('title'=>'Error :('));
		$this->tpl->show('e404');
		$this->tpl->show('blocks/footer');
	}

}

?>