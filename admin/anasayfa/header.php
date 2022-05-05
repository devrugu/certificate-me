<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <header>
        <nav>
            <a href="http://localhost/certificate_me/admin/anasayfa/admin_anasayfa.php">
                <img src="http://localhost/certificate_me/images/tuu.png" alt="logo">
            </a>
            <ul>
                <li><a href="http://localhost/certificate_me/admin/anasayfa/admin_anasayfa.php">Ana Sayfa</a></li>
                <li><a href="http://localhost/certificate_me/admin/anasayfa/kurumlariYonet/kurumlariYonet.php">Kurumları Yönet</a></li>
            </ul>
            <div>
                <form action="http://localhost/certificate_me/includes/i_admin/i_anasayfa_admin/admin_cikis.inc.php" method="POST">
                    <button type="submit" name="admin_cikis_submit">Çıkış yap</button>
                </form>
            </div>
        </nav>
    </header>
</body>
</html>