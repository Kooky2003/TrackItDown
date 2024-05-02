<?php
require('connection.php');
        $query= "SELECT *FROM sujen";

        $res = mysqli_query($con,$query);

        if($res)
         {
    
            $data = $res->fetch_all(MYSQLI_ASSOC);

            //api creation
            echo json_encode($data);
            
        }


        $con->close();


