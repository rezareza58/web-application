<?php 
    
    $firstname = $_GET['firstname']?? NULL;
    $firstname = htmlentities($firstname);
    $lastname = $_GET['lastname']?? NULL;
    $lastname = htmlentities($lastname);
?>