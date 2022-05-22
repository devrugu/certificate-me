<?php
    session_start();
    unset($_SESSION['ad_id']);
    
    header("Location:../../../admin/admin_giris.php?success=cikisBasarili");

?>