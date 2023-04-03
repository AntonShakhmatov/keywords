<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Http\Request;
use Nette\Application\UI\Presenter;

/**
 * Základní presenter pro všechny ostatní presentery aplikace.
 * @package App\Presenters
 */
abstract class BasePresenter extends Presenter
{
    /**
     * @param Request
     */
    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }
    protected function startup(): void
    {
        parent::startup();
        $authorizationHeader = $this->request->getHeader('Authorization');
        if ($authorizationHeader === null) {
            $this->redirect('Auth:default');
        }
    }
    
}