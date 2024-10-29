<?

require 'incl/connect.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="container">
        <a href="?page=home">Главная</a>
        <a href="?page=add">Добавить товар</a>
    </header>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page == 'home') {
            include('pages/home.php');
        } elseif ($page == 'add') {
            include('pages/add.php');
        } else {
            include('pages/home.php');
        }
    } else {
        include('pages/home.php');
    }
    ?>

</body>

</html>