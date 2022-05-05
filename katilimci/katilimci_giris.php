<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <title>Katılımcı giriş</title>
</head>
<body>
    <a href="../index.php">Geri</a>
    <div>
    <h1>Giriş Yap (Katılımcı)</h1>
        <?php
            if (isset($_GET['success'])) {
                if ($_GET['success'] == 'kayitBasarili') {
                    echo '<p>Kaydınız başarılı bir şekilde gerçekleşti. Lütfen giriş yapınız.</p>';
                }
                elseif ($_GET['success'] == 'cikisBasarili') {
                    echo '<p>Çıkış işlemi başarılı bir şekilde gerçekleşti.</p>';
                }
            }

            //Uyarı mesajları
            if (isset($_GET['error'])) {
                $errorCheck = $_GET['error'];

                switch ($errorCheck) {
                    case 'bos':
                        echo '<p>Tüm alanları doldurunuz!</p>';
                        break;
                    case 'yanlisSifre':
                        echo '<p>Yanlış şifre girdiniz!</p>';
                        break;
                    case 'sqlHatasi':
                        echo '<p>Veritabanında bir sorun oluştu!</p>';
                        break;
                    case 'kullaniciYok':
                        echo '<p>Böyle bir kullanıcı bulunmamaktadır!</p>';
                        break;
                }
            }
        ?>


        <form action="../includes/i_katilimci/katilimci_giris.inc.php" method="POST">
            <label for="k_eposta_kullaniciAdi">E-posta/Kullanıcı adı:</label>
            <input type="text" name="k_eposta_kullaniciAdi" id="k_eposta_kullaniciAdi">

            <label for="k_sifre">Şifre:</label>
            <input type="password" name="k_sifre" id="k_sifre">

            <button type="submit" name="k_giris_submit">giriş yap</button>
        </form>
        <a href="katilimci_kayit.php">Kayıt ol</a>
    </div>
</body>
</html>