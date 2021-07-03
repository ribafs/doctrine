<?php
// update_customer.php <id> <new-name>|<new-email>|<new-ssn>
require_once "../bootstrap.php";
use Doctrine\DBAL\DriverManager;

$id = $_REQUEST['id'];
$sth = $conn->executeQuery("SELECT * FROM customers WHERE id = $id");
$row = $sth->fetchAssociative();

$name = $row['name'];
$email = $row['email'];
$ssn = $row['ssn'];
?>

<div><h3><b>CRUD com Doctrine<br>Atualizar</h3></b></div>
     <form method="post" action="update.php">
         <table>
            <tr><td><b>Name</td><td><input type="text" name="name" value="<?=$name?>"></td></tr>
            <tr><td><b>E-mail</td><td><input type="text" name="email" value="<?=$email?>"></td></tr>
            <tr><td><b>SSN</td><td><input type="text" name="ssn" value="<?=$ssn?>"></td></tr>
            <input name="id" type="hidden" value="<?=$id?>">
             <tr><td></td><td><input name="enviar" type="submit" value="Editar">
        </table>
    </form>
</div>

<?php

if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ssn = $_POST['ssn'];

    $conn->update('customers', array('name' => $name, 'email' => $email, 'ssn' => $ssn), array('id' => $id));

    header('location: index.php');
}
