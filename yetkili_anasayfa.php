<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yetkili Anasayfa | MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    * { box-sizing: border-box; }
    html, body { height: 100%; margin: 0; font-family: 'League Spartan', sans-serif; background-color: #f4f6f9; }
    .wrapper { display: flex; min-height: 100vh; }
    .sidebar { width: 270px; background: linear-gradient(to bottom, #002147, #005B96); color: white; padding: 20px; display: flex; flex-direction: column; }
    .sidebar-header { display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 30px; }
    .sidebar-header img { width: 100px; margin-bottom: 10px; }
    .sidebar-header h2 { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; margin: 0; }
    .sidebar-menu a { display: flex; align-items: center; gap: 10px; color: white; text-decoration: none; margin-bottom: 18px; padding: 12px; border-radius: 6px; font-size: 16px; }
    .sidebar-menu a:hover, .sidebar-menu a.active { background-color: rgba(255, 255, 255, 0.2); }
    .content-wrapper { flex: 1; display: flex; flex-direction: column; }
    .main-content { flex: 1; padding: 30px; }
    .user-info { display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #002147; margin-bottom: 20px; font-size: 18px; }
    .user-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #005B96; }
    .card-custom { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); margin-bottom: 30px; }
    .footer { padding: 20px; background-color: #f1f1f1; border-top: 1px solid #ddd; font-size: 15px; color: #333; }
    .stat-card { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 3px 6px rgba(0,0,0,0.1); text-align: center; }
    .stat-card h3 { font-weight: 700; margin: 0; }
    .stat-card p { color: #666; }
  </style>
</head>
<body>

  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <img src="../images/mtü-logo.png" alt="ZipGrade Logo" />
        <h2>Yetkili Paneli</h2>
      </div>
      <div class="sidebar-menu">
        <a href="yetkili_anasayfa.php" class="active"><i class="bi bi-house-door-fill"></i> Ana Sayfa</a>
        <a href="yetkili_sinavyonetimi.php"><i class="bi bi-journal-text"></i> Sınav Yönetimi</a>
        <a href="yetkili_optik_yukleme.php"><i class="bi bi-upload"></i> Optik Yükleme</a>
        <a href="yetkili_sonuclar.php"><i class="bi bi-bar-chart-line"></i> Sonuçlar</a>
        <a href="yetkili_analizler.php"><i class="bi bi-graph-up"></i> Analizler</a>
        <a href="yetkili_kullanici_yonetimi.php"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
        <a href="yetkili_duyurular.php"><i class="bi bi-megaphone"></i> Duyurular</a>
        <a href="yetkili_yardim_destek.php"><i class="bi bi-question-circle"></i> Yardım & Destek</a>
      </div>
    </div>

    <!-- Main Content & Footer -->
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

        <!-- Hızlı İşlem Butonları (MODAL TETİKLEYİCİ) -->
        <div class="mb-4 d-flex gap-3">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalYeniSinav">
            <i class="bi bi-plus-circle"></i> Yeni Sınav
          </button>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalOptikYukle">
            <i class="bi bi-upload"></i> Optik Yükle
          </button>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalSonuclar">
            <i class="bi bi-bar-chart-line"></i> Sonuçlar
          </button>
        </div>

        <!-- İstatistik Kartları -->
        <div class="row mb-4">
          <div class="col-md-3"><div class="stat-card"><h3>12</h3><p>Toplam Sınav</p></div></div>
          <div class="col-md-3"><div class="stat-card"><h3>356</h3><p>Yüklenen Optikler</p></div></div>
          <div class="col-md-3"><div class="stat-card"><h3>850</h3><p>Öğrenci Sayısı</p></div></div>
          <div class="col-md-3"><div class="stat-card"><h3>%72</h3><p>Ortalama Başarı</p></div></div>
        </div>

        <!-- Son Eklenen Sınavlar -->
        <div class="card">
          <div class="card-header"><strong>Son Yüklenen Sınavlar</strong></div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Sınav Adı</th>
                  <th>Tarih</th>
                  <th>Katılımcı</th>
                  <th>Ortalama</th>
                </tr>
              </thead>
              <tbody>
                <tr><td>1</td><td>Matematik Vize</td><td>25.07.2025</td><td>120</td><td>%68</td></tr>
                <tr><td>2</td><td>Fizik Final</td><td>18.07.2025</td><td>95</td><td>%75</td></tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- Footer -->
      <footer class="footer">
        <p style="display: flex; align-items: center; justify-content: center;">
          <img src="../images/mtü-logo.png" alt="ZipGrade" style="width: 30px; height: auto; margin-right: 10px;" />
          Malatya Turgut Özal Üniversitesi Dijital Dönüşüm Ofisi
        </p>
        <p style="text-align: center; font-size: 14px; color: #666;">
          © 2025 Malatya Turgut Özal Üniversitesi. Tüm Hakları Saklıdır.
        </p>
      </footer>
    </div>
  </div>

  <!-- === MODALS === -->

  <!-- Yeni Sınav Modal -->
  <div class="modal fade" id="modalYeniSinav" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Yeni Sınav Oluştur</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="formYeniSinav">
            <div class="row g-3">
              <div class="col-md-5">
                <label class="form-label">Sınav Adı</label>
                <input name="ad" type="text" class="form-control" placeholder="Sınav adı giriniz" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Ders Adı</label>
                <input name="ders_adi" type="text" class="form-control" placeholder="Ders adı giriniz" required>
              </div>
              <div class="col-md-3">
                <label class="form-label">Tarih</label>
                <input name="tarih" type="date" class="form-control" required>
              </div>
              <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Vazgeç</button>
                <button type="submit" class="btn btn-primary">Kaydet</button>
              </div>
            </div>
          </form>
          <div id="yeniSinavAlert" class="alert alert-success mt-3 d-none">Sınav oluşturuldu.</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Optik Yükle Modal -->
  <!-- Optik Yükle Modal -->
<div class="modal fade" id="modalOptikYukle" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Optik Yükle</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formOptikYukle" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md-5">
              <label class="form-label">Dosya Seç</label>
              <input name="dosya" type="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">Sınav</label>
              <select name="sinav_id" class="form-select" required>
                <!-- JS ile doldurulacak: "Sınav Adı — Ders Adı" -->
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Öğrenci</label>
              <select name="ogrenci_id" class="form-select" required>
                <!-- JS ile doldurulacak -->
              </select>
            </div>

            <div class="col-12 d-flex justify-content-end gap-2 mt-2">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Vazgeç</button>
              <button type="submit" class="btn btn-success">Yükle</button>
            </div>
          </div>
        </form>
        <div id="optikYukleAlert" class="alert alert-success mt-3 d-none">Dosya yüklendi.</div>
      </div>
    </div>
  </div>
</div>


  <!-- Sonuçlar Modal -->
  <div class="modal fade" id="modalSonuclar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Sonuçlar (Son Sınavlar Özeti)</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sınav Adı</th>
                  <th>Ders Adı</th>
                  <th>Tarih</th>
                  <th>Katılımcı</th>
                  <th>Ortalama (%)</th>
                </tr>
              </thead>
              <tbody id="tblSonuclarBody">
                <tr><td colspan="6" class="text-muted">Yükleniyor…</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
(async () => {
  // Global state
  window.__dashboardData = { son_sinavlar: [], tum_sinavlar: [], ogrenciler: [] };

  const fmtDate = (iso) => {
    const dt = new Date(iso);
    return isNaN(dt.getTime())
      ? iso
      : `${String(dt.getDate()).padStart(2,'0')}.${String(dt.getMonth()+1).padStart(2,'0')}.${dt.getFullYear()}`;
  };

  async function loadDashboard() {
    const res = await fetch('../backend/yetkili_anasayfa_backend.php', { credentials: 'include' });
    const payload = await res.json();
    if (!payload.ok) throw new Error(payload.error || 'Bilinmeyen hata');
    const d = payload.data || {};
    window.__dashboardData = d;



// YENİ (doğru)
const userSpan = document.querySelector('.user-info span');
if (userSpan) userSpan.textContent = (d.kullanici?.ad ?? 'Yönetici');

    const avatarImg = document.querySelector('.user-avatar');
    if (avatarImg && d.kullanici?.avatar) avatarImg.src = d.kullanici.avatar;

    // İstatistik kartları
    const statCards = document.querySelectorAll('.stat-card h3');
    if (statCards.length >= 4) {
      statCards[0].textContent = d.istatistik?.toplam_sinav ?? 0;
      statCards[1].textContent = d.istatistik?.yuklenen_optikler ?? 0;
      statCards[2].textContent = d.istatistik?.ogrenci_sayisi ?? 0;
      const avg = d.istatistik?.ortalama_basarim;
      statCards[3].textContent = (avg !== null && avg !== undefined) ? `%${Math.round(avg)}` : '%—';
    }

    // “Son Yüklenen Sınavlar” kartı
    const tbody = document.querySelector('.card table tbody');
    if (tbody) {
      const list = Array.isArray(d.son_sinavlar) ? d.son_sinavlar : [];
      tbody.innerHTML = '';
      list.forEach((s, i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${i+1}</td>
          <td>${s.ad ?? '-'}</td>
          <td>${fmtDate(s.tarih)}</td>
          <td>${s.katilimci ?? 0}</td>
          <td>${s.ortalama !== null && s.ortalama !== undefined ? '%'+Math.round(s.ortalama) : '%—'}</td>
        `;
        tbody.appendChild(tr);
      });
    }

    // Optik Yükle -> Sınav select ("Sınav Adı — Ders Adı")
    const selSinav = document.querySelector('#modalOptikYukle select[name="sinav_id"]');
    if (selSinav) {
      const listForSelect = (Array.isArray(d.tum_sinavlar) && d.tum_sinavlar.length)
        ? d.tum_sinavlar
        : (d.son_sinavlar ?? []);
      selSinav.innerHTML = '<option value="">Seçiniz</option>';
      listForSelect.forEach(s => {
        const ders = s.ders ?? s.ders_adi ?? '';
        const opt = document.createElement('option');
        opt.value = s.id;
        opt.textContent = ders ? `${s.ad} — ${ders}` : s.ad;
        selSinav.appendChild(opt);
      });
    }
  }

  function fillOgrenciSelectFromState() {
    const d = window.__dashboardData || {};
    const sel = document.querySelector('#modalOptikYukle select[name="ogrenci_id"]');
    if (!sel) return;

    const list = Array.isArray(d.ogrenciler) ? d.ogrenciler : [];
    sel.innerHTML = '<option value="">Seçiniz</option>';

    if (!list.length) {
      // Öğrenci yoksa bilgi notu
      const opt = document.createElement('option');
      opt.value = '';
      opt.textContent = '(Öğrenci bulunamadı)';
      sel.appendChild(opt);
      return;
    }

    list.forEach(o => {
      const opt = document.createElement('option');
      opt.value = o.id;
      const no = o.no ? ` — ${o.no}` : '';
      opt.textContent = `${o.ad} ${o.soyad}${no}`;
      sel.appendChild(opt);
    });
  }

  // İlk yükleme
  try { await loadDashboard(); } catch (err) { console.error(err); }

  // Sonuçlar modalı
  document.getElementById('modalSonuclar')?.addEventListener('show.bs.modal', () => {
    const d = window.__dashboardData || {};
    const box = document.getElementById('tblSonuclarBody');
    box.innerHTML = '';
    const list = d.son_sinavlar ?? [];
    if (!list.length) {
      box.innerHTML = '<tr><td colspan="6" class="text-muted">Kayıt bulunamadı.</td></tr>';
      return;
    }
    list.forEach((s, i) => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${i+1}</td>
        <td>${s.ad ?? '-'}</td>
        <td>${s.ders ?? s.ders_adi ?? '-'}</td>
        <td>${fmtDate(s.tarih)}</td>
        <td>${s.katilimci ?? 0}</td>
        <td>${s.ortalama !== null && s.ortalama !== undefined ? Math.round(s.ortalama) : '—'}</td>
      `;
      box.appendChild(tr);
    });
  });

  // Optik Yükle modalı açıldığında öğrencileri state'ten doldur
  document.getElementById('modalOptikYukle')?.addEventListener('show.bs.modal', fillOgrenciSelectFromState);

  // Yeni Sınav submit
  document.getElementById('formYeniSinav')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.currentTarget;
    const fd = new FormData(form);
    try {
      const res = await fetch('../backend/sinav_olustur.php', {
        method: 'POST', body: fd, credentials: 'include'
      });
      const j = await res.json();
      if (!j.ok) throw new Error(j.error || 'Kayıt başarısız');

      document.getElementById('yeniSinavAlert')?.classList.remove('d-none');
      setTimeout(() => {
        document.getElementById('yeniSinavAlert')?.classList.add('d-none');
        const m = bootstrap.Modal.getInstance(document.getElementById('modalYeniSinav'));
        m && m.hide();
        form.reset();
      }, 900);

      await loadDashboard(); // listeleri güncelle
    } catch (err) {
      alert('Hata: ' + (err.message || err));
    }
  });

  // Optik Yükle submit (öğrenci zorunlu)
  document.getElementById('formOptikYukle')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const form = e.currentTarget;
    const fd = new FormData(form);

    if (!fd.get('sinav_id'))   return alert('Lütfen bir sınav seçin.');
    if (!fd.get('ogrenci_id')) return alert('Lütfen bir öğrenci seçin.');

    try {
      const res = await fetch('../backend/optik_yukle.php', {
        method: 'POST', body: fd, credentials: 'include'
      });
      const j = await res.json();
      if (!j.ok) throw new Error(j.error || 'Yükleme başarısız');

      document.getElementById('optikYukleAlert')?.classList.remove('d-none');
      setTimeout(() => {
        document.getElementById('optikYukleAlert')?.classList.add('d-none');
        const m = bootstrap.Modal.getInstance(document.getElementById('modalOptikYukle'));
        m && m.hide();
        form.reset();
      }, 900);
    } catch (err) {
      alert('Hata: ' + (err.message || err));
    }
  });
})();
</script>



</body>
</html>
