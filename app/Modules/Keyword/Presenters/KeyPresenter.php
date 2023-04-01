<?php

namespace App\Modules\Keyword\Presenters;

use Nette;
use App\Model\FetchModel;
use App\Presenters\BasePresenter;

class KeyPresenter extends BasePresenter
{
    /**
     * @param FetchModel 
     */
    private $model;

    public function __construct(FetchModel $model){
     $this->model = $model;   
    }

    public function renderDefault():void
{
    $values = $this->model->connection->fetchAll('SELECT `keywords` FROM `words`');

	$val = $this->sendJson($values);

}
}