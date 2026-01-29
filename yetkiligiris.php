<?php session_start(); /* mesaj göstermek için şart */ ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yetkili Girişi | MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body{margin:0;padding:0;font-family:'League Spartan',sans-serif;background:#f8f9fa url("https://enstitubasvuru.firat.edu.tr/panel/images/pattern2.png") repeat;min-height:100vh;display:flex;align-items:center;justify-content:center}
    .login-container{background:#fff;display:flex;width:90%;max-width:1000px;border-radius:12px;overflow:hidden;box-shadow:0 0 20px rgba(0,0,0,.3)}
    .left-panel{background:#002147;color:#fff;flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px 20px}
    .left-panel img{width:140px;margin-bottom:20px}
    .left-panel h2{font-weight:600;margin-top:10px;text-align:center}
    .right-panel{flex:1;padding:40px 30px;background:#f8f9fa}
    .right-panel h3{font-weight:600;margin-bottom:20px}
    .form-control{border-radius:8px}
    .btn-primary{width:100%;background:#005B96;border:none;padding:10px;font-weight:600;border-radius:8px}
    .btn-primary:hover{background:#003f6b}
    .action-links{text-align:right;font-size:14px}
    .action-links a{color:#005B96;text-decoration:none;font-weight:bold;margin:0 5px}
    .back-link{margin-top:10px}
    .back-link a{color:#005B96;font-weight:600;text-decoration:none}
  </style>
</head>
<body>
  <div class="login-container">
    <div class="left-panel">
      <img src="../images/mtü-logo.png" alt="MTÜ Logo">
      <h2>Optik Sınav Değerlendirme Sistemi</h2>
    </div>
    <div class="right-panel">
      <h3>Yetkili Girişi</h3>

      <!-- Oturum mesajlarını göster -->
      <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
      <?php endif; ?>
      <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
      <?php endif; ?>

      <form method="POST" action="../backend/yetkiligiris_backend.php" autocomplete="off">
        <input type="text" name="kullanici_adi" class="form-control mb-3"
               placeholder="Kullanıcı Adı" required autocomplete="username">

        <div class="input-group mb-3">
          <input type="password" name="sifre" id="sifre" class="form-control"
                 placeholder="Parola" required autocomplete="current-password">
          <button type="button" class="btn btn-outline-secondary" id="togglePassword">
            <i class="bi bi-eye"></i>
          </button>
        </div>

        <button type="submit" class="btn btn-primary">Giriş Yap</button>
      </form>

      <div class="action-links mt-3">
        <a href="yetkili_sifremiunuttum.php">Şifremi Unuttum</a> |
        <a href="yetkili_sifredegistir.php">Şifre Değiştir</a>
      </div>
      <div class="back-link mt-3">
        <a href="/zipgrade/index.php">&larr; Ana Sayfaya Dön</a>
      </div>
    </div>
  </div>

  <script>
    // Şifre göster/gizle
    const toggleBtn = document.getElementById("togglePassword");
    const sifreInput = document.getElementById("sifre");
    toggleBtn.addEventListener("click", function () {
      const isPassword = sifreInput.type === "password";
      sifreInput.type = isPassword ? "text" : "password";
      toggleBtn.innerHTML = isPassword ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
    });
  </script>
</body>
</html>
