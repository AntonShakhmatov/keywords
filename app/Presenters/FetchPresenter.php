<?php

namespace App\Presenters;

use Nette;
use App\Presenters\BasePresenter;
use Nette\Http\Request;
use Nette\Application\UI\Form;
use App\Model\FetchModel;

class FetchPresenter extends BasePresenter

{

/**
 * @param Request
 */    
private $request;

/**
 * @param FetchModel
 */
private $model;

public function __construct(FetchModel $model, Request $request){
    parent::__construct();
    $this->model = $model;
    $this->request = $request;
}

protected function createComponentTextForm()
{
	$form = new Form;
	$form->addText('text');
	$form->addSubmit('submit');
    $form->onSuccess[] = [$this, 'recordFormSucceeded'];
	return $form;
}

public function recordFormSucceeded(Form $form, array $data): void
{
    $value = $form->getValues();
    $this->model->database->table('words')->insert([
        'keywords' => $value->text
    ]);
}

public function renderDefault(){    

}

}

?>