<?php
    require "header.php";
?>

    <main>
        <?php
            if (isset($_SESSION['ad_id'])) {
                echo '<p>Giriş yapıldı</p>';
            }
        ?>
        

    </main>

<?php
    require "footer.php";
?>