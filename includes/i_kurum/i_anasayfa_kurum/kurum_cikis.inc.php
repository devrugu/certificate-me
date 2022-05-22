<?php
    session_start();
    unset($_SESSION['svb_id']);
    unset($_SESSION['birim_adi']);
    unset($_SESSION['svb_aciklama']);
    unset($_SESSION['adres']);
    unset($_SESSION['y_adi']);
    unset($_SESSION['y_soyadi']);
    unset($_SESSION['y_eposta']);
    unset($_SESSION['svb_kullanici_adi']);

    header("Location:../../../kurum/kurum_giris.php?success=cikisBasarili");

?>
