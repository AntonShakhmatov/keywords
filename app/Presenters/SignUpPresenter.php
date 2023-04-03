<?php

namespace App\Presenters;

use Nette;
use Nette\Http\Request;
use Nette\Http\Response;
use Nette\Application\UI\Form;
use App\Model\FetchModel;
// use App\Presenters\BasePresenter;
use Nette\Application\UI\Presenter;

class SignUpPresenter extends Presenter{
    private $model;
    private $httpResponse;
    private $token;
    public function __construct(FetchModel $model, Response $httpResponse){
        parent::startup();
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

		$form->onSuccess[] = function() use ($form) {
            $this->token =  bin2hex(random_bytes(32));
			$values = $form->getValues();
			$this->model->context->table('users')->insert([
				'login' => $values->email,
				'password' => $this->model->passwords->hash($values->pwd2),
                'token' => $this->token
			]);  
            $this->httpResponse->addHeader('Authorization', "Bearer {$this->token}");     
            $this->redirect('Keywords:default');
		};	
            return $form;
        }
    }