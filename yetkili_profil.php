<?php
session_start();
if (!isset($_SESSION['yetkili_id'])) {
  header("Location: yetkiligiris.php");
  exit();
}
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profilimi Düzenle | MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    html,body{background-color:#f4f6f9;font-family:'League Spartan',sans-serif;margin:0;padding:0;}
    .sidebar{width:250px;background:linear-gradient(to bottom,#002147,#005B96);color:#fff;position:fixed;top:0;left:0;height:100vh;padding:20px;}
    .sidebar-header{text-align:center;margin-bottom:30px;}
    .sidebar-header img{width:100px;margin-bottom:15px;}
    .sidebar-header h2{font-family:'Poppins',sans-serif;font-weight:700;font-size:22px;}
    .sidebar-menu a{display:flex;align-items:center;gap:10px;color:white;text-decoration:none;margin-bottom:18px;padding:12px;border-radius:6px;font-size:17px;}
    .sidebar-menu a:hover,.sidebar-menu a.active{background-color:rgba(255,255,255,0.2);}
    .main-content{margin-left:250px;padding:30px;}
    .profile-card{max-width:700px;margin:auto;background:#fff;border-radius:12px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
    .profile-header{text-align:center;padding:30px 20px;border-bottom:1px solid #eee;}
    .profile-header img{width:120px;height:120px;border-radius:50%;object-fit:cover;border:3px solid #005B96;}
    .form-label{font-weight:600;color:#002147;}
    .btn-primary{background-color:#005B96;border:none;}
    .btn-primary:hover{background-color:#003a70;}
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="../images/mtü-logo.png" alt="MTÜ Logo">
      <h2>Yetkili Paneli</h2>
    </div>
    <div class="sidebar-menu">
      <a href="yetkili_anasayfa.php"><i class="bi bi-house-door-fill"></i> Ana Sayfa</a>
      <a href="yetkili_sinavyonetimi.php"><i class="bi bi-journal-text"></i> Sınav Yönetimi</a>
      <a href="yetkili_optik_yukleme.php"><i class="bi bi-upload"></i> Optik Yükleme</a>
      <a href="yetkili_sonuclar.php"><i class="bi bi-bar-chart-line"></i> Sonuçlar</a>
      <a href="yetkili_analizler.php"><i class="bi bi-graph-up"></i> Analizler</a>
      <a href="yetkili_kullanici_yonetimi.php"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
      <a href="yetkili_duyurular.php"><i class="bi bi-megaphone"></i> Duyurular</a>
      <a href="yetkili_yardim_destek.php"><i class="bi bi-question-circle"></i> Yardım & Destek</a>
    </div>
  </div>

  <div class="main-content">
    <div class="profile-card">
      <div class="profile-header">
        <img id="avatarPreview" src="../images/profil.png" alt="Profil Fotoğrafı">
        <h4 class="mt-3" id="yetkiliAdSoyad">Yetkili Adı</h4>
        <p class="text-muted small">Profil Bilgilerini Güncelle</p>
      </div>

      <form id="formProfil" enctype="multipart/form-data" class="p-4">
        <div id="alertBox" class="alert mt-2 d-none"></div>

        <div class="mb-3">
          <label class="form-label">Profil Fotoğrafı</label>
          <input class="form-control" type="file" name="fotograf" accept="image/*" onchange="previewImage(event)">
        </div>

        <div class="mb-3">
          <label class="form-label">Ad</label>
          <input class="form-control" type="text" name="ad" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Soyad</label>
          <input class="form-control" type="text" name="soyad" required>
        </div>

        <div class="mb-3">
          <label class="form-label">E-posta</label>
          <input class="form-control" type="email" name="eposta" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Ünvan</label>
          <input class="form-control" type="text" name="unvan">
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Kaydet</button>
        </div>
      </form>
    </div>
  </div>

  <script>
  async function loadProfile() {
    const res = await fetch('../backend/yetkili_profil_backend.php?action=get', {credentials:'include'});
    const data = await res.json();
    if (data.ok && data.item) {
      const i = data.item;
      document.querySelector('[name="ad"]').value = i.ad ?? '';
      document.querySelector('[name="soyad"]').value = i.soyad ?? '';
      document.querySelector('[name="eposta"]').value = i.eposta ?? '';
      document.querySelector('[name="unvan"]').value = i.unvan ?? '';
      if (i.fotograf) document.getElementById('avatarPreview').src = i.fotograf;
      document.getElementById('yetkiliAdSoyad').textContent = `${i.ad ?? ''} ${i.soyad ?? ''}`;
    }
  }

  document.getElementById('formProfil').addEventListener('submit', async e=>{
    e.preventDefault();
    const fd = new FormData(e.currentTarget);
    const res = await fetch('../backend/yetkili_profil_backend.php?action=update',{
      method:'POST', body:fd, credentials:'include'
    });
    const j = await res.json();
    const alertBox = document.getElementById('alertBox');
    alertBox.classList.remove('d-none','alert-success','alert-danger');
    if(j.ok){
      alertBox.classList.add('alert-success');
      alertBox.textContent = 'Bilgiler başarıyla güncellendi.';
      await loadProfile();
    } else {
      alertBox.classList.add('alert-danger');
      alertBox.textContent = j.error || 'Bir hata oluştu.';
    }
    setTimeout(()=>alertBox.classList.add('d-none'),2000);
  });

  function previewImage(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => document.getElementById('avatarPreview').src = ev.target.result;
    reader.readAsDataURL(file);
  }

  loadProfile();
  </script>
</body>
</html>
