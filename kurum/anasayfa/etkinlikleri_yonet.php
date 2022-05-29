<?php
    require "header.php";
    //session_start();
    include_once '../../includes/i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');

    $sql = "SELECT e_id, tarih, e_guncel_mi FROM etkinlik;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $e_id = $row['e_id'];
        if (strtotime($row['tarih']) < time()) {
            $sql2 = "UPDATE etkinlik SET e_guncel_mi=0 WHERE e_id=".$e_id;
            mysqli_query($conn, $sql2);
        }
        else if (strtotime($row['tarih']) > time()) {
            $sql2 = "UPDATE etkinlik SET e_guncel_mi=1 WHERE e_id=".$e_id;
            mysqli_query($conn, $sql2);
        }
    }
?>
<html>
<link rel="stylesheet" href="etkinlikyönet.css?v=<?php echo time(); ?>">

    <main>
    <a href="etkinlik_ekle.php"id="etkinlik">Etkinlik Ekle</a>
    <section>
        
        

        <?php
            if (isset($_GET['success'])) {
                $successCheck = $_GET['success'];
                switch ($successCheck) {
                    case 'silmeBasarili':
                        echo '<p style="color: green;">Silme işlemi başarı ile gerçekleşti.</p>';
                        break;
                }
            }
            else if (isset($_GET['error'])) {
                $errorCheck = $_GET['error'];
                switch ($errorCheck) {
                    case 'silmeBasarisiz':
                        echo '<p style="color: red;">Silme işlemi yapılırken bir sorun oluştu!</p>';
                        break;
                }
            }

           
            $svb_id = $_SESSION['svb_id'];

            $sql = "SELECT e_id FROM svb_etkinlik WHERE svb_id=".$svb_id.";";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $etkinlik_id = $row['e_id'];
                $sql2 = "SELECT e_id, etkinlik_adi, e_aciklama, tarih, yer, afis_resmi, e_guncel_mi FROM etkinlik WHERE e_id=".$etkinlik_id.";";
                $result2 = mysqli_query($conn, $sql2);
                while ($row2 = mysqli_fetch_assoc($result2)) {

                    $sql3 = "SELECT konusmaci FROM e_konusmacilar WHERE e_id=".$etkinlik_id.";";
                    $result3 = mysqli_query($conn, $sql3);
                    $konusmacilar = array();
                    $count = 0;
                    while($row3 = mysqli_fetch_assoc($result3)) {
                        $konusmacilar[$count] = $row3['konusmaci'];
                        $count++;
                    }

                    $sql3 = "SELECT * FROM katilimci_etkinlik WHERE e_id=".$etkinlik_id.";";
                    $result3 = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result3) == 0) {
                        $katilimci_sayisi = "Kimse kayıt olmadı";
                    }
                    elseif (mysqli_num_rows($result3) > 0) {
                        $katilimci_sayisi = mysqli_num_rows($result3);
                    }

                    ?>
                    <table border="10" align="left">
                        <tr>
                            <td>
                                <div>
                                    <h2><?php echo $row2['etkinlik_adi']; ?></h2>
                                </div>
                                <div>
                                    <img src="<?php echo $row2['afis_resmi']; ?>" alt="afis_resmi" width="400" height="550">
                                
                                <p><?php echo $row2['e_aciklama']; ?></p>
                                <p><b>tarih: </b><?php echo $row2['tarih'] ?></p>
                                <p><b>Yer: </b><?php echo $row2['yer'] ?></p>
                                <p><b>Konuşmacılar: </b><?php echo implode("-", $konusmacilar); ?></p>
                                <p><b>katılımcı sayısı: </b><?php echo $katilimci_sayisi; ?></p>


                                <form action="etkinlik_duzenle.php" method="POST">
                                    <input type='hidden' name='etkinlik_id' value="<?php echo $etkinlik_id ?>">
                                    <input type='hidden' name='etkinlik_adi' value="<?php echo $row2['etkinlik_adi'] ?>">
                                    <input type='hidden' name='etkinlik_aciklama' value="<?php echo $row2['e_aciklama'] ?>">
                                    <input type='hidden' name='etkinlik_tarih' value="<?php echo $row2['tarih'] ?>">
                                    <input type='hidden' name='etkinlik_yer' value="<?php echo $row2['yer'] ?>">
                                    <input type='hidden' name='etkinlik_afis_resmi' value="<?php echo $row2['afis_resmi'] ?>">
                                    <input type='hidden' name='etkinlik_guncel_mi' value="<?php echo $row2['e_guncel_mi'] ?>"> 
                                    <input type='hidden' name='etkinlik_konusmacilar' value="<?php echo implode(",", $konusmacilar) ?>">
                                    <button type="submit" name="e_duzenle_submit">Düzenle</button>
                                </form>

                                <form action="etkinlik_sil.php" method="POST">
                                    <input type='hidden' name='etkinlik_id' value="<?php echo $etkinlik_id ?>">
                                    <button type="submit" name="e_sil_submit">Sil</button>
                                </form>
                                <?php
                                    if ($row2['e_guncel_mi'] == 1) {
                                    ?>
                                        <p style="color: green;">Etkinlik güncel</p>
                                    <?php  
                                    }
                                    else if ($row2['e_guncel_mi'] == 0) {
                                    ?>
                                        
                                        <p style="color: red;">Etkinlik güncel değil</p>
            
                                        <form action="sertifika_belirle.php" method="post">
                                            <input type="hidden" name="et_id" value="<?php echo $etkinlik_id ?>">
                                            <button type="submit" name="sertifika_belirle_submit">Sertifika ver</button>
                                        </form>
                                    <?php  
                                    }
                                ?>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <?php
                }
            }
        ?>
    </section>
    </main>

<?php
    //require "footer.php";
?>
</html>