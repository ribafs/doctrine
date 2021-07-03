<?php
    use Doctrine\DBAL\DriverManager;
    require_once "../bootstrap.php";
    $conn = DriverManager::getConnection($connectionParams, $config);
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b>CRUD com Doctrine</h3></b></div>
        <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6">

        <table class="table table-bordered table-responsive table-hover">    
            <form method="post" action="add.php">           
            <tr><td>Name</td><td><input type="text" name="name" autofocus></td></tr>
            <tr><td>E-mail</td><td><input type="text" name="email"></td></tr>
            <tr><td>SSN</td><td><input type="text" name="ssn"></td></tr>
            <tr><td></td><td><input class="btn btn-primary" name="enviar" type="submit" value="Cadastrar">&nbsp;&nbsp;&nbsp;
            </form>
        </table>
        </div>
    </div>
</div>

<?php
if(isset($_POST['enviar'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ssn = $_POST['ssn'];;

    $conn->insert('customers', array('name' => $name, 'email' => $email, 'ssn' => $ssn));

    header('location: index.php');
}
