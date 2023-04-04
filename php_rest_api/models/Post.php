<?php

class Post
{
    private $conn;
    private $table = 'posts';
    private $id;
    private $category_id;
    private $category_name;
    public $title;
    public $author;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET posts
    public function read()
    {
        $query = 'SELECT c.name as category_name, 
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM 
        ' . $this->table . ' p 
        LEFT JOIN
         categories c ON p.category_id = c.id
         ORDER BY
         p.created_at DESC
         ';

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // execute the query
        $stmt->execute();

        // fetch all posts as an associative array
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // return the posts data
        return $posts;
    }
}
