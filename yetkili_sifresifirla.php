<?php
// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "mtuosds");
$baglanti->set_charset("utf8");

$mesaj = "";
$renk = "";
$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'] ?? '';
    $sifre1 = $_POST['sifre1'] ?? '';
    $sifre2 = $_POST['sifre2'] ?? '';

    if ($sifre1 === $sifre2 && strlen($sifre1) >= 6) {
        $sorgu = $baglanti->prepare("SELECT kullanici_id, expire_date FROM sifre_sifirlama WHERE token = ? AND kullanici_tipi = 'yetkili'");
        $sorgu->bind_param("s", $token);
        $sorgu->execute();
        $sonuc = $sorgu->get_result();

        if ($sonuc->num_rows === 1) {
            $veri = $sonuc->fetch_assoc();
            $kullanici_id = $veri['kullanici_id'];
            $expire = $veri['expire_date'];

            if (strtotime($expire) >= time()) {
                $hashed = password_hash($sifre1, PASSWORD_DEFAULT);
                $guncelle = $baglanti->prepare("UPDATE yetkililer SET sifre = ? WHERE id = ?");
                $guncelle->bind_param("si", $hashed, $kullanici_id);
                $guncelle->execute();

                $sil = $baglanti->prepare("DELETE FROM sifre_sifirlama WHERE token = ?");
                $sil->bind_param("s", $token);
                $sil->execute();

                $mesaj = "Şifreniz başarıyla güncellendi.";
                $renk = "success";
            } else {
                $mesaj = "Bu şifre sıfırlama bağlantısının süresi dolmuş.";
                $renk = "danger";
            }
        } else {
            $mesaj = "Geçersiz veya kullanılmış bağlantı.";
            $renk = "danger";
        }
    } else {
        $mesaj = "Şifreler aynı olmalı ve en az 6 karakter içermelidir.";
        $renk = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yetkili Yeni Şifre Belirle | MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'League Spartan', sans-serif;
      background-color: #f8f9fa;
      background-image: url("https://enstitubasvuru.firat.edu.tr/panel/images/pattern2.png");
      background-size: contain;
      background-repeat: repeat;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background-color: #fff;
      display: flex;
      width: 90%;
      max-width: 1000px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    .left-panel {
      background-color: #002147;
      color: white;
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }

    .left-panel img {
      width: 140px;
      margin-bottom: 20px;
    }

    .left-panel h2 {
      font-weight: 600;
      margin-top: 10px;
      text-align: center;
    }

    .right-panel {
      flex: 1;
      padding: 40px 30px;
      background-color: #f8f9fa;
    }

    .right-panel h3 {
      font-weight: 600;
      margin-bottom: 20px;
    }

    .form-control {
      margin-bottom: 20px;
      border-radius: 8px;
    }

    .btn-primary {
      width: 100%;
      background-color: #005B96;
      border: none;
      padding: 10px;
      font-weight: 600;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background-color: #003f6b;
    }

    .alert {
      border-radius: 8px;
    }

    .back-link {
      text-align: left;
      margin-top: 10px;
    }

    .back-link a {
      color: #005B96;
      font-weight: 600;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="left-panel">
      <img src="../images/mtü-logo.png" alt="MTÜ Logo">
      <h2>Optik Sınav Değerlendirme Sistemi</h2>
    </div>
    <div class="right-panel">
      <h3>Yeni Şifre Belirleme</h3>

      <?php if (!empty($mesaj)): ?>
  <div class="alert alert-<?php echo $renk; ?>">
    <?php echo $mesaj; ?>
  </div>
  <?php if ($renk === "success"): ?>
    <a href="yetkiligiris.php" class="btn btn-outline-primary">Giriş Yap</a>
  <?php endif; ?>
<?php endif; ?>

<?php if ($renk !== "success"): ?>
  <form method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="password" name="sifre1" class="form-control" placeholder="Yeni Şifre" required>
    <input type="password" name="sifre2" class="form-control" placeholder="Yeni Şifre (Tekrar)" required>
    <button type="submit" class="btn btn-primary">Şifreyi Güncelle</button>
  </form>

  <div class="back-link mt-3">
    <a href="yetkiligiris.php">&larr; Giriş Sayfasına Dön</a>
  </div>
<?php endif; ?>

    </div>
  </div>
</body>
</html>
