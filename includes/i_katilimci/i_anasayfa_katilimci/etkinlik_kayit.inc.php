<?php
    include_once '../../i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');

    if (isset($_POST['etkinlik_kayit_submit'])) {
        $katilimci_id = $_POST['katilimci_id'];
        $etkinlik_id = $_POST['etkinlik_id'];

        //aynı zaman aralığında başka etkinlik var mı?
        $sql = "SELECT tarih FROM etkinlik WHERE e_id=".$etkinlik_id;
        $result = mysqli_query($conn, $sql);
        if ($result == FALSE) {
            header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php');
            exit();
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $tarih = $row['tarih'];
        }

        $sql = "SELECT e_id FROM katilimci_etkinlik WHERE k_id=".$katilimci_id;
        $result = mysqli_query($conn, $sql);
        if ($result == FALSE) {
            header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php');
            exit();
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $sql2 = "SELECT tarih FROM etkinlik WHERE e_id=".$row['e_id'];
            $result2 = mysqli_query($conn, $sql2);
            if ($result2 == FALSE) {
                header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php');
                exit();
            }
            while ($row2 = mysqli_fetch_assoc($result2)) {
                if ((strtotime($row2['tarih']) < strtotime($tarih)) && (strtotime($tarih) < strtotime($row2['tarih']."+3 hour"))) {
                    header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php?error=zamanAyni');
                    exit();
                }
                if ((strtotime($row2['tarih']) < strtotime($tarih."+3 hour")) && (strtotime($tarih."+3 hour") < strtotime($row2['tarih']."+3 hour"))) {
                    header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php?error=zamanAyni');
                    exit();
                }
                if (strtotime($row2['tarih']) == strtotime($tarih)) {
                    header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php?error=zamanAyni');
                    exit();
                }
            }            
        }

        $sql = "INSERT INTO katilimci_etkinlik (k_id, e_id) VALUES (".$katilimci_id.", ".$etkinlik_id.")";
        $result = mysqli_query($conn, $sql);
        if ($result == FALSE) {
            header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php?error=sqlHatasi');
            exit();
        }

        header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php?success=kayitBasarili');
        


    }
    else {
        header('Location: ../../../katilimci/anasayfa/etkinlik_incele.php');
        exit();
    }



    
?>
