<?php

include_once(ROOT_DIR."/util/db.php");

class answer
{
    private $id;
    private $questionId;
    private $answer;

    public function __construct($id = null, $question_id = null, $answer = null)
    {
        $this->id = $id;
        $this->questionId = $question_id;
        $this->answer = $answer;

        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();
    }

    public function getQuestionId()
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId)
    {
        $this->questionId = $questionId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setAnswer(string $answer)
    {
        $this->answer = $answer;
    }

    public function getAnswerById ($id)
    {
        $sql = "SELECT id, answer FROM `answer` WHERE `question_id` = '$id' ";

        $results = $this->conn->query($sql);

//        $this->conn->close();
        $answer = [];

        foreach ($results as $result){
            $answer[] = $result;

        }

        return $answer;
    }

    public function getAuthor($id){
        $sql = "SELECT username FROM `user` WHERE id = ".$id;

        $results = $this->conn->query($sql);

        $author = $results->fetch_array();

        return $author['username'];
    }



}