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
// exibindo a table 'clientes' localizada no banco de dados
if ($resultset) {
    while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
        echo 'Nome: ' . htmlspecialchars($row['nome_completo']) . '<br>';
        echo 'CPF: ' . htmlspecialchars($row['cpf']) . '<br>';
        echo 'Email: ' . htmlspecialchars($row['email']) . '<br>';
        echo 'Nascimento: ' . htmlspecialchars($row['nascimento']) . '<br>';
        echo '<hr>';
    }
    } else {
    echo 'Ocorreu um erro ao buscar os dados';
    }
} catch (PDOException $e) {     
    echo 'Ocorreu um erro durante a execução: '. $e->getMessage();
}

// encerrando a conexão com o banco de dados
$stmt = null;
$dsn = null;
