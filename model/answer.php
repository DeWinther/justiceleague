<?php

class answer
{
    private $id;
    private $questionId;
    private $answer;

    public function __construct($id, $question_id, $answer)
    {
        $this->id = $id;
        $this->questionId = $question_id;
        $this->answer = $answer;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId)
    {
        $this->questionId = $questionId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer)
    {
        $this->answer = $answer;
    }
}