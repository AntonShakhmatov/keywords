<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Http\Request;
use Nette\Http\Response;
use Nette\Application\UI\Presenter;

/**
 * Základní presenter pro všechny ostatní presentery aplikace.
 * @package App\Presenters
 */
abstract class BasePresenter extends Presenter
{
    private $request;
    private $httpResponse;

    public function __construct(Request $request,  Response $httpResponse){
        $this->request = $request;
        $this->$httpResponse = $httpResponse;
    }
    protected function startup(): void
    {
        parent::startup();
        $authorizationHeader = $this->request->getHeader('Authorization');
        if ($authorizationHeader === null) {
            $this->redirect('Auth:default');
        }
    }

    // protected function authorizeUser($name)
    // {
    //     $row = $this->database->table('users')
    //         ->where('login', $name)
    //         ->select('token')
    //         ->fetch();
    //     $this->httpResponse->addHeader('Authorization', "Bearer {$token}");
    // }
    
}