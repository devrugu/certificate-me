<?php
    require "header.php";
?>

    <main>
        <?php
            if (isset($_SESSION['ka_id'])) {
                echo '<p>Giriş yapıldı</p>';
            }
        ?>
        

    </main>

<?php
    require "footer.php";
?>