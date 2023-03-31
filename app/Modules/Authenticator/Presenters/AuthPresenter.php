<?php

namespace App\Modules\Authenticator\Presenter;

use Nette;
use App\Presenters\BasePresenter;
use App\Services\MyAuthenticator;
// use Nette\Forms\Form;
use Nette\Application\UI\Form;

class AuthPresenter extends BasePresenter{
    
    private $username;
    private $password;

    /**
     * @param MyAuthenticator
     */
    private $auth;

    public function __construct(MyAuthenticator $auth){
        $this->auth = $auth;
    }

    protected function createComponentLogInForm(): Form
	{
		$form = new Form;
		$form->addText('name', 'Name:');
		$form->addPassword('password', 'Password:');
		$form->addSubmit('send', 'Sign up');
		$form->onSuccess[] = [$this, 'formSucceeded'];
		return $form;
	}

    public function formSucceeded(Form $form, $data): void
	{
        $this->username = $data->name;
        $this->password = $data->password;
        $this->auth->authenticate($data->name, $data->password);
		$this->flashMessage('You have successfully signed up.');
		$this->redirect('Auth:');
	}

    public function renderDefault(){
        $this->template->form = $this['logInForm'];
    }
}