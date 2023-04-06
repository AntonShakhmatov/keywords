<?php

namespace App\Presenters;

use Nette;
use Nette\Http\Response;
use Nette\Http\Request;
use App\Model\FetchModel;
use Nette\Utils\Json;
use Nette\Application\UI\Form;
use App\Presenters\BasePresenter;

class KeywordsPresenter extends BasePresenter
{
    private $model;
    private $form;

    // public function __construct(FetchModel $model){
    //  parent::startup();
    //  $this->model = $model;
    // }

    public function __construct(Request $request, Response $httpResponse, FetchModel $model){
        parent::__construct($request, $httpResponse);
        $this->model = $model;
    }

    public function createComponentAutocompleteForm(): Form
    {
        $form = new Form;

        $autocompleteInput = $form->addAutocomplete('keywords', 'Napis svuj dopis', function (string $query) {
            $values = $this->model->database->table('words');   

            foreach($values as $val){
                $keywords[] = strtolower($val->keywords);
                // $keywords[] = $val->keywords;
            }

            $queryWords = explode(' ', strtolower($query));

            $matches = [];
            foreach ($keywords as $keyword) {
                foreach ($queryWords as $queryWord) {
                    if (strpos($keyword, $queryWord) !== false) { 
                        $matches[] = $keyword;
                    }
                }
            }
            $lastMatch = end($matches); // get last element
            return [$lastMatch];
        });
        $autocompleteInput->setAutocompleteMinLength(1); //input length
        return $form;
    }

    public function actionProfile(){
        $this->authorizeUser($user->name);
        $this->template->user = $user;
    }
}
