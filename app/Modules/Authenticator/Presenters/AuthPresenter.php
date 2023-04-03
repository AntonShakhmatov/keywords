<?php

namespace App\Modules\Authenticator\Presenter;

use Nette;
use Nette\Application\UI\Form;
use Nette\Http\Response;
// use App\Presenters\BasePresenter;
use Nette\Application\UI\Presenter;
use App\Services\MyAuthenticator;
use Nette\Database\Explorer;

class AuthPresenter extends Presenter{
    private $username;
    private $password;
    private $auth;
    private $httpResponse;
    private $database;

    public function __construct(MyAuthenticator $auth, Response $httpResponse, Explorer $database){
        $this->auth = $auth;
        $this->httpResponse = $httpResponse;
        $this->database = $database;
    }

    protected function createComponentLogInForm(): Form
	{
		$form = new Form;
		$form->addText('name', 'Name:');
		$form->addPassword('password', 'Password:');
		$form->addSubmit('send', 'Sign in');
		$form->onSuccess[] = [$this, 'formSucceeded'];
		return $form;
	}

    public function formSucceeded(Form $form, $data): void
	{
        $row = $this->database->table('users')
            ->where('login', $data->name)
            ->select('token')
            ->fetch();
        $token = $row['token'];   
        $this->username = $data->name;
        $this->password = $data->password;
        $this->auth->authenticate($data->name, $data->password);
        $this->httpResponse->addHeader('Authorization', "Bearer {$token}");     
		$this->redirect(':Keywords:default');
        $this->flashMessage('You have successfully signed in.');
	}

    public function renderDefault(){
        $this->template->form = $this['logInForm'];
    }
}