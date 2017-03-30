<?php

class question
{
    private $id;
    private $authorId;
    private $category;
    private $question;

    public function __construct($id, $authorId, $category, $question)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->category = $category;
        $this->question = $question;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

}