
<?php

class db
{
    public $con;
    public function __construct(){
        $this->con = mysqli_connect("localhost","root","","mydb");
        if (!$this->con) {
            echo "Error in Connecting ".mysqli_connect_error();
            }
    }
}

?>