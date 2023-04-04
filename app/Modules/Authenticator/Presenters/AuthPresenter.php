<?php

namespace App\Modules\Authenticator\Presenter;

use Nette;
use Nette\Application\UI\Form;
use Nette\Http\Response;
use Nette\Application\UI\Presenter;
use App\Services\MyAuthenticator;
use Nette\Database\Explorer;
use App\Model\FetchModel;

class AuthPresenter extends Presenter{
    private $username;
    private $password;
    private $auth;
    private $httpResponse;
    private $database;
    private $token;
    private $model;

    public function __construct(MyAuthenticator $auth, Response $httpResponse, FetchModel $model){
        $this->auth = $auth;
        $this->httpResponse = $httpResponse;
        $this->model = $model;
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
        $row = $this->model->database->table('users')
            ->where('login', $data->name)
            ->select('id')
            ->fetch();

        if(!is_null($row)){
            $this->token =  bin2hex(random_bytes(32));
            $userId = $row['id'];

            $tokenInsert = $this->model->context->table('tokens')->insert([
                'token' => $this->token,
                'userId' => $userId
            ]);
            if(!$tokenInsert){
                $this->httpResponse->setCode(Response::S403_FORBIDDEN);
            }
            else
            {
                $this->getHttpResponse()->setCode(200);
                $this->auth->authenticate($data->name, $data->password);
                $this->flashMessage('You have successfully signed in.');
                $this->httpResponse->addHeader('Authorization', "Bearer {$this->token}");     
                $this->redirect(':Keywords:default');
                die();
            }
        }
        else
        {
            $this->getHttpResponse()->setCode(303);
            $this->flashMessage('Invalid login or password');
        }
	}

    public function renderDefault(){
        $this->template->form = $this['logInForm'];
    }
}