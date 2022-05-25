<?php
    require "header.php";
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

    if (isset($_GET['success'])) {
        $successCheck = $_GET['success'];
        switch ($successCheck) {
            case 'kayitBasarili':
                echo '<p>Etkinliğe kaydınız başarı ile yapılmıştır.</p>';
                break;
        }
    }
    else if (isset($_GET['error'])) {
        $errorCheck = $_GET['error'];
        switch ($errorCheck) {
            case 'zamanAyni':
                echo '<p>Aynı zaman diliminde başka bir etkinliğiniz var!</p>';
                break;
            case 'sqlHatasi':
                echo '<p>Bir sorun oluştu tekrar deneyiniz!</p>';
                break;
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etkinlik İncele</title>
</head>
<body>
    <?php
        if (isset($_POST['e_id'])) {
            $_SESSION['e_id'] = $_POST['e_id'];
        }
        $e_id = $_SESSION['e_id'];
        $sql = "SELECT e_id, etkinlik_adi, e_aciklama, tarih, yer, afis_resmi, e_guncel_mi FROM etkinlik WHERE e_id=".$e_id.";";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <section>
                
                <div class="etkinlik_adi">
                    <h1>
                        <?php echo $row['etkinlik_adi']; ?>
                    </h1>
                </div>
                        

                <div class="afis_resmi">
                    <img src="<?php echo $row['afis_resmi']; ?>" alt="afiş_resmi" width="900" height="900">
                </div>
               

                <div class="etkinlik_detaylari">
                    <div class="etkinlik_aciklamasi">
                        <h3>Etkinlik Açıklaması</h3>
                        <p>
                            <?php echo $row['e_aciklama']; ?>
                        </p>    
                    </div>

                    <div class="etkinlik_yeri">
                        <h3>Etkinlik Yeri</h3>                            
                        <p>
                            <?php echo $row['yer']; ?>
                        </p>  
                    </div>

                    <div class="etkinlik_tarihi">
                        <p>
                            <h3>Etkinlik Tarihi</h3><?php echo $row['tarih']; ?>
                        </p> 
                    </div>

                    <div class="konusmacilar">  
                        <h3>Konuşmacılar</h3>
                            <?php
                                $sql3 = "SELECT konusmaci FROM e_konusmacilar WHERE e_id=".$row['e_id'].";";
                                $result3 = mysqli_query($conn, $sql3);
                                $konusmacilar = array();
                                $count = 0;
                                while($row3 = mysqli_fetch_assoc($result3)) {
                                    $konusmacilar[$count] = $row3['konusmaci'];
                                    $count++;
                                }
                                foreach ($konusmacilar as $konusmaci) {
                                ?>
                                    <table>
                                        <tr>
                                            <td>-<?php echo $konusmaci; ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                            ?>                        
                    </div>

                    <div class="etkinligi_duzenleyen_birimler">
                        <h3>Etkinliği Düzenleyen Birim(ler)</h3>
                        
                        <?php
                            $sql4 = "SELECT svb_id FROM svb_etkinlik WHERE e_id=".$e_id.";";
                            $result4 = mysqli_query($conn, $sql4);
                            
                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                
                                
                                $sql5 = "SELECT birim_adi, svb_aciklama, y_adi, y_soyadi, y_eposta FROM sertifika_veren_birim WHERE svb_id=".$row4['svb_id'].";";
                                $result5 = mysqli_query($conn, $sql5);
                                while ($row5 = mysqli_fetch_assoc($result5)) {
                        ?>      
                        <div class="birim">
                            <table border="10" align="left">
                                <tr>
                                    <td>
                                        <h3><?php echo $row5['birim_adi'] ?></h3>
                                        <textarea cols="50" rows="10" style="resize: none;" readonly><?php echo $row5['svb_aciklama'] ?></textarea>
                                            
                                        
                                        <h4>Yetkili Bilgileri:</h4>
                                        <p>
                                            <b>Ad-Soyad: </b><?php echo $row5['y_adi']." ".$row5['y_soyadi'] ?>   <br>                                                 
                                            <b>E_posta: </b><?php echo $row5['y_eposta'] ?>
                                        </p>
                                       
                                    </td>
                                </tr>       
                            </table>
                            
                        </div>
                                <?php
                                }
                                ?>
                               
                            <?php
                            }
                            ?>
                    </div>
                    
                </div>

                <div class="kayıt_ol">
                    <form action="../../includes/i_katilimci/i_anasayfa_katilimci/etkinlik_kayit.inc.php" method="post">
                        <input type="hidden" name="katilimci_id" value="<?php echo $_SESSION['ka_id']; ?>">
                        <input type="hidden" name="etkinlik_id" value="<?php echo $e_id; ?>">
                        <button type="submit" name="etkinlik_kayit_submit">Etkinliğe kayıt ol</button>
                    </form>
                </div>
            </section>
    <?php
        }
    ?>
    
</body>
</html>
