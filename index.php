<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$_ENV['DB_NAME'];



/*$pdo = new PDO('mysql:host=localhost;dbname=crud','kiko','112233');*/
$pdo = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD']);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


$sql = $pdo->prepare("SELECT * FROM clientes");
$sql->execute();

$fetchClientes = $sql->fetchAll();

echo "
<table width='1200' border='1' align='center'>
<thead>
    <tr>
        <th>Editar</th>
        <th>Excluir</th>
        <th>Nome</th>
        <th>Email</th>
    </tr>
</thead>";
foreach ($fetchClientes as $key => $value){
    echo "<tr>";
    echo '<td align="center"><a href="?editar='.$value['id'].'">[EDITAR]</a></td>
            <td align="center"><a href="?delete='.$value['id'].'">[EXCLUIR]</a></td>
            <td>'.$value['nome'].' </td>
            <td> '.$value['email'] . '</td>';
    echo "<tr>";  
}
echo "</table>";
?>