<?php
    require "header.php";
    include_once '../../includes/i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');
?>

<main>
    <?php
        if (isset($_POST['sertifika_ver_submit']) || isset($_SESSION['etk_id'])) {
            echo '<h1>Etkinliğe kayıt olan katılımcılar</h1>';

            if (isset($_POST['x0']) && isset($_POST['y0']) && isset($_POST['x1']) && isset($_POST['y1'])) {
                $_SESSION['x0'] = $_POST['x0'];
                $_SESSION['y0'] = $_POST['y0'];
                $_SESSION['x1'] = $_POST['x1'];
                $_SESSION['y1'] = $_POST['y1'];
            }
            $x0 = $_SESSION['x0'];
            $y0 = $_SESSION['y0'];
            $x1 = $_SESSION['x1'];
            $y1 = $_SESSION['y1'];

            if (isset($_POST['sertifika_sablonu'])) {
                $_SESSION['sertifika_sablonu'] = $_POST['sertifika_sablonu'];
            }
            $sertifika_sablonu = $_SESSION['sertifika_sablonu'];

            
            if (isset($_POST['et_id'])) {
                $_SESSION['etk_id'] = $_POST['et_id'];
            }
            $et_id = $_SESSION['etk_id'];

            $sql = "SELECT k_id FROM katilimci_etkinlik WHERE e_id=".$et_id;
            $result = mysqli_query($conn, $sql);
            if ($result == FALSE) {
                header('Location: etkinlikleri_yonet.php');
            }
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $sql2 = "SELECT ad, soyad, telefon, eposta, universite, fakulte, bolum, sinif FROM katilimci WHERE k_id=".$row['k_id'];
                $result2 = mysqli_query($conn, $sql2);
                if ($result2 == FALSE) {
                    header('Location: etkinlikleri_yonet.php');
                }
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                        <table border="5" align="left">
                            <tr>
                                <td>
                                    <p>
                                        <b>Ad-Soyad:</b><?php echo $row2['ad']." ".$row2['soyad'] ?><br>
                                        <b>Telefon:</b><?php echo $row2['telefon'] ?><br>
                                        <b>E_posta:</b><?php echo $row2['eposta'] ?><br>
                                        <b>Üniversite:</b><?php $sql3="SELECT name FROM yok_universiteler WHERE id=".$row2['universite'];
                                                                $result3 = mysqli_query($conn, $sql3);
                                                                while ($row3 = mysqli_fetch_assoc($result3)) { echo $row3['name']; }?><br>
                                        <b>Fakülte:</b><?php $sql3="SELECT name FROM yok_fakulteler WHERE id=".$row2['fakulte'];
                                                                $result3 = mysqli_query($conn, $sql3);
                                                                while ($row3 = mysqli_fetch_assoc($result3)) { echo $row3['name']; }?><br>
                                        <b>Bölüm:</b><?php $sql3="SELECT name FROM yok_bolumler WHERE id=".$row2['bolum'];
                                                                $result3 = mysqli_query($conn, $sql3);
                                                                while ($row3 = mysqli_fetch_assoc($result3)) { echo $row3['name']; }?><br>
                                        <b>Sınıf:</b><?php $sql3="SELECT name FROM sinif WHERE id=".$row2['sinif'];
                                                                $result3 = mysqli_query($conn, $sql3);
                                                                while ($row3 = mysqli_fetch_assoc($result3)) { echo $row3['name']; }?><br>
                                    </p>
                                    <?php
                                        $sql3 = "SELECT * FROM sertifika WHERE sertifikayi_alan_kisi=".$row['k_id']." AND verilen_etkinlik=".$et_id;
                                        $result3 = mysqli_query($conn, $sql3);
                                        if (mysqli_num_rows($result3) == 0) {
                                        ?>
                                            <p style="color: red;">sertifika verilmedi</p>
                                            <form action="../../includes/i_kurum/i_anasayfa_kurum/sertifika_ver.inc.php" method="POST">
                                                <input type="hidden" name="etkin_id" value="<?php echo $et_id; ?>">
                                                <input type="hidden" name="kat_id" value="<?php echo $row['k_id']; ?>">
                                                <input type="hidden" name="x0" value="<?php echo $x0; ?>">
                                                <input type="hidden" name="y0" value="<?php echo $y0; ?>">
                                                <input type="hidden" name="x1" value="<?php echo $x1; ?>">
                                                <input type="hidden" name="y1" value="<?php echo $y1; ?>">
                                                <input type="hidden" name="sertifika_sablonu" value="<?php echo $sertifika_sablonu; ?>">
                                                <button type="submit" name="sertifika_ver_submit">Sertifika ver</button>
                                            </form>
                                        <?php
                                        }
                                        else {
                                            ?>  
                                            <p style="color: green;">Sertifika verildi</p>

                                            <?php
                                        }
                                    ?>
                                    
                                </td>
                            </tr>
                        </table>

                    <?php
                }
            }



        }
        else {
            header('Location: etkinlikleri_yonet.php');
        }
    ?>
</main>

<?php
    //require "footer.php";
?>