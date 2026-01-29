<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yetkili Sınav Yönetimi - MTUOSDS</title>

  <!-- Font & Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <style>
    * { box-sizing: border-box; }
    body, html { height:100%; margin:0; font-family:'League Spartan', sans-serif; background:#f4f6f9; }
    .wrapper { display:flex; min-height:100vh; }
    .sidebar { width: 270px; background:linear-gradient(to bottom, #002147, #005B96); color:#fff; padding:20px; flex-shrink:0; }
    .sidebar-header { text-align:center; margin-bottom:30px; }
    .sidebar-header img { width:100px; margin-bottom:10px; }
    .sidebar-header h2 { font-family:'Poppins', sans-serif; font-size:20px; font-weight:700; margin:0; }
    .sidebar-menu a { display:flex; align-items:center; gap:10px; color:#fff; text-decoration:none; margin-bottom:18px; padding:12px; border-radius:6px; font-size:16px; }
    .sidebar-menu a:hover, .sidebar-menu a.active { background:rgba(255,255,255,0.2); }
    .content-wrapper { flex:1; display:flex; flex-direction:column; }
    .main-content { flex:1; padding:30px; }
    .user-info { display:flex; justify-content:space-between; align-items:center; font-weight:600; color:#002147; margin-bottom:20px; font-size:18px; }
    .user-avatar { width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #005B96; }
    .card-custom { background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); }
    .footer { padding:20px; background:#f1f1f1; border-top:1px solid #ddd; font-size:15px; color:#333; text-align:center; }
    .footer img { width:30px; margin-right:10px; vertical-align:middle; }
  </style>
</head>
<body>
<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="../images/mtü-logo.png" alt="MTÜ Logo" />
      <h2>Yetkili Paneli</h2>
    </div>
    <div class="sidebar-menu">
      <a href="yetkili_anasayfa.php"><i class="bi bi-house-door-fill"></i> Ana Sayfa</a>
      <a href="yetkili_sinavyonetimi.php" class="active"><i class="bi bi-journal-text"></i> Sınav Yönetimi</a>
      <a href="yetkili_optik_yukleme.php"><i class="bi bi-upload"></i> Optik Yükleme</a>
      <a href="yetkili_sonuclar.php"><i class="bi bi-bar-chart-line"></i> Sonuçlar</a>
      <a href="yetkili_analizler.php"><i class="bi bi-graph-up"></i> Analizler</a>
      <a href="yetkili_kullanici_yonetimi.php"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
      <a href="yetkili_duyurular.php"><i class="bi bi-megaphone"></i> Duyurular</a>
      <a href="yetkili_yardim_destek.php"><i class="bi bi-question-circle"></i> Yardım & Destek</a>
    </div>
  </div>

  <!-- İçerik -->
  <div class="content-wrapper">
    <div class="main-content">
      <div class="user-info dropdown">
        <span>Yönetici Adı</span>
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUserMenu" data-bs-toggle="dropdown">
          <img src="../images/profil.png" alt="Profil Fotoğrafı" class="user-avatar">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUserMenu">
          <li><a class="dropdown-item" href="yetkili_profil.php"><i class="bi bi-person-circle"></i> Profilimi Düzenle</a></li>
          <li><a class="dropdown-item text-danger" href="yetkili_cikis.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a></li>
        </ul>
      </div>

      <!-- Yeni Sınav -->
      <div class="card-custom mb-4">
        <h4 class="mb-4"><strong>Yeni Sınav Ekle</strong></h4>
        <form id="formYeniSinav">
          <div class="row g-3">
            <div class="col-md-4">
              <input type="text" name="ad" class="form-control" placeholder="Sınav Adı" required>
            </div>
            <div class="col-md-4">
              <input type="text" name="ders_adi" class="form-control" placeholder="Ders Adı" required>
            </div>
            <div class="col-md-3">
              <input type="date" name="tarih" class="form-control" required>
            </div>
            <div class="col-md-1 d-grid">
              <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i></button>
            </div>
          </div>
        </form>
        <div id="yeniSinavAlert" class="alert alert-success mt-3 d-none">Sınav oluşturuldu.</div>
      </div>

      <!-- Liste -->
      <div class="card-custom">
        <h4 class="mb-4"><strong>Sınav Listesi</strong></h4>
        <div class="table-responsive">
          <table id="sinavTablo" class="table table-bordered table-hover align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Sınav Adı</th>
                <th>Ders Adı</th>
                <th>Tarih</th>
                <th>Katılımcı Sayısı</th>
                <th>Güncelle</th>
                <th>Sil</th>
              </tr>
            </thead>
            <tbody><!-- JS dolduracak --></tbody>
          </table>
        </div>
      </div>
    </div>

    <footer class="footer">
      <p><img src="../images/mtü-logo.png" alt="Logo" /> Malatya Turgut Özal Üniversitesi Dijital Dönüşüm Ofisi</p>
      <p>© 2025 Malatya Turgut Özal Üniversitesi. Tüm Hakları Saklıdır.</p>
    </footer>
  </div>
</div>

<!-- Güncelleme Modal -->
<div class="modal fade" id="guncelleModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="formGuncelle" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sınav Bilgilerini Güncelle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="guncelle_id" name="id">
        <div class="mb-3">
          <label class="form-label">Sınav Adı</label>
          <input type="text" class="form-control" id="guncelle_ad" name="ad" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Ders Adı</label>
          <input type="text" class="form-control" id="guncelle_ders" name="ders_adi" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Tarih</label>
          <input type="date" class="form-control" id="guncelle_tarih" name="tarih" required>
        </div>
        <!-- Katılımcı sayısı hesaplanan alandır; düzenlenmez. -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</div>

<script>
  let dt = null;

  const fmtDateTR = (iso) => {
    const d = new Date(iso);
    if (isNaN(d.getTime())) return iso;
    return String(d.getDate()).padStart(2,'0') + '.' +
           String(d.getMonth()+1).padStart(2,'0') + '.' +
           d.getFullYear();
  };

  function setUserHeader(kullanici) {
    const nameEl = document.querySelector('.user-info span');
    const imgEl  = document.querySelector('.user-avatar');

    const ad  = kullanici?.ad ?? 'Yönetici';
    const src = kullanici?.avatar ?? '../images/profil.png';

    if (nameEl) nameEl.textContent = ad;
    if (imgEl) {
      imgEl.src = src;
      imgEl.onerror = () => { imgEl.src = '../images/profil.png'; };
    }
  }

  async function loadSinavlar() {
    const url = `../backend/yetkili_sinavyonetimi_backend.php?t=${Date.now()}`;
    const res = await fetch(url, { credentials:'include', cache:'no-store' });
    const j = await res.json();
    if (!j.ok) throw new Error(j.error || 'Liste alınamadı');

    // Kullanıcı adı & avatarı dinamik ata
    setUserHeader(j.data?.kullanici);

    // DataTables'ı ilk defa kur
    if (!dt) {
      dt = $('#sinavTablo').DataTable({
        language: {
          search: "Ara:",
          lengthMenu: "Göster _MENU_",
          info: "_TOTAL_ kayıttan _START_ - _END_",
          paginate: { next: "İleri", previous: "Geri" }
        }
      });
    }

    // Satırları güncelle
    dt.clear();

    (j.data?.sinavlar || []).forEach(row => {
      const guncelleBtn = `
        <button class="btn btn-warning btn-sm btnGuncelle"
                data-id="${row.id}"
                data-ad="${row.ad || ''}"
                data-ders="${row.ders_adi || ''}"
                data-tarih="${row.tarih}">
          Güncelle
        </button>`;
      const silBtn = `<button class="btn btn-danger btn-sm btnSil" data-id="${row.id}">Sil</button>`;

      dt.row.add([
        row.id,
        row.ad || '-',
        row.ders_adi || '-',
        fmtDateTR(row.tarih),
        row.katilimci ?? 0,
        guncelleBtn,
        silBtn
      ]);
    });

    dt.draw(false);
  }

  // İlk yükleme
  (async () => {
    try {
      await loadSinavlar();
    } catch (e) {
      alert('Hata: ' + (e.message || e));
    }
  })();

  // Yeni sınav ekle
  document.getElementById('formYeniSinav')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const fd = new FormData(e.currentTarget);
    fd.append('action', 'create');

    try {
      const res = await fetch('../backend/yetkili_sinavyonetimi_backend.php', {
        method: 'POST', body: fd, credentials: 'include'
      });
      const j = await res.json();
      if (!j.ok) throw new Error(j.error || 'Kayıt başarısız');

      document.getElementById('yeniSinavAlert')?.classList.remove('d-none');
      setTimeout(() => {
        document.getElementById('yeniSinavAlert')?.classList.add('d-none');
        e.currentTarget.reset();
      }, 900);

      await loadSinavlar();
    } catch (err) {
      alert('Hata: ' + (err.message || err));
    }
  });

  // Güncelle aç
  document.addEventListener('click', (ev) => {
    const btn = ev.target.closest('.btnGuncelle');
    if (!btn) return;
    document.getElementById('guncelle_id').value = btn.dataset.id;
    document.getElementById('guncelle_ad').value = btn.dataset.ad || '';
    document.getElementById('guncelle_ders').value = btn.dataset.ders || '';
    document.getElementById('guncelle_tarih').value = btn.dataset.tarih || '';
    new bootstrap.Modal(document.getElementById('guncelleModal')).show();
  });

  // Güncelle kaydet
  document.getElementById('formGuncelle')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const fd = new FormData(e.currentTarget);
    fd.append('action', 'update');

    try {
      const res = await fetch('../backend/yetkili_sinavyonetimi_backend.php', {
        method: 'POST', body: fd, credentials: 'include'
      });
      const j = await res.json();
      if (!j.ok) throw new Error(j.error || 'Güncelleme başarısız');

      bootstrap.Modal.getInstance(document.getElementById('guncelleModal'))?.hide();
      await loadSinavlar();
    } catch (err) {
      alert('Hata: ' + (err.message || err));
    }
  });

  // Sil
  document.addEventListener('click', async (ev) => {
    const btn = ev.target.closest('.btnSil');
    if (!btn) return;
    if (!confirm('Bu sınavı silmek istediğinize emin misiniz?')) return;

    const fd = new FormData();
    fd.append('action', 'delete');
    fd.append('id', btn.dataset.id);

    try {
      const res = await fetch('../backend/yetkili_sinavyonetimi_backend.php', {
        method: 'POST', body: fd, credentials: 'include'
      });
      const j = await res.json();
      if (!j.ok) throw new Error(j.error || 'Silme başarısız');

      await loadSinavlar();
    } catch (err) {
      alert('Hata: ' + (err.message || err));
    }
  });
</script>

</body>
</html>
