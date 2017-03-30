<?php
include("util/db.php");

class category
{
    private $id;
    private $category;

//    public function __construct($id = null, $category = null)
//    {
//        $this->id = $id;
//        $this->category = $category;
//    }

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
        $conn = dbConnect("justice_league");
        $sql = "SELECT distinct category FROM justice_league.category";

        $results = $conn->query($sql);

        foreach ($results as $result){
            $categories[] = $result['category'];

        }

        return $categories;
        // fetch all categories from DB, and return array.
        // SELECT DISTINCT category FROM category;
    }
}

