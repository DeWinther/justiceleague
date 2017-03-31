<?php

include("/../util/db.php");

class question
{
    private $conn;
    private $id;
    private $authorId;
    private $category;
    private $question;

    public function __construct($id = null, $authorId = null, $category = null, $question = null)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->category = $category;
        $this->question = $question;

        $this->conn = dbConnect("justice_league");
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAuthor($id){
        $sql = "SELECT username FROM `user` WHERE id = ".$id;

        $results = $this->conn->query($sql);

        $author = $results->fetch_array();

//        var_dump($author['username']);
//        $this->conn->close();
//        var_dump($results->fetch_array()[0]);

        return $author['username'];
    }
    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }
    public function getQuestions(){

        $sql = "SELECT id, author_id, category, question FROM `question` ORDER BY `category`";

        $results = $this->conn->query($sql);

        $this->conn->close();

        foreach ($results as $result){
            $questions[] = $result;

        }

        return $questions;
    }

}