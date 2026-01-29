<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yetkili Şifre Değiştir | MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
   .input-group .form-control,
.input-group .btn {
  height: 45px;
  font-size: 16px;
  border-radius: 8px;
}

.toggle-password i {
  font-size: 1.2rem; /* Göz ikonunun boyutu */
  margin: 0;
  padding: 0;
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
      <h3>Şifre Değiştir</h3>
      <?php session_start(); ?>
<?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger" role="alert">
    <?= $_SESSION['error'] ?>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success" role="alert">
    <?= $_SESSION['success'] ?>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>
      <form action="../backend/yetkili_sifredegistir_backend.php" method="POST">
  <input type="email" name="eposta" class="form-control" placeholder="E-posta" required>
  <div class="input-group mb-3">
  <input type="password" name="mevcut_sifre" class="form-control" placeholder="Mevcut Şifre" id="mevcut_sifre" required>
  <button type="button" class="btn btn-outline-secondary toggle-password" data-target="mevcut_sifre">
    <i class="bi bi-eye"></i>
  </button>
</div>

<div class="input-group mb-3">
  <input type="password" name="yeni_sifre" class="form-control" placeholder="Yeni Şifre" id="yeni_sifre" required>
  <button type="button" class="btn btn-outline-secondary toggle-password" data-target="yeni_sifre">
    <i class="bi bi-eye"></i>
  </button>
</div>

<div class="input-group mb-3">
  <input type="password" name="yeni_sifre_tekrar" class="form-control" placeholder="Yeni Şifre (Tekrar)" id="yeni_sifre_tekrar" required>
  <button type="button" class="btn btn-outline-secondary toggle-password" data-target="yeni_sifre_tekrar">
    <i class="bi bi-eye"></i>
  </button>
</div>
  <button type="submit" class="btn btn-primary">Şifreyi Değiştir</button>
</form>
      <div class="back-link mt-3">
        <a href="yetkiligiris.php">&larr; Giriş Sayfasına Dön</a>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
<script>
  document.querySelectorAll(".toggle-password").forEach(button => {
    button.addEventListener("click", function () {
      const inputId = this.dataset.target;
      const input = document.getElementById(inputId);
      const icon = this.querySelector("i");
      const isPassword = input.type === "password";
      input.type = isPassword ? "text" : "password";
      icon.className = isPassword ? "bi bi-eye-slash" : "bi bi-eye";
    });
  });
</script>
</html>
