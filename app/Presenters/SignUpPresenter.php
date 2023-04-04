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
        $value = $form->getValues();
        $user = $this->model->database->table('users')
            ->where('login', $value->email)
            ->select('id')
            ->fetch();

            if(is_null($user)){
                $this->token =  bin2hex(random_bytes(32));
                $login = $value->email;
                $password = $this->model->passwords->hash($value->pwd2);
                $userInsertResult = $this->model->context->table('users')->insert([
                    'login' => $login,
                    'password' => $password
                ]);
                if($userInsertResult){
                $userId = $userInsertResult->getPrimary();

                $tokenInsert = $this->model->context->table('tokens')->insert([
                    'token' => $this->token,
                    'userId' => $userId
                ]);

                if(!$tokenInsert){
                    $this->httpResponse->setCode(Response::S403_FORBIDDEN);
                }
               
                }
                else
                {
                    $this->getHttpResponse()->setCode(200);
                    $this->httpResponse->addHeader('Authorization', "Bearer {$this->token}");     
                    $this->redirect('Keywords:default');
                }
            }
            else
            {
                $this->getHttpResponse()->setCode(303);
            }  
		};	
            return $form;
        }
    }