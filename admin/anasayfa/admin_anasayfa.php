<?php
    require "header.php";
?>
 <link href="../../css/adminana.css" rel="stylesheet" type="text/css"/>
    <main>
        <?php
            if (isset($_SESSION['ad_id'])) {
               
                echo '<div class="x">';
                echo '<img src=" " id="image">';
                echo  '</div>';
            }
        ?>
        <script type="text/javascript">
            let image=document.getElementById('image');
            let images=['../../images/style_images/xd.jpg'];
            image.src=images[0];
            image.style.width='100%';
            image.style.height='150%';
        </script> 

    </main>

<?php
    require "footer.php";
?>