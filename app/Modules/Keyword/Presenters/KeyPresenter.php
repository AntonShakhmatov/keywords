<?php

namespace App\Modules\Keyword\Presenters;

use Nette;
use App\Model\KeywordsModel;
use App\Presenters\BasePresenter;

class KeyPresenter extends BasePresenter
{
    /**
     * @param KeywordsModel 
     */
    private $model;

    public function __construct(KeywordsModel $model){
     $this->model = $model;   
    }

    public function renderDefault():void
{
    $values = $this->model->connection->fetchAll('SELECT `keywords` FROM `words`');

	$val = $this->sendJson($values);

}
}