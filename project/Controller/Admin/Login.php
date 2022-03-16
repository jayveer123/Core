<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Admin_Login extends Controller_Admin_Action{

	public function loginAction()
	{
		$this->setTitle('Login');
		$content = $this->getLayout()->getContent();
		$loginGrid = Ccc::getBlock('Admin_Login_Grid');
		$content->addChild($loginGrid , 'grid');
		
		$this->randerLayout();
	}

	public function loginPostAction()
	{
		try {
			$adminModel = Ccc::getModel("Admin");
			$loginModel = Ccc::getModel("Admin_Login");
			$request = $this->getRequest();

			if(!$request->isPost()){
				throw new Exception("invalid request", 1);
			}
			if(!$request->getPost()){
				throw new Exception("invalid request", 1);
			}
			$loginData = $request->getPost('admin');
			$password = md5($loginData['password']);
			$row = $adminModel->fetchAll("SELECT * FROM `admin` WHERE `email` = '{$loginData['email']}' AND `password` = '{$password}'");

			if(!$row){
				$this->getMessage()->addMessage('Invalid Data',3);
				throw new Exception("Invalid Request", 1);
			}
			$loginModel->login($row[0]->email);
			$this->getMessage()->addMessage('Login Sucess');
			$this->redirect('product','grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('admin_login','login',[],true);
		}
	}

	public function logoutAction()
	{
		$loginModel = Ccc::getModel("Admin_Login");
		if($loginModel->getLogin()){
			$loginModel->logout();
		}
		$this->redirect('admin_login','login');		
	}

}

?>