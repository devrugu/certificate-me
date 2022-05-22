<?php
    session_start();
    unset($_SESSION['ka_id']);
    unset($_SESSION['ka_ad']);
    unset($_SESSION['ka_soyad']);
    unset($_SESSION['ka_telefon']);
    unset($_SESSION['ka_eposta']);
    unset($_SESSION['ka_universite']);
    unset($_SESSION['ka_fakulte']);
    unset($_SESSION['ka_bolum']);
    unset($_SESSION['ka_sinif']);
    unset($_SESSION['ka_kullanici_adi']);

    header("Location:../../../katilimci/katilimci_giris.php?success=cikisBasarili");

?>
