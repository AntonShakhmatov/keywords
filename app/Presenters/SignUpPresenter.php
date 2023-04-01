<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\FetchModel;
use App\Presenters\BasePresenter;

class SignUpPresenter extends BasePresenter{

    /**
     * @param FetchModel 
     */
    /**
     * @var Passwords
     */
    private $passwords;
    private $model;
    public function __construct(FetchModel $model){
        $this->model = $model;
    }

    protected function createComponentForm()
	{
		$form = new Form();

		$form->addEmail('email', 'Email')->setRequired('Please enter email');
		$passwordInput = $form->addPassword('pwd', 'Password')->setRequired('Please enter password');
		$form->addPassword('pwd2', 'Password (verify)')->setRequired('Please enter password for verification')->addRule($form::EQUAL, 'Password verification failed. Passwords do not match', $passwordInput);
		$form->addSubmit('register', 'Register');

		$form->onSuccess[] = function() use ($form) {
			$values = $form->getValues();
			$this->model->context->table('users')->insert([
				'login' => $values->email,
				'password' => $this->model->passwords->hash($values->pwd2),
			]);
		};

		$form->onSuccess[] = function() {
			$this->redirect('Keywords:default');
		};

		return $form;
	}

    public function renderDefault(){
    //    return $this->template->form;
    }

}