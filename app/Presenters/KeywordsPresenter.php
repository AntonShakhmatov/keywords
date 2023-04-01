<?php

namespace App\Presenters;

use Nette;
use Nette\Http\Request;
use App\Model\FetchModel;
use Nette\Utils\Json;
use Nette\Application\UI\Form;
use App\Presenters\BasePresenter;

class KeywordsPresenter extends BasePresenter
{
    /**
    * @param FetchModel 
    */
    private $model;

    /**
     * @param Form
     */
    private $form;

    public function __construct(FetchModel $model){
     $this->model = $model;
    }

    public function createComponentAutocompleteForm(): Form
    {
        $form = new Form;

        $autocompleteInput = $form->addAutocomplete('keywords', 'Napis svuj dopis', function (string $query) {
            $values = $this->model->database->table('words');   

            foreach($values as $val){
                $keywords[] = strtolower($val->keywords);
            }

            $queryWords = explode(' ', strtolower($query));

            $matches = [];
            foreach ($keywords as $keyword) {
                $matchedWords = [];
                foreach ($queryWords as $queryWord) {
                    if (strpos($keyword, $queryWord) !== false) { 
                        $matches[] = $keyword;
                    }
                }
            }
            return $matches;
        });
        $autocompleteInput->setAutocompleteMinLength(1); //input length

        return $form;
    }
}
