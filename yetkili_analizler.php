<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yetkili Analizler - MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .card-custom { background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); margin-bottom:30px; }
    .footer { padding:20px; background:#f1f1f1; border-top:1px solid #ddd; font-size:15px; color:#333; text-align:center; }
    .footer img { width:30px; margin-right:10px; vertical-align:middle; }
    .muted { color:#6c757d; }
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
        <a href="yetkili_sinavyonetimi.php"><i class="bi bi-journal-text"></i> Sınav Yönetimi</a>
        <a href="yetkili_optik_yukleme.php"><i class="bi bi-upload"></i> Optik Yükleme</a>
        <a href="yetkili_sonuclar.php"><i class="bi bi-bar-chart-line"></i> Sonuçlar</a>
        <a href="yetkili_analizler.php" class="active"><i class="bi bi-graph-up"></i> Analizler</a>
        <a href="yetkili_kullanici_yonetimi.php"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
        <a href="yetkili_duyurular.php"><i class="bi bi-megaphone"></i> Duyurular</a>
        <a href="yetkili_yardim_destek.php"><i class="bi bi-question-circle"></i> Yardım & Destek</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
      <div class="main-content">
        <div class="user-info dropdown">
  <span id="userName">Yönetici Adı</span>
  <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
    <img id="userAvatar" src="../images/profil.png" alt="Profil Fotoğrafı" class="user-avatar">
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="yetkili_profil.php"><i class="bi bi-person-circle"></i> Profilimi Düzenle</a></li>
    <li><a class="dropdown-item text-danger" href="yetkili_cikis.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a></li>
  </ul>
</div>


        <div class="card-custom">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h4 class="m-0"><strong>Analizler</strong></h4>

            <!-- Filtreler -->
            <div class="d-flex gap-2">
              <select id="sinavSelect" class="form-select form-select-sm" style="min-width: 260px">
                <option value="">— Sınav Seç (boş: TOP 20 ders/sınav) —</option>
              </select>
              <button id="btnYenile" class="btn btn-sm btn-primary">Yenile</button>
            </div>
          </div>

          <p class="muted">Bu alanda sınav ve öğrenci istatistiklerine ilişkin analizler yer almaktadır.</p>

          <div class="row">
            <div class="col-md-6 mb-4">
              <h5 class="text-center">Sınav Başarı Dağılımı</h5>
              <div id="basariLoading" class="text-center muted mb-2" style="display:none;">Yükleniyor…</div>
              <canvas id="basariGrafik"></canvas>
            </div>
            <div class="col-md-6 mb-4">
              <h5 class="text-center">Derslere/Sınavlara Göre Katılım</h5>
              <div id="katilimLoading" class="text-center muted mb-2" style="display:none;">Yükleniyor…</div>
              <canvas id="katilimGrafik"></canvas>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <p><img src="../images/mtü-logo.png" alt="Logo" /> Malatya Turgut Özal Üniversitesi Dijital Dönüşüm Ofisi</p>
        <p>© 2025 Malatya Turgut Özal Üniversitesi. Tüm Hakları Saklıdır.</p>
      </footer>
    </div>
  </div>




  

  <script>
  let basariChart = null;
  let katilimChart = null;

  function destroyIfExists(chartRef) {
    if (chartRef && typeof chartRef.destroy === 'function') {
      chartRef.destroy();
    }
  }

  function showLoading(which, on) {
    const el = document.getElementById(which === 'basari' ? 'basariLoading' : 'katilimLoading');
    if (el) el.style.display = on ? 'block' : 'none';
  }

  /** Sınav listesi (dropdown) doldur */
  async function loadSinavlar() {
  try {
    const res = await fetch(`../backend/yetkili_analizler_backend.php?mode=sinav`, { credentials: 'include' });
    const js = await res.json();
    if (!js.ok) throw new Error(js.error || 'Sınav listesi alınamadı');

    const sel = document.getElementById('sinavSelect');
    for (let i = sel.options.length - 1; i >= 1; i--) sel.remove(i);

    (js.items || []).forEach(item => {
      const opt = document.createElement('option');
      const ders = (item.ders_adi || '').trim();
      const ad   = (item.ad || '').trim();
      let etiket = (ders || ad) ? `${ders}${ders && ad ? ' — ' : ''}${ad}` : `Sınav #${item.id}`;
      opt.value = item.id;
      opt.textContent = `${etiket} — ${item.tarih || '-'}`;
      sel.appendChild(opt);
    });

    // Otomatik seçim + grafiklerin yüklenmesi
    if ((js.items || []).length > 0) {
      sel.value = js.items[0].id;
      await refreshAll();
    }
  } catch (e) {
    console.error(e);
    alert('Sınav listesi alınırken hata oluştu.');
  }
}


  /** Başarı dağılımı */
 async function loadBasari(sinavId) {
  destroyIfExists(basariChart);
  showLoading('basari', true);

  const basariCol = document.getElementById('basariGrafik').closest('.col-md-6');
  try {
    if (!sinavId) {
      if (basariCol) basariCol.style.display = 'none';
      return;
    }
    if (basariCol) basariCol.style.display = '';

    const url = `../backend/yetkili_analizler_backend.php?mode=basari&sinav_id=${sinavId}`;
    const res = await fetch(url, { credentials: 'include' });
    const js = await res.json();
    if (!js.ok) throw new Error(js.error || 'Hata');

    const ctx = document.getElementById('basariGrafik');
    basariChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: js.labels,
        datasets: [{ data: js.data, backgroundColor: ['#28a745', '#ffc107', '#dc3545'] }]
      }
    });
  } catch (e) {
    console.error(e);
    alert('Başarı grafiği yüklenirken hata oluştu.');
  } finally {
    showLoading('basari', false);
  }
}


  /** Katılım (sinavId yoksa TOP 20 ders/sınav) */
  async function loadKatilim(sinavId) {
    destroyIfExists(katilimChart);
    showLoading('katilim', true);

    try {
      const base = `../backend/yetkili_analizler_backend.php?mode=katilim`;
      const url = sinavId ? `${base}&sinav_id=${sinavId}` : base;

      const res = await fetch(url);
      const js = await res.json();
      if (!js.ok) throw new Error(js.error || 'Hata');

      const ctx = document.getElementById('katilimGrafik');
      katilimChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: js.labels,
          datasets: [{
            label: 'Katılımcı Sayısı',
            data: js.data,
            backgroundColor: '#005B96'
          }]
        },
        options: {
          responsive: true,
          plugins: { legend: { display: false } },
          scales: { x: { ticks: { autoSkip: false, maxRotation: 60, minRotation: 0 } } }
        }
      });
    } catch (e) {
      console.error(e);
      alert('Katılım grafiği yüklenirken hata oluştu.');
    } finally {
      showLoading('katilim', false);
    }
  }

  /** Seçime göre grafikleri yenile */
  async function refreshAll() {
    const sel = document.getElementById('sinavSelect');
    const sinavId = sel.value ? Number(sel.value) : null;
    await Promise.all([
      loadBasari(sinavId),
      loadKatilim(sinavId) // yoksa TOP 20 döner
    ]);
  }

  /** Sayfa açılışı */
  document.addEventListener('DOMContentLoaded', async () => {
     await loadProfil();
    await loadSinavlar();
    await refreshAll(); // başlangıçta: başarı boş, katılım TOP 20

    document.getElementById('btnYenile').addEventListener('click', refreshAll);
    document.getElementById('sinavSelect').addEventListener('change', refreshAll);
  });


