<?php
    require "header.php";
?>

    <main>
        <?php
            if (isset($_SESSION['svb_id'])) {
                echo '<p>Giriş yapıldı</p>';
            }
        ?>
    </main>

<?php
    require "footer.php";
?>