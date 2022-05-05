<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <header>
        <nav>
            <a href="http://localhost/certificate_me/katilimci/anasayfa/katilimci_anasayfa.php">
                <img src="http://localhost/certificate_me/images/tuu.png" alt="logo">
            </a>
            <ul>
                <li><a href="http://localhost/certificate_me/katilimci/anasayfa/katilimci_anasayfa.php">Ana Sayfa</a></li>
                <li><a href="">etkinlikler</a></li>
                <li><a href="">sertifikalarım</a></li>
            </ul>
            <div>
                <form action="http://localhost/certificate_me/includes/i_katilimci/i_anasayfa_katilimci/katilimci_cikis.inc.php" method="POST">
                    <button type="submit" name="katilimci_cikis_submit">Çıkış yap</button>
                </form>
            </div>
        </nav>
    </header>
</body>
</html>