<?php

namespace Models;

use Model;
use PDO;


class Article extends Model
{

    
    public function allBlogs()  {


        $stmt = parent::$con->query('SELECT * from blogs 
        left join  blogcat ON blogs.blogcat = blogcat.cat_id');
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $blogs;

        
    }
    public function addBlog($data)  {

        $stmt = parent::$con->prepare('INSERT INTO blogs (title, blogtext, blogcat, blogimage) VALUES (?, ?, ?, ?)');
        $inserted = $stmt->execute([$data['blogtitle'], $data['blogcontent'], $data['blogcat'], $data['filename']]);

        if ($inserted){
            return true;
        }
        return false;

    }


    public function updateBlog($data)  {

       
        $sql = "UPDATE blogs SET title = ?, blogtext = ?, blogcat = ?, blogimage = ? WHERE id= ?";
        $stmt= parent::$con->prepare($sql);
         if($stmt->execute([$data['blogtitle'], $data['blogcontent'], $data['blogcat'], $data['filename'], $data['blogid']])){
          return true;
         }
         return false;



        if ($inserted){
            return true;
        }
        return false;

    }


    public function getBlogById($id)  {

        
        $query = "SELECT * from blogs 
        left join  blogcat ON blogs.blogcat = blogcat.cat_id where blogs.id = :id ORDER BY blogs.id DESC";
        $stmt = parent::$con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);
        return $blog;
        
    }



    public function addCategory($data)  {

        $stmt = parent::$con->prepare('INSERT INTO blogcat (cat_title) VALUES (?)');
        $inserted = $stmt->execute([$data['categoryname']]);

        if ($inserted){
            return true;
        }
        return false;

    }
    
    public function allCategory()  {

        $stmt = parent::$con->query('SELECT * from blogcat');
        $categoryies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $categoryies;

    }

    

    

    public function currentRentals()  {

        $stmt = parent::$con->query('SELECT location.id, client.nom, location.date_location, location.horaire, location.score 
    FROM location 
    JOIN client ON location.client_id = client.id');
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $locations;


    }


    


}