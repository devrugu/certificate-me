<?php
    require "header.php";
    include_once '../../includes/i_database_handler/dbh.inc.php';
    date_default_timezone_set('Europe/Istanbul');
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../../css/sertifikaresim.css?v=<?php echo time(); ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if (isset($_POST['sertifika_resmi_submit'])) {
        $e_id = $_POST['e_id'];
        $katilimci_id = $_SESSION['ka_id'];
        $sql = "SELECT * FROM sertifika WHERE sertifikayi_alan_kisi=".$katilimci_id." AND verilen_etkinlik=".$e_id;
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
       
            <img src="<?php echo $row['sertifika_resmi'] ?> "id="resim"> 
        <?php
        }
    }
    else {
        header('Location: sertifikalar.php');
    }
?>
</body>
</html>