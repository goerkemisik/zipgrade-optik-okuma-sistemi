<?php
// CSRF token üret (önerilir)
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yetkili Şifremi Unuttum | MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <style>
    body { margin:0; padding:0; font-family:'League Spartan',sans-serif; background:#f8f9fa url("https://enstitubasvuru.firat.edu.tr/panel/images/pattern2.png") repeat; min-height:100vh; display:flex; align-items:center; justify-content:center }
    .login-container { background:#fff; display:flex; width:90%; max-width:1000px; border-radius:12px; overflow:hidden; box-shadow:0 0 20px rgba(0,0,0,.3) }
    .left-panel { background:#002147; color:#fff; flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 20px }
    .left-panel img { width:140px; margin-bottom:20px }
    .left-panel h2 { font-weight:600; margin-top:10px; text-align:center }
    .right-panel { flex:1; padding:40px 30px; background:#f8f9fa }
    .right-panel h3 { font-weight:600; margin-bottom:16px }
    .form-control { margin-bottom:16px; border-radius:8px }
    .btn-primary { width:100%; background:#005B96; border:none; padding:10px; font-weight:600; border-radius:8px }
    .btn-primary:hover { background:#003f6b }
    .back-link { margin-top:12px }
    .back-link a { color:#005B96; font-weight:600; text-decoration:none }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="left-panel">
      <!-- Türkçe karakterli dosya adı sunucuda sorun çıkarıyorsa mtu-logo.png gibi ASCII bir isim kullan -->
      <img src="../images/mtÜ-logo.png" alt="MTÜ Logo">
      <h2>Optik Sınav Değerlendirme Sistemi</h2>
    </div>
    <div class="right-panel">
      <h3>Şifremi Unuttum</h3>
      <p>Kullanıcı adınızı <em>veya</em> e-posta adresinizi girin. Kayıtlıysa şifre sıfırlama bağlantısı e-posta adresinize gönderilir.</p>

      <form action="../backend/yetkili_sifremiunuttum_backend.php" method="POST" autocomplete="off" novalidate>
        <input
          type="text"
          name="kullanici"
          class="form-control"
          placeholder="Kullanıcı Adı veya E-posta"
          required
          inputmode="email"  
          autocapitalize="off"
          spellcheck="false"
        >
        <!-- CSRF -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit" class="btn btn-primary">Talep Gönder</button>
      </form>

      <div class="back-link">
        <a href="yetkiligiris.php">&larr; Giriş Sayfasına Dön</a>
      </div>
    </div>
  </div>
</body>
</html>
