<?php

namespace App\Services;

use Nette;
use Nette\Security\Identity;
use Nette\Security\Authenticator;
use Nette\Security\AuthenticationException;
use App\Model\FetchModel;

class MyAuthenticator implements Authenticator
{
    private $model;

	public function __construct(FetchModel $model) {
        $this->model = $model;
	}

	public function authenticate($username, $password): Identity
	{
		$row = $this->model->context->table('users')
			->where('login', $username)
			->fetch();

		if (!$row) {
			throw new AuthenticationException('User not found.');
		}
		
		if (!$this->model->passwords->verify($password, $row->password)) {
			throw new AuthenticationException('Password not found.');
		}

		return new Identity(
			$row->id,
			['username' => $row->login],
		);
	}
}