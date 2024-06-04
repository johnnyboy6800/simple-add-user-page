<?php
define('HOST', 'localhost');
define('PORT', '3306');
define('DBNAME', 'user_infos');
define('USER', 'lucas');
define('PASSWORD', '80050308');

try {
    $dsn = new PDO("mysql:host=". HOST. ";port=". PORT . ";dbname=". DBNAME. ";user=". USER. ";password=". PASSWORD);
} catch (PDOException $e) {
    echo 'Ocorreu um erro durante a execução:'. $e->getMessage();
}

$stmt = $dsn -> prepare("INSERT INTO user_infos(nome, cpf, email, nascimento)
Values (?,?,?,?)
");

$resultset = $stmt -> execute([$_REQUEST['nome_completo'], $_REQUEST['cpf'], $_REQUEST['email'], $_REQUEST['nascimento']]);

if ($resultset) {
    echo 'Os dados foram inseridos com sucesso';
} else {
    echo 'ocorreu um erro';
}

$instrução = "Select nome_completo, cpf, email, nascimento From usuarios";
$resultset = $dsn ->query($instrução);

$stmt = null;
$dsn = null;
