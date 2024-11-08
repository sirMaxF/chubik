<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../app/include/head.php'); ?>
<?php include('../app/controllers/users.php') ?>

<body>
    <main class="single admin">
        <!-- <div class="single__return">← Вернуться назад</div> -->

        <div class="single__flex admin__flex">
            <div class="admin__title">Вход в админ-панель</div>

            <form action="" method="post">
                <input type="hidden" name="admin" id="" value="true">
                <p><input type="text" name="text" placeholder="Введите имя" minlength="3" maxlength="20" required></p>
                <p><input type="password" name="password" placeholder="Введите пароль" minlength="3" maxlength="20" required></p>
                <p><input type="submit" placeholder="" value="Войти"></p>
            </form>
        </div>
    </main>
    <script src="<?= BASE_URL ?>assets/js/app.min.js"></script>
</body>

</html>