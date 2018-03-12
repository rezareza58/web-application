<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My title here</title>
    </head>
    <body>
    <?php 
        $displayAccountEmail= $_GET['email'] ?? null;
        if (!$displayAccountEmail) {
     ?>
            <div><p>enter valid email</p></div>
     <?php 
        }else{
            try {
                $connection = Service\DBConnector::getConnection();
            } catch (PDOException $e) {
                http_response_code(500);
                echo 'aproblem occured';
                exit (1);
            }
            $sql = 'SELECT* FROM user WHERE email = :email';
            $statment = $connection->prepare($sql);
            $statment->bindparam('email', $displayAccountEmail, PDO::PAPAM_STR);
            $statment-execute();
            
            
            $allResults = $statment->fetchAll();
            if (empty($allResults)) {
                ?>
      			<div><p>enter valid email</p></div>
      			<?php 
      		    return;
            }
            foreach($allResults as $aLine){
                ?>
                <div>
                	<p>id : <?php echo $aLine['iduser']; ?></p>
                	<p>firstname : <?php echo $aLine['firstname']; ?></p>
                	<p>lastname : <?php echo $aLine['lastname']; ?></p>
                	<p>emaile : <?php echo $aLine['emaile']; ?></p>
                </div>
                <?php 
            }  
        }
      ?>
    </body>
</html>