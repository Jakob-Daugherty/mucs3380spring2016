<?php
  
        echo("<div class='content'> <h1>called checkInOut</h1></div>");
        $link = mysqli_connect("localhost", "mcm6y9", "4623vrxv", "FinalProject") or die ("connection Error " . mysqli_error($link));
        //echo "<h4>Check In</h4>";
        $sql = "Select available from item where id=?";
        if($stmt = mysqli_prepare($link,$sql)){
            $id = $_POST['id'];
            mysqli_stmt_bind_param($stmt, "s", $user) or die("Bind param");
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt, $salt, $hpass, $uType );
                if(mysqli_stmt_fetch($stmt)){
                    if($sql == 0){
                        echo("<h4>Item Is checked Out</h4>");
                        
                    }else {
                        echo("<h4>Item is checked In</h4>");
                    }
                    
                }
            }
            
        }

    


?>