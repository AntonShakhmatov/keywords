<?php

namespace App\Modules\Authenticator\Presenter;

use Nette;
use Nette\Application\UI\Form;
use Nette\Http\IResponse;
use Nette\Application\UI\Presenter;
use App\Services\MyAuthenticator;
use Nette\Database\Explorer;
use App\Model\FetchModel;

class AuthPresenter extends Presenter{
    private $username;
    private $password;
    private $auth;
    private $httpResponse;
    private $token;
    private $model;

    public function __construct(MyAuthenticator $auth, IResponse $httpResponse, FetchModel $model){
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
        $this->auth->authenticate($data->name, $data->password);

        $id = $this->model->context->table('users')
            ->where('login', $data->name)
            ->select('id')
            ->fetch();

        $token = $this->model->context->table('tokens')
            ->where('userId', $id)
            ->select('token')
            ->fetch();

        if ($token) {
            $expiry = time() + 60 * 60 * 24 * 30;
            $this->getHttpResponse()->setCookie('token', $token->token, $expiry);
            $this->redirect(':Keywords:default');
        }
    }
}