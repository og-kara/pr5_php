<div class="catalog container">
    <h2>Каталог товаров</h2>

    <form method="post" class="search" name="search">
        <input type="text" name="name" placeholder="Поиск.." value="<?if(isset($_POST['search'])) echo $_POST['name']?>">
        <input type="submit" value="Поиск" class="btn" name="search">
    </form>

    <div class="category">
        <a href="?page=home">Все книги</a>
        <?

        $sql = "SELECT * FROM `categories`";
        $res_cat = $connect->query($sql);

        foreach ($res_cat as $cat) { ?>
            <a href="?page=home&cat=<?= $cat['id'] ?>"><?= $cat['name'] ?></a>
        <? } ?>
    </div>


    <div class="cards">
        <?php

        $sql = "SELECT * FROM `books`";

        $dopSql = "";

        if (isset($_POST['search'])) {
            $text = $_POST['name'];
            $dopSql .= "WHERE `name` LIKE '%" . $text . "%'";
        }

        if (isset($_GET['cat'])) {
            $cat_id = $_GET['cat'];
            $dopSql .= (empty($dopSql) ? "WHERE " : "AND ") . "cat_id = $cat_id";
        }

        $sql = "SELECT * FROM `books` $dopSql";
        $result = $connect->query($sql);
        $res = $result->rowCount();

        if ($res == 0) { ?>
            <p>По вашему запросу ничего не найдено! <a href="?page=home">Вернуться ко всем книгам</a></p>
        <? }

        foreach ($result as $book) {
            $id = $book['id'] ?>
            <div class="card">
                <img src="<?= $book['img'] ?>" alt="img">
                <p>Название: <?= $book['name'] ?></p>
                <p>Автор: <?= $book['autor'] ?></p>
                <?
                $id_cat = $book['cat_id'];
                $sql = "SELECT * FROM `categories` WHERE `id`='$id_cat'";
                $res_cat = $connect->query($sql)->fetch(2);
                ?>
                <p>Категория: <?= $res_cat['name'] ?></p>
            </div>
        <? }
        ?>

    </div>
</div>