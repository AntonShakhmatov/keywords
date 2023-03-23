<?php

namespace App\Services;

use Nette;
use Nette\Security\SimpleIdentity;
use Nette\Security\Authenticator;
use Nette\Security\AuthenticationException;
use App\Model\FetchModel;

class MyAuthenticator implements Authenticator
{
    /**
     * @param FetchModel
     */
    private $model;

	public function __construct(FetchModel $model) {
        $this->model = $model;
	}

	public function authenticate($username, $password): SimpleIdentity
	{
		$row = $this->model->database->table('users')
			->where('login', $username)
			->fetch();

		if (!$row) {
			throw new AuthenticationException('User not found.');
		}

        // $pass = $this->model->database->table('users')
        //     ->where('password', $password)
        //     ->fetch();

        // if (!$pass) {
        //     throw new AuthenticationException('Invalid password.');
        // }

		if (!$this->model->passwords->verify($password, $row->password)) {
			throw new AuthenticationException('Invalid password.');
		}

		return new SimpleIdentity(
			$row->id,
			$row->role, // или массив ролей
			['name' => $row->username],
		);
	}
}