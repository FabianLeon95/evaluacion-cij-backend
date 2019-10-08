<?php


namespace App\Models;


class QuestionsWithAnswers
{
    public $id;
    public $statement;
    public $type;
    public $answers;

    /**
     * QuestionsWithAnswers constructor.
     * @param $id
     * @param $statement
     * @param $type
     * @param $answers
     */
    public function __construct($id, $statement, $type, $answers)
    {
        $this->id = $id;
        $this->statement = $statement;
        $this->type = $type;
        $this->answers = $answers;
    }

}