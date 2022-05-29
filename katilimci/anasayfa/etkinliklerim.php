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
?>
<html>
<link rel="stylesheet" href="etkinliklerim.css?v=<?php echo time(); ?>">
<main>
    <h1>Etkinliklerim</h1><br>
    <p>Kayıt olduğunuz etkinlikler burada listelenir.</p>
    <?php
        if (isset($_SESSION['ka_id'])) {
            $katilimci_id = $_SESSION['ka_id'];
            $sql = "SELECT * FROM katilimci_etkinlik WHERE k_id=".$katilimci_id;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $etkinlik_id = $row['e_id'];
                $sql2 = "SELECT * FROM etkinlik WHERE e_id=".$etkinlik_id;
                $result2 = mysqli_query($conn, $sql2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                        <table border="10" align="left">
                            <tr>
                                <td>
                                    <div>
                                        <h2>
                                            <?php echo $row2['etkinlik_adi']; ?>
                                        </h2>                                
                                    </div>
                                    <div>
                                        <img src="<?php echo $row2['afis_resmi']; ?>" alt="afiş_resmi" width="400" height="550">


                                            <p><?php echo $row2['e_aciklama']; ?></p>

                                        <form action="etkinlik_incele.php" method="post">
                                            <input type="hidden" name="e_id" value="<?php echo $row2['e_id'] ?>">
                                            <button type="submit" name="etkinlik_incele_submit">Etkinliği incele</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        </table>    
                        
                    <?php
                }
            }
        }
        else {
            header('Location: katilimci_anasayfa.php');
            die();
        }
    ?>


</main>

<?php
    //require "footer.php";
?>
</html>