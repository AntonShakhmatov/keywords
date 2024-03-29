<?php

namespace App\Presenters;

use Nette;
use App\Presenters\BasePresenter;
use Nette\Http\Request;
use Nette\Http\Response;
use Nette\Application\UI\Form;
use App\Model\FetchModel;

class FetchPresenter extends BasePresenter
{
private $request;
private $model;

public function __construct(FetchModel $model, Request $request, Response $httpResponse){
    parent::__construct($request, $httpResponse);
    $this->model = $model;
    $this->request = $request;
}

protected function startup(): void
{
    parent::startup();
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