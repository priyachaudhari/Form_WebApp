<?php
 
include "db.php";

class crud extends db{

    //Inserting data into the database

    public function insert($table,$field){
        //"INSERT INTO table_name (, , ) VALUES ('m_name','qty')";
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(", ", array_keys($field)).") VALUES ";
        $sql .= "('".implode("' ,' ", array_values($field))."')";
        $query = mysqli_query($this->con,$sql);     
        echo $sql; 
        if($query){
            return true;
        }
    }

    //Fetching the whole table from database

    public function fetch($table){
        $sql = "SELECT * FROM ".$table;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }

    //Select particular data from the table 

    public function select($table,$where){
        $sql ="";
        $condition = "";
        foreach($where as $key => $value){
            //id = '5' where first_name = 'something'
            $condition .= $key . "='". $value . "' AND ";
        }
        $condition = substr($condition,0,-5);
        $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
        $query = mysqli_query($this->con,$sql);
        $row = mysqli_fetch_array($query);
        return $row;
    }


    //Updating the table in database

    public function update($table,$where,$field){
        
        $sql="";
        $condition="";
    
        foreach($where as $key => $value){
            //id = '5' where first_name = 'something'           
            $condition .= $key . "='". $value . "' AND ";           
        }
        $condition = substr($condition,0,-5);

        foreach($field as $key => $value){
            //update tabelname set first_name = '', last_name='' where id= '';
            $sql .= $key . "='".$value."',";
        }
        $sql = substr($sql,0,-1);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ". $condition;
        echo $sql;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }

    // Deleting the table in database

    public function delete($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql = "DELETE FROM ".$table." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }

}

$crud = new crud();  //Class object to access the functions

//When Save button is selected

if(isset($_POST["save"])){
    $array = array(
        "First_Name" => $_POST["first_name"],
        "Last_Name" => $_POST["last_name"],
        "Email" => $_POST["email"],
        "Marks" => $_POST["marks"],
        "Status" => $_POST["status"],
        "Profile_Picture" => $_POST["profile_picture"]    
    );

if($crud->insert("data",$array)){
    header("location:index.php?msg=record inserted!");  //Sends back to index page when query is true
}
}

//When edit button is selected 

if(isset($_POST["edit"])){
    $id = $_POST["id"];
    $where = array("id"=>$id);
    $array = array(
        "First_Name" => $_POST["first_name"],
        "Last_Name" => $_POST["last_name"],
        "Email" => $_POST["email"],
        "Marks" => $_POST["marks"],
        "Status" => $_POST["status"],
        "Profile_Picture" => $_POST["profile_picture"]
    );
    
if($crud->update("data",$where,$array)){
        header("location:index.php?msg=record updated!");   //Sends back to index page when query is true
}
}

//When delete button is selected

if(isset($_GET["delete"])){
    $id = $_GET["id"] ?? null;
    $where = array("id"=>$id);
    if($crud->delete("data",$where)){
        header("location:index.php?msg=Record Deleted!");
    }
}

?>