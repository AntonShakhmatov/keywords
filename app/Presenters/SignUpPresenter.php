<?php

namespace App\Presenters;

use Nette;
use Nette\Http\Request;
use Nette\Http\Response;
use Nette\Application\UI\Form;
use App\Model\FetchModel;
use Nette\Application\UI\Presenter;

class SignUpPresenter extends Presenter{
    private $model;
    private $httpResponse;
    private $token;
    public function __construct(FetchModel $model, Response $httpResponse){
        $this->model = $model;
        $this->httpResponse = $httpResponse;
    }

    protected function createComponentForm()
	{
		$form = new Form();
		$form->addEmail('email', 'Email')->setRequired('Please enter email');
		$passwordInput = $form->addPassword('pwd', 'Password')->setRequired('Please enter password');
		$form->addPassword('pwd2', 'Password (verify)')->setRequired('Please enter password for verification')->addRule($form::EQUAL, 'Password verification failed. Passwords do not match', $passwordInput);
		$form->addSubmit('register', 'Register');
		$form->onSuccess[] = [$this, 'formSucceeded'];
		return $form;
    }
    public function formSucceeded(Form $form, $data): void
    {
        $user = $this->model->database->table('users')
            ->where('login', $data->email)
            ->select('id')
            ->fetch();

            if(is_null($user)){
                $token =  bin2hex(random_bytes(32));
                $login = $data->email;
                $password = $this->model->passwords->hash($data->pwd2);
                $userInsertResult = $this->model->context->table('users')->insert([
                    'login' => $login,
                    'password' => $password
                ]);

                if($userInsertResult){
                $userId = $userInsertResult->getPrimary();
                $tokenInsert = $this->model->context->table('tokens')->insert([
                    'token' => $token,
                    'userId' => $userId
                ]);

                if($tokenInsert)
                {
                    $expiry = time() + 60 * 60 * 24 * 30;
                    $this->getHttpResponse()->setCookie('token', $token, $expiry);
                    $this->redirect('Keywords:default');
                    exit();
                }
               
                }
            }
    }
}