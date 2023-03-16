<?php

namespace App\Presenters;

use Nette;
use Nette\Http\Request;
use App\Model\KeywordsModel;
use Nette\Utils\Json;
use Nette\Application\UI\Form;
use App\Presenters\BasePresenter;

class KeywordsPresenter extends BasePresenter
{
    /**
    * @param KeywordsModel 
    */
    private $model;

    /**
     * @param Form
     */
    private $form;

    public function __construct(KeywordsModel $model){
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

            $queryWords = explode(' ', strtolower(trim($query)));

            $matches = [];
            foreach ($keywords as $keyword) {
                $matchedWords = [];
                foreach ($queryWords as $queryWord) {
                    if (strpos($keyword, $queryWord) !== false) { 
                        $matchedWords[] = $queryWord;
                    }
                }
                if (count($matchedWords) == count($queryWords)) { // check if all query words are matched in the keyword
                    $matches[] = $keyword;
                }
            }
            return $matches;
        });
        $autocompleteInput->setAutocompleteMinLength(1); // set minimum input length to trigger autocomplete

        return $form;
    }
}