function ncb(url){
  const s = url.includes('?') ? '&' : '?';
  return `${url}${s}_=${Date.now()}`;
}

async function safeJson(url, opts = {}){
  const res = await fetch(url, { credentials: 'include', cache: 'no-store', ...opts });
  const txt = await res.text();
  if (!res.ok){
    console.error('HTTP hata', res.status, url, txt.slice(0,800));
    throw new Error('HTTP '+res.status);
  }
  try { 
    return JSON.parse(txt); 
  } catch {
    console.error('JSON parse hatası:\n', txt.slice(0,800));
    throw new Error('Geçersiz JSON');
  }
}

async function loadProfil(){
  try{
    const js = await safeJson(ncb('../backend/yetkili_profil_backend.php?action=get'));
    if(js && js.ok && js.item){
      const nameEl   = document.getElementById('userName');
      const avatarEl = document.getElementById('userAvatar');
      
      const adsoyad = [js.item.ad, js.item.soyad].filter(Boolean).join(' ') || 'Yönetici';
      if (nameEl)   nameEl.textContent = adsoyad;
      
      if (avatarEl)
        avatarEl.src = js.item.fotograf || '../images/profil.png';
    }
  }catch(e){
    console.warn('Profil yüklenemedi:', e);
  }
}


  </script>
</body>
</html>
