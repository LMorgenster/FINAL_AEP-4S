<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content ="IE=edge">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <title>CRUD DA AEP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Lista de Chamados</h2>
        <a class="btn btn-primary" href="/CRUD_AEP/create.php" role="button">Novo Chamado</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>CPF</th>
                    <th>E-Mail</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Chamado Criado em</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "crud_aep";

                $connection = new mysqli($servername, $username, $password, $database);

                if($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM users";
                $result = $connection->query($sql);

                if(!$result) {
                    die("Query inválida: " . $connection->connect_error);
                }

                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[age]</td>
                        <td>$row[cpf]</td>
                        <td>$row[email]</td>
                        <td>$row[address]</td>
                        <td>$row[phone]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/CRUD_AEP/edit.php?id=$row[id]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='/CRUD_AEP/delete.php?id=$row[id]'>Deletar</a>
                        </td>
                    </tr>
                    ";
                }


                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
