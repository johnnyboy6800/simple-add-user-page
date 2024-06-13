<?php
define('HOST', 'localhost');
define('PORT', '3306');
define('DBNAME', 'usuarios');
define('USER', 'lucas');
define('PASSWORD', '80050308');

try {
    $dsn = new PDO("mysql:host=". HOST. ";port=". PORT . ";dbname=". DBNAME. ";user=". USER. ";password=". PASSWORD);
} catch (PDOException $e) {
    echo 'Ocorreu um erro durante a execução:'. $e->getMessage();
}
try {
$stmt = $dsn -> prepare("INSERT INTO clientes(nome_completo, cpf, email, nascimento)
Values (?,?,?,?)
");

$resultset = $stmt -> execute([$_REQUEST['nome_completo'], $_REQUEST['cpf'], $_REQUEST['email'], $_REQUEST['nascimento']]);



$instrução = "Select nome_completo, cpf, email, nascimento From clientes";
$resultset = $dsn ->query($instrução);

echo '
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
<table class="table table-dark">
<thead>
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Email</th>
        <th scope="col">Nascimento</th>
    </tr>
</thead>
<tbody>';

if ($resultset) {
while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
echo '<tr>';
echo '<td>' . htmlspecialchars($row['nome_completo']) . '</td>';
echo '<td>' . htmlspecialchars($row['cpf']) . '</td>';
echo '<td>' . htmlspecialchars($row['email']) . '</td>';
echo '<td>' . htmlspecialchars($row['nascimento']) . '</td>';
echo '</tr>';
}
} else {
echo '<tr><td colspan="4">Nenhum resultado encontrado</td></tr>';
}

echo '</tbody></table>';
} catch (PDOException $e) {
echo 'Ocorreu um erro ao buscar os dados: '. $e->getMessage();
}

$stmt = null;
$dsn = null;
?>
