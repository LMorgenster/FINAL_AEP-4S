<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_aep";

$connection = new mysqli($servername, $username, $password, $database);

$id="";
$name="";
$age="";
$cpf="";
$email="";
$address="";
$phone="";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(!isset($_GET["id"])) {
        header("location: /CRUD_AEP/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /CRUD_AEP/index.php");
        exit;
    }

    $name = $row["name"];
    $age = $row["age"];
    $cpf = $row["cpf"];
    $email = $row["email"];
    $address = $row["address"];
    $phone = $row["phone"];
} else {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    do {
        if(empty($name) || empty($age) || empty($cpf) || empty($email) || empty($address) || empty($phone)){
            $errorMessage = "Todos os campos devem ser preenchidos.";
            break;
        }

        $sql = "UPDATE users " . "SET name = '$name', age = '$age', cpf = '$cpf', email = '$email', address = '$address', phone = '$phone'" .
        "WHERE id = $id";

        $result = $connection->query($sql);

        if(!$result) {
            $errorMessage = "Registro Inválido: " . $connection->error;
            break;
        }

        $name="";
        $age="";
        $cpf="";
        $email="";
        $address="";
        $phone="";

        $successMessage = "Novo cliente adicionado.";

        header("location: /CRUD_AEP/index.php");
        exit;

    } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content ="IE=edge">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <title>CRUD DA AEP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Novo Chamado</h2>

        <?php
        if(!empty($errorMessage)){
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
        ?>
        
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Idade</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">CPF</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cpf" value="<?php echo $cpf ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">E-Mail</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                    <div class='row mb-3>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                ";
            }
            ?>
            
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn bttn-outline-primary" href="/CRUD_AEP/index.php" role="button">Cancelar</a>
                </div>
                
            </div>
        </form>
    </div>
</body>
</html>