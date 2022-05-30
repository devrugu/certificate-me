<?php
    session_start();
    include_once '../includes/i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');
?><link rel="stylesheet" href="../css/dogrula.css?v=<?php echo time(); ?>">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifika doğrula</title>
</head>
<body>
    <?php
        if (isset($_POST['sertifika_dogrula_submit'])) {
            $sertifika_kodu = $_POST['sertifika_kodu'];
            $sql = 'SELECT * FROM sertifika WHERE sertifika_kodu="'.$sertifika_kodu.'"';
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                header('Location: sertifika_dogrula.php?error=sertifikaKoduYanlis');
                exit;
            }
            elseif (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $sertifika_resmi = $row['sertifika_resmi'];
                }
            ?>  
                <a href="sertifika_dogrula.php"id="gerit">Geri</a>
                <h4 style="color: green;">Sertifika Doğrulandı</h4>
                <img src="<?php echo $sertifika_resmi; ?>">
                <a href="../includes/i_sertifika_dogrula/sertifika_dogrula.inc.php?path=<?php echo $sertifika_resmi; ?>"id="indir">Sertifikayı indir</a>
            <?php
            }
        }
        else {
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'sertifikaKoduYanlis') {
                    echo '<p>Lütfen geçerli bir sertifika kodu giriniz. <br> Eğer katılımcıysanız sertifika kodunuzu kendi hesabınıza giriş yaparak öğrenebilirsiniz.</p>';
                }
            }
        ?>
            <a href="../index.php">Geri</a>
            <form action="sertifika_dogrula.php" method="post">
                <label for="sertifika_kodu">Sertifika Kodunu giriniz:</label>
                <input type="text" name="sertifika_kodu" id="sertifika_kodu">
                <button type="submit" name="sertifika_dogrula_submit">Doğrula</button>
            </form>
        <?php
        }
    ?>
    
    
</body>
</html>