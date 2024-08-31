<?php
include"init.php";

if(($_SESSION["role"]) == 'student'){ 
    header("Location: student.php");
}else if(($_SESSION["role"]) == 'trainer'){ 
    header("Location: trainer.php");
}else if(($_SESSION["role"]) == 'director'){
    header("Location: director.php");
}
else{
    header("Location: index.php");
}

?>
