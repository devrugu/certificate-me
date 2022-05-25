<?php
    include_once '../../i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');

    if (isset($_POST['sertifika_ver_submit'])) {
        $e_id = $_POST['etkin_id']; //verilen etkinlik
        $k_id = $_POST['kat_id'];   //sertifikayi alan kisi
        $x0 = $_POST['x0']-8;
        $y0 = $_POST['y0']-8;
        $x1 = $_POST['x1']-8;
        $y1 = $_POST['y1']-8;
        $sertifika_sablonu = $_POST['sertifika_sablonu'];
        

        $sql = "SELECT sertifika_adi, sertifika_metni, sertifika_sablonu FROM sertifika_bilgileri WHERE e_id=".$e_id;
        $result = mysqli_query($conn, $sql);
        if ($result == FALSE) {
            header('Location: ../../../kurum/anasayfa/sertifika_ver.php');
            exit();
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $sertifika_adi = $row['sertifika_adi']; //sertifika adı
            $sertifika_metni = $row['sertifika_metni']; //sertifika metni
            $sertifika_sablonu_path = $row['sertifika_sablonu']; //sertifika şablonu dosya yolu
        }

        $sql = "SELECT svb_id FROM svb_etkinlik WHERE e_id=".$e_id;
        $result = mysqli_query($conn, $sql);
        if ($result == FALSE) {
            header('Location: ../../../kurum/anasayfa/sertifika_ver.php');
            exit();
        }
        $kurumlar_array = array();
        $tmp = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $kurumlar_array[$tmp] = $row['svb_id'];
            $tmp++;
        }
        $kurumlar_string = implode(",", $kurumlar_array); //sertifikayi veren birim(ler)
        echo $kurumlar_string;

        $sql = "SELECT ad, soyad FROM katilimci WHERE k_id=".$k_id;
        $result = mysqli_query($conn, $sql);
        if ($result == FALSE) {
            header('Location: ../../../kurum/anasayfa/sertifika_ver.php');
            exit();
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $katilimci_ad = $row['ad'];
            $katilimci_soyad = $row['soyad'];    
        }

        $sertifika_kodu = uniqid($e_id); //sertifika kodu
        
        if (exif_imagetype($sertifika_sablonu) == 2) {
            $resim = imagecreatefromjpeg($sertifika_sablonu);
        }
        elseif (exif_imagetype($sertifika_sablonu) == 3) {
            $resim = imagecreatefrompng($sertifika_sablonu);
        }
        $renk = imagecolorallocate($resim, 0, 0, 0);
        $yazi = $katilimci_ad."   ".$katilimci_soyad;
        $font_size = 30;
        $x = $x0;
        $y = $y0 + (($y1-$y0)/2);
        imagettftext(
            $resim, 
            $font_size, 
            0, 
            $x, 
            $y, 
            $renk,
            "../../../fonts/Alata-Regular.ttf", 
            $yazi
        );
        imagejpeg($resim, "../../../images/sertifika_images/".$sertifika_kodu.".jpeg"); //sertifika resmi oluşturuldu

        $sertifika_resmi = "http://localhost/certificate_me/images/sertifika_images/".$sertifika_kodu.".jpeg";

        $sql = 'INSERT INTO sertifika (sertifika_kodu, sertifika_adi, sertifika_metni, sertifikayi_veren_birim, sertifikayi_alan_kisi, verilen_etkinlik, sertifika_resmi) 
                VALUES ("'.$sertifika_kodu.'", "'.$sertifika_adi.'", "'.$sertifika_metni.'", "'.$kurumlar_string.'", "'.$k_id.'", "'.$e_id.'", "'.$sertifika_resmi.'")';

        $result = mysqli_query($conn, $sql);
        if ($result == FALSE) {
            header('Location: ../../../kurum/anasayfa/sertifika_ver.php');
            exit();
        }
        elseif ($result == TRUE) {
            header('Location: ../../../kurum/anasayfa/sertifika_ver.php?success=sertifikaVerildi');
            exit();
        }
    }
    else {
        header('Location: ../../../kurum/anasayfa/sertifika_ver.php');
        exit();
    }
?>