<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurum</title>
</head>
<body>
    <header>
        <nav>
            <a href="http://localhost/certificate_me/kurum/anasayfa/kurum_anasayfa.php">
                <img src="http://localhost/certificate_me/images/tuu.png" alt="logo">
            </a>
            <ul>
                <li><a href="http://localhost/certificate_me/kurum/anasayfa/kurum_anasayfa.php">Ana Sayfa</a></li>
                <li><a href="http://localhost/certificate_me/kurum/anasayfa/etkinlikleri_yonet/etkinlikleri_yonet.php">Etkinlikleri Yönet</a></li>
            </ul>
            <div>
                <form action="http://localhost/certificate_me/includes/i_kurum/i_anasayfa_kurum/kurum_cikis.inc.php" method="POST">
                    <button type="submit" name="kurum_cikis_submit">Çıkış yap</button>
                </form>
            </div>
        </nav>
    </header>
</body>
</html>