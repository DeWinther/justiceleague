<?php

include(ROOT_DIR."/util/db.php");

class category
{
    private $id;
    private $category;

    public function __construct($id = null, $category = null)
    {
        $this->id = $id;
        $this->category = $category;

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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getAllUniqueCategories()
    {
        $sql = "SELECT distinct category FROM justice_league.category";

        $results = $this->conn->query($sql);

        foreach ($results as $result)
        {
            $categories[] = $result['category'];
        }

        return $categories;
    }

    public function getCategories()
    {
        $sql = "SELECT id, category FROM `category`";

        $results = $this->conn->query($sql);

        $this->conn->close();

        foreach ($results as $result){
            $questions[] = $result;

        }

        return $questions;
    }
}

