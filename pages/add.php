<?php
if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $author = $_POST['author'];
    $img = 'assets/img/' . time() . $_FILES['img']['name'];
    $cat_id = $_POST['category'];

    $flag = 'true';

    $errors = [
        '<p class="error">Заполните поле ввода</p>'
    ];
}
?>

<form method="POST" class="addform" name="add" enctype="multipart/form-data">
    <h3>Добавление товара</h3>
    <input type="text" name="name" placeholder="Название книги">
    <?php
    if (isset($_POST['add'])) {
        if (empty($name)) {
            $flag = 'false';
            echo $errors[0];
        }
    } ?>
    <input type="text" name="author" placeholder="Автор книги">
    <?php
    if (isset($_POST['add'])) {
        if (empty($author)) {
            $flag = 'false';
            echo $errors[0];
        }
    } ?>
    <input type="file" name="img">

    <? if (isset($_POST['add'])) {
        if ($_FILES['img']['name'] == null) {
            $flag = 'false';
            echo $errors[0];
        }
    } ?>

    <select name="category">
        <?php

        $sql = "SELECT * FROM `categories`";
        $res = $connect->query($sql);

        foreach ($res as $cat) { ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <? }
        ?>
    </select>

    <input type="submit" class="btn_add" value="Добавить" name="add">
</form>

<? if (isset($_POST['add'])) {
    if ($flag != 'false') {
        move_uploaded_file($_FILES['img']['tmp_name'], $img);
        $sql = "INSERT INTO `books`(`name`, `autor`, `img`, `cat_id`) VALUES ('$name','$author', '$img', '$cat_id')";
        $res = $connect->query($sql);
        // var_dump($sql);
    }
} ?>