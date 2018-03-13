<?php 
require_once __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../../config/config.php';
require __DIR__.'/../Service/DBConnector.php';


if($_SERVER['REQUEST_METHOD']==='POST') {
    $firstname = $_POST['firstname'] ?? NULL;
    $lastname = $_POST['lastname'] ?? NULL;
    $email = $_POST['email'] ?? NULL;
    $pass_1 = $_POST['pass_1'] ?? NULL;
    $pass_2 = $_POST['pass_2'] ?? NULL;
    
    $firstnameSuccess = (is_string($firstname) && strlen($firstname)>3);
    $lastnameSuccess = (is_string($lastname) && strlen($lastname)>3);
    $emailSuccess = (is_string($email));
    $passSuccess = (($pass_1 === $pass_2) && strlen($pass_1)>7);
    
    if ($firstnameSuccess && $passSuccess && $lastnameSuccess && $emailSuccess){
        try {
            $connection = Service\DBConnector::getConnection();
        } catch (PDOException $e) {
            http_response_code(500);
            echo 'A problem occured to connecting to server';
            exit(1);
        }
        $sql = "INSERT INTO user(firstname, lastname, email, pass) VALUES (\"$firstname\", \"$lastname\", \"$email\", \"$pass_1\")";
        $working = $connection->execute($sql);
        
        if (!$working){
            echo implode(',', $connection->errorInfo());
            return ;
        }
        $id = $connection->lastInsertIduser();
        echo 'data stored';
        return ;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>register</title>
  <link rel="stylesheet" href="/../../css/style.css">
</head>
<body>

  <div id="first">

    <h1>First Web Application</h1>
    <form id="reg" action="/src/Controller/register.php" method="POST">
    	<h3>registration</h3>
    	
    	
        <?php if (!($firstnameSuccess ?? true)) {?>
        <div>
        	<p>check your Firstname</p>
        </div>
        <?php }?>
        <label for="firstname">Your firstname :</label>
        <br>
        <input type="text" name="firstname" value="<?php echo htmlentities($firstname ?? '')?>" placeholder="atleast 4 char." required>
        <br>
        
        
        <?php if (!($lastnameSuccess ?? true)) {?>
        <div>
        	<p>check your Lastname</p>
        </div>
        <?php }?>
        <label for="lastname">Your Lastname :</label>
        <br>
        <input type="text" name="lastname" value="<?php echo htmlentities($lastname ?? '')?>" placeholder="atleast 4 char." required>
        <br>
        
        
        <?php if (!($emailSuccess ?? true)) {?>
        <div>
        	<p>check your Email</p>
        </div>
        <?php }?>
        <label for="email">Your Email :</label>
        <br>
        <input type="email" name="email" value="<?php echo htmlentities($email ?? '')?>" placeholder="Your Email" required>
        <br>
        
        
        <?php if (!($passSuccess ?? true)) {?>
        <div>
        	<p>check your Password</p>
        </div>
        <?php }?>
        <label for="pass_1">Your Password :</label>
        <br>
        <input type="password" name="pass_1" value="" placeholder="atleast 8 char." required>
        <br>
        
        
        <label for="pass_2">Your Password :</label>
        <br>
        <input type="password" name="pass_2" value="" placeholder="Retype your password" required>
        <br>
        
        
        <button type="submit">Register</button>
    </form>


    <form id="logout" class="" action="index.html" method="post">
      <h3>Logout</h3>
      <button type="submit" name="button">Logout</button>
    </form>

  </div>

</body>
</html>
