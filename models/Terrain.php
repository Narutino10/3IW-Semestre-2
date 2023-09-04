<?php

namespace Models;

use Model;
use PDO;


class Terrain extends Model
{



    public function allTerrain()  {

        $stmt = parent::$con->query('SELECT * from terrain');
        $terrains = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $terrains;

    }

    public function updateTerrain($data)  {

       
        $updateStmt =  parent::$con->prepare('UPDATE terrain SET location = \'occupé\' WHERE id = :id');
        $updateStmt->bindParam(':id', $data['id']);
        if($updateStmt->execute()){
            return true;
        }

        return false;

    }


    

    


}