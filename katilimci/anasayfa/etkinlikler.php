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

<main>
    <section>
        <div>
            <div class="baslik">
                <h1>
                    Etkinlikler
                </h1>
                 
                <p>
                    Bu sayfada alanında başarılı çok fazla şirketin etkinliklerini inceleyebilirsiniz.
                </p>
 
            </div>
        </div>

        <?php
            $sql = "SELECT e_id, etkinlik_adi, e_aciklama, tarih, yer, afis_resmi, e_guncel_mi FROM etkinlik WHERE e_guncel_mi=1;";
            $result = mysqli_query($conn, $sql);
        ?>
  
        <div class="etkinlikler">
            
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <table border="10" align="left">
                            <tr>
                                <td>
                                    <div>
                                        <h2>
                                            <?php echo $row['etkinlik_adi']; ?>
                                        </h2>                                
                                    </div>
                                    <div>
                                        <img src="<?php echo $row['afis_resmi']; ?>" alt="afiş_resmi">


                                            <textarea cols="50" rows="10" style="resize: none;" readonly><?php echo $row['e_aciklama']; ?></textarea>

                                        <form action="etkinlik_incele.php" method="post">
                                            <input type="hidden" name="e_id" value="<?php echo $row['e_id'] ?>">
                                            <button type="submit" name="etkinlik_incele_submit">Etkinliği incele</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        </table>    
                        
                    <?php
                    }
                ?>
           
        </div>
    </section>
</main>

<?php
    //require "footer.php";
?>