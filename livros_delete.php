<?php

require_once './vendor/autoload.php';

use  ExemploPDOMySQL\MySQLConnection;

$bd = new MySQLConnection();

$livro = null;

if($_SERVER['REQUEST_METHOD'] == 'GET') {
$comando = $bd->prepare('SELECT * FROM livros WHERE id = :id');
$comando->execute([]);

$generos = $comando->fetchAll(PDO::FETCH_ASSOC);

$comandoLivro = $bd->prepare('SELECT * FROM livros WHERE id = :id');
$comandoLivro->execute([':id' => $_GET['id']]);
$livro = $comandoLivro->fetch(PDO::FETCH_ASSOC);
} else {
    $comando = $bd->prepare('UPDATE livros SET titulo = :titulo, id_genero = :genero WHERE id = :id'); 
    $comando->execute([':titulo' => $_POST['titulo'], ':genero' => $_POST['genero'], ':id' => $_POST['id']]);

    header('Location:/livros_list.php');
}
?>

<?php include('./includes/header.php') ?>

<h1>Remover Livro</h1>
<p>Tem certeza que deseja excluir </p>