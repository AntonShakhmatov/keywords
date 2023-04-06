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
        $this->httpResponse = $httpResponse;
    }
    protected function startup(): void
    {
        parent::startup();
        $token = $this->getHttpRequest()->getCookie('token');
        if ($token) {
            $this->httpResponse->addHeader('Authorization', 'Bearer ' . $token);
        }
        // var_dump($this->httpResponse->getHeader('Authorization'));
    }    
}