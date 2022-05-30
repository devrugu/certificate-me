<?php
    //require "header.php";
    session_start();
    include_once '../../includes/i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');
?><link rel="stylesheet" href="../../css/sertifika_belirle.css?v=<?php echo time(); ?>">


<main>
    <?php
        if (isset($_POST['sertifika_belirle_submit'])) {
            $e_id = $_POST['et_id'];
            $sql = "SELECT sertifika_sablonu FROM sertifika_bilgileri WHERE e_id=".$e_id;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_Assoc($result)) {
                $sertifika_sablonu = $row['sertifika_sablonu'];
            }
         
            $original_info = getimagesize($sertifika_sablonu);
            $original_w = $original_info[0];
            $original_h = $original_info[1];

            if (exif_imagetype($sertifika_sablonu) == 2) {
                $original_img = imagecreatefromjpeg($sertifika_sablonu);
            }
            elseif (exif_imagetype($sertifika_sablonu) == 3) {
                $original_img = imagecreatefrompng($sertifika_sablonu);
            }

            $max_resolution = 1000;
            $ratio = $max_resolution / $original_w;
            $thumb_w = $max_resolution;
            $thumb_h = $original_h * $ratio;
            if ($thumb_h > $thumb_w) {
                $max_resolution = 500;
                $ratio = $max_resolution / $original_h;
                $thumb_h = $max_resolution;
                $thumb_w = $original_w * $ratio;
            }
            $thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
            imagecopyresampled($thumb_img, $original_img,
                               0, 0,
                               0, 0,
                               $thumb_w, $thumb_h,
                               $original_w, $original_h);
            imagejpeg($thumb_img, "../../images/dump_images/deneme.jpg");
            imagedestroy($thumb_img);
            imagedestroy($original_img);
            

            ?>
                
                <div id="image" class="image" style='background-image: url("http://localhost/certificate_me/images/dump_images/deneme.jpg"); width: <?php echo $thumb_w; ?>px; height: <?php echo $thumb_h; ?>px;'></div>
                <div id="rect"></div>
                <div id="bounds"></div>

                <h1>Sertifika Belirleme İşlemi</h1><br>
                <p>Sertifika Şablonunda katılımcı isminin nereye yazılacağını kutucuk içine alarak belirleyiniz.</p>
                <form action="sertifika_ver.php" method="post">
                    <input type="hidden" name="x0" id="x0" value="">
                    <input type="hidden" name="y0" id="y0" value="">
                    <input type="hidden" name="x1" id="x1" value="">
                    <input type="hidden" name="y1" id="y1" value="">
                    <input type="hidden" name="sertifika_sablonu" value="http://localhost/certificate_me/images/dump_images/deneme.jpg">
                    <input type="hidden" name="et_id" value="<?php echo $e_id; ?>">
                    <button type="submit" name="sertifika_ver_submit">Devam et</button>
                </form>
            <?php

            
        }
        else {
            header('Location: etkinlikleri_yonet.php');
        }
        
    ?>
    <script src="../../js/sertifika_belirle.js" ></script>
</main>

<?php
    //require "footer.php";
?>








