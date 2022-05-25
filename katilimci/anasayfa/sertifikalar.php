<?php
    require "header.php";
    include_once '../../includes/i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if (isset($_SESSION['ka_id'])) {
        $katilimci_id = $_SESSION['ka_id'];
        $sql = "SELECT * FROM sertifika WHERE sertifikayi_alan_kisi=".$katilimci_id;
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <table border="5" align="left">
                <tr>
                    <td>
                        <b>Sertifika adı: </b><?php echo $row['sertifika_adi'] ?><br>
                        <b>Sertifika metni: </b><textarea cols="50" rows="10" style="resize: none;" readonly><?php echo $row['sertifika_metni'] ?></textarea><br>
                        <b>Verildiği Etkinlik:</b><?php $sql2="SELECT * FROM etkinlik WHERE e_id=".$row['verilen_etkinlik'];
                                                        $result2 = mysqli_query($conn, $sql2);
                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                            echo $row2['etkinlik_adi'];
                                                        } ?><br>
                        <b>Sertifika kodu: </b><?php echo $row['sertifika_kodu']; ?><br>
                        <form action="sertifika_resmi.php" method="post">
                            <input type="hidden" name="e_id" value="<?php echo $row['verilen_etkinlik']; ?>">
                            <button type="submit" name="sertifika_resmi_submit">Sertifikayı Görüntüle</button>
                        </form>
                    </td>
                </tr>
            </table>
        <?php
        }
    }
    else {
        header('Location: katilimci_anasayfa.php');
    }
?>
    
    
</body>
</html>