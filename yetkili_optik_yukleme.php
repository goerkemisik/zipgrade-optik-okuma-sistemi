<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yetkili Optik Yükleme - MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    * { box-sizing: border-box; }
    html, body { height:100%; margin:0; font-family:'League Spartan', sans-serif; background:#f4f6f9; }
    .wrapper { display:flex; min-height:100vh; }
    .sidebar { width:270px; background:linear-gradient(to bottom, #002147, #005B96); color:#fff; padding:20px; flex-shrink:0; }
    .sidebar-header { text-align:center; margin-bottom:30px; }
    .sidebar-header img { width:100px; margin-bottom:10px; }
    .sidebar-header h2 { font-family:'Poppins', sans-serif; font-size:20px; font-weight:700; margin:0; }
    .sidebar-menu a { display:flex; align-items:center; gap:10px; color:#fff; text-decoration:none; margin-bottom:18px; padding:12px; border-radius:6px; font-size:16px; }
    .sidebar-menu a:hover, .sidebar-menu a.active { background:rgba(255,255,255,0.2); }
    .content-wrapper { flex:1; display:flex; flex-direction:column; }
    .main-content { flex:1; padding:30px; }
    .user-info { display:flex; justify-content:space-between; align-items:center; font-weight:600; color:#002147; margin-bottom:20px; font-size:18px; }
    .user-avatar { width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #005B96; }
    .card-custom { background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); margin-bottom:20px; }
    .footer { padding:20px; background:#f1f1f1; border-top:1px solid #ddd; font-size:15px; color:#333; text-align:center; }
    .footer img { width:30px; margin-right:10px; vertical-align:middle; }
    .table thead { background:#002147; color:#fff; }
    .table td, .table th { font-size:16px; vertical-align:middle; padding:12px; }
  </style>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="../images/mtü-logo.png" alt="MTÜ Logo" />
      <h2>Yetkili Paneli</h2>
    </div>
    <div class="sidebar-menu">
      <a href="yetkili_anasayfa.php"><i class="bi bi-house-door-fill"></i> Ana Sayfa</a>
      <a href="yetkili_sinavyonetimi.php"><i class="bi bi-journal-text"></i> Sınav Yönetimi</a>
      <a href="yetkili_optik_yukleme.php" class="active"><i class="bi bi-upload"></i> Optik Yükleme</a>
      <a href="yetkili_sonuclar.php"><i class="bi bi-bar-chart-line"></i> Sonuçlar</a>
      <a href="yetkili_analizler.php"><i class="bi bi-graph-up"></i> Analizler</a>
      <a href="yetkili_kullanici_yonetimi.php"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
      <a href="yetkili_duyurular.php"><i class="bi bi-megaphone"></i> Duyurular</a>
      <a href="yetkili_yardim_destek.php"><i class="bi bi-question-circle"></i> Yardım & Destek</a>
    </div>
  </div>

  <div class="content-wrapper">
    <div class="main-content">
      <div class="user-info dropdown">
        <span id="userName">Yönetici Adı</span>
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
          <img id="userAvatar"
               src="../images/profil.png"
               alt="Profil Fotoğrafı"
               class="user-avatar"
               onerror="this.onerror=null;this.src='../images/profil.png'">
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="yetkili_profil.php"><i class="bi bi-person-circle"></i> Profilimi Düzenle</a></li>
          <li><a class="dropdown-item text-danger" href="yetkili_cikis.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a></li>
        </ul>
      </div>

      <div class="card-custom">
        <h4 class="mb-3">Optik Yükleme</h4>

        <div class="row g-3 mb-2">
          <div class="col-md-5">
            <label class="form-label">Sınav</label>
            <select id="sinavSelect" class="form-select" required>
              <option value="">Yükleniyor…</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Öğrenci</label>
            <select id="ogrenciSelect" class="form-select" required>
              <option value="">Yükleniyor…</option>
            </select>
          </div>
          <div class="col-md-3 d-grid">
            <label class="form-label">&nbsp;</label>
            <button type="button" class="btn btn-outline-secondary" id="btnCevapAnahtari">
              <i class="bi bi-key"></i> Cevap Anahtarı
            </button>
          </div>
        </div>

        <div id="keyWarn" class="alert alert-warning py-2 px-3 d-none">
          Bu sınav için henüz cevap anahtarı girilmemiş. Yükleme yapmak için önce <strong>Cevap Anahtarı</strong> oluşturun.
        </div>

        <form id="optikYuklemeForm" enctype="multipart/form-data" class="mt-2">
          <div class="mb-3">
            <label class="form-label">Optik Görseli (JPG/PNG)</label>
            <input type="file" name="dosya" class="form-control" accept=".jpg,.jpeg,.png" required>
          </div>
          <div class="d-flex gap-2">
            <button id="btnUpload" type="submit" class="btn btn-primary" disabled>
              <i class="bi bi-upload"></i> Yükle & Değerlendir
            </button>
            <div id="omrAlert" class="alert alert-success py-2 px-3 d-none mb-0">Yüklendi ve değerlendirildi.</div>
          </div>
        </form>
      </div>

      <div class="card-custom">
        <h5 class="mb-3">Yüklenen Optikler</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="optikTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Sınav Adı</th>
                <th>Ders Adı</th>
                <th>Öğrenci</th>
                <th>Dosya</th>
                <th>Doğru</th>
                <th>Yanlış</th>
                <th>Boş</th>
                <th>Puan</th>
                <th>Yüklenme</th>
                <th>İşlemler</th> 
              </tr>
            </thead>
            <tbody></tbody>
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

<div class="modal fade" id="modalCevapAnahtari" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" id="formCevapAnahtari">
      <div class="modal-header">
        <h5 class="modal-title">Cevap Anahtarı</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="sinav_id" id="ca_sinav_id">
        <div class="row g-2 mb-2">
          <div class="col">
            <label class="form-label">Soru Sayısı</label>
            <input type="number" min="1" class="form-control" id="ca_num_soru" name="num_soru" required>
          </div>
          <div class="col">
            <label class="form-label">Seçenek Sayısı</label>
            <input type="number" min="2" max="8" class="form-control" id="ca_num_sec" name="num_secenek" value="5" required>
          </div>
        </div>
        <div class="mb-2">
          <label class="form-label">Cevaplar (satır satır veya virgüllerle)</label>
          <textarea id="ca_cevaplar" name="cevaplar" rows="8" class="form-control" placeholder="A
B
C
D
E"></textarea>
          <div class="form-text">Boş soru için ilgili satırı boş bırakabilirsiniz.</div>
        </div>
        <div id="ca_alert" class="alert alert-success d-none">Cevap anahtarı kaydedildi.</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Kaydet</button>
      </div>
    </form>
  </div>
</div>

<script>
let dt = null;
const caModal = new bootstrap.Modal(document.getElementById('modalCevapAnahtari'));

function fillSelect(sel, rows, getText) {
  sel.innerHTML = '<option value="">Seçiniz</option>';
  rows.forEach(r => {
    const o = document.createElement('option');
    o.value = r.id;
    o.textContent = getText(r);
    sel.appendChild(o);
  });
}

function normalizeAnswers(raw) {
  const csv = (raw||'').toString().toUpperCase().trim()
    .split(/\r?\n|[ ,;]+/g).map(s=>s.trim()).filter(Boolean).join(',');
  return csv;
}

async function initPage() {
  const res = await fetch('../backend/yetkili_optikyukleme_backend.php?action=init&t='+Date.now(), {credentials:'include', cache:'no-store'});
  const j = await res.json();
  if (!j.ok) throw new Error(j.error || 'init başarısız');

  // kullanıcı
  if (j.data?.kullanici) {
    const u = j.data.kullanici;
    const name = [u.ad, u.soyad].filter(Boolean).join(' ') || 'Yönetici';
    document.getElementById('userName').textContent = name;

    const img = document.getElementById('userAvatar');
    const desired = u.avatar || '../images/profil.png';
    if (img.getAttribute('src') !== desired) {
      img.src = desired;
    }
    img.onerror = () => {
      if (img.getAttribute('src') !== '../images/profil.png') {
        img.src = '../images/profil.png';
      }
    };
  }

  // selectler
  const sinavSel = document.getElementById('sinavSelect');
  const ogrSel   = document.getElementById('ogrenciSelect');
  fillSelect(sinavSel, j.data.sinavlar || [], (s)=> s.ders_adi ? `${s.ad} — ${s.ders_adi}` : s.ad);
  fillSelect(ogrSel, j.data.ogrenciler || [], (o)=> `${o.ad} ${o.soyad}`);

  // tablo
  if (!dt) {
    dt = $('#optikTable').DataTable({
      language: {
        lengthMenu: "_MENU_ kayıt göster",
        zeroRecords: "Kayıt bulunamadı",
        info: "_TOTAL_ kayıttan _START_ - _END_",
        infoEmpty: "Kayıt yok",
        search: "Ara:",
        paginate: { first: "İlk", last: "Son", next: "Sonraki", previous: "Önceki" }
      }
    });
  }
  await reloadUploads();
  await checkKeyAndToggleUI();
}

async function reloadUploads() {
  const res = await fetch('../backend/yetkili_optikyukleme_backend.php?action=list_uploads&t='+Date.now(), {credentials:'include', cache:'no-store'});
  const j = await res.json();
  if (!j.ok) throw new Error(j.error || 'liste başarısız');

  dt.clear();
  (j.data?.uploads || []).forEach(r => {
    const dosya = (r.dosya || '-').toString().replace(/^["']|["']$/g, ''); 
    dt.row.add([
      r.id,
      r.sinav_ad || '-',
      r.ders_adi || '-',
      r.ogrenci_ad ? (r.ogrenci_ad + ' ' + (r.ogrenci_soyad||'')) : '-',
      dosya,
      r.dogru ?? 0,
      r.yanlis ?? 0,
      r.bos ?? 0,
      (typeof r.puan === 'number' ? r.puan : '-'),
      r.yuklenme || '—',
      `
      <div class="btn-group btn-group-sm">
        <button class="btn btn-outline-danger" onclick="delOptik(${r.id})" title="Sil"><i class="bi bi-trash"></i></button>
        <button class="btn btn-outline-primary" onclick="regradeOptik(${r.id})" title="Yeniden Değerlendir"><i class="bi bi-arrow-repeat"></i></button>
      </div>
      `
    ]);
  });
  dt.draw(false);
}

async function checkKeyAndToggleUI() {
  const sid = document.getElementById('sinavSelect').value;
  const uploadBtn = document.getElementById('btnUpload');
  const warn = document.getElementById('keyWarn');

  if (!sid) { uploadBtn.disabled = true; warn.classList.add('d-none'); return; }

  try {
    const res = await fetch('../backend/yetkili_optikyukleme_backend.php?action=get_key&sinav_id='+encodeURIComponent(sid), {credentials:'include'});
    const j = await res.json();
    const hasKey = !!(j.ok && j.data && j.data.key && j.data.key.num_soru);
    uploadBtn.disabled = !hasKey;
    warn.classList.toggle('d-none', hasKey);
  } catch {
    uploadBtn.disabled = true;
    warn.classList.remove('d-none');
  }
}

document.getElementById('sinavSelect')?.addEventListener('change', checkKeyAndToggleUI);

document.getElementById('btnCevapAnahtari')?.addEventListener('click', async () => {
  const sid = document.getElementById('sinavSelect').value;
  if (!sid) { alert('Önce bir sınav seçin.'); return; }
  document.getElementById('ca_sinav_id').value = sid;

  try {
    const res = await fetch('../backend/yetkili_optikyukleme_backend.php?action=get_key&sinav_id='+sid, {credentials:'include'});
    const j = await res.json();
    if (j.ok && j.data?.key) {
      const k = j.data.key;
      document.getElementById('ca_num_soru').value = k.num_soru || '';
      document.getElementById('ca_num_sec').value  = k.num_secenek || 5;
      document.getElementById('ca_cevaplar').value = (k.cevaplar||'').replace(/,/g, '\n');
    } else {
      document.getElementById('ca_num_soru').value = '';
      document.getElementById('ca_num_sec').value  = 5;
      document.getElementById('ca_cevaplar').value = '';
    }
  } catch {}
  document.getElementById('ca_alert').classList.add('d-none');
  const caModalEl = document.getElementById('modalCevapAnahtari');
  new bootstrap.Modal(caModalEl).show();
});

document.getElementById('formCevapAnahtari')?.addEventListener('submit', async (e) => {
  e.preventDefault();
  const fd = new FormData(e.currentTarget);
  fd.append('action', 'save_key');
  fd.set('cevaplar', normalizeAnswers(fd.get('cevaplar'))); 

  try {
    const res = await fetch('../backend/yetkili_optikyukleme_backend.php', { method:'POST', body:fd, credentials:'include' });
    const j = await res.json();
    if (!j.ok) throw new Error(j.error || 'Kayıt başarısız');
    const al = document.getElementById('ca_alert');
    al.classList.remove('d-none');
    setTimeout(()=> {
      const caModalEl = document.getElementById('modalCevapAnahtari');
      bootstrap.Modal.getInstance(caModalEl)?.hide();
      checkKeyAndToggleUI(); 
    }, 700);
  } catch (err) {
    alert('Hata: ' + (err.message || err));
  }
});

document.getElementById('optikYuklemeForm')?.addEventListener('submit', async function(e){
  e.preventDefault();
  const sid = document.getElementById('sinavSelect').value;
  const oid = document.getElementById('ogrenciSelect').value;
  if (!sid) { alert('Lütfen sınav seçin.'); return; }
  if (!oid) { alert('Lütfen öğrenci seçin.'); return; }

  const fd = new FormData(this);
  fd.append('action','upload_omr');
  fd.append('sinav_id', sid);
  fd.append('ogrenci_id', oid);

  try {
    const res = await fetch('../backend/yetkili_optikyukleme_backend.php', { method:'POST', body:fd, credentials:'include' });
    const j = await res.json();
    if (!j.ok) throw new Error(j.error || 'Yükleme/okuma başarısız');

    document.getElementById('omrAlert').classList.remove('d-none');
    setTimeout(()=> document.getElementById('omrAlert').classList.add('d-none'), 1200);
    this.reset();
    await reloadUploads();
  } catch (err) {
    alert('Hata: ' + (err.message || err));
  }
});

async function delOptik(id){
  if(!confirm('Bu optiği silmek istediğinize emin misiniz?')) return;
  const fd = new FormData();
  fd.append('action','delete_optik');
  fd.append('id', id);
  const res = await fetch('../backend/yetkili_optikyukleme_backend.php', { method:'POST', body:fd, credentials:'include' });
  const j = await res.json();
  if(!j.ok){ alert('Hata: '+(j.error||'silinemedi')); return; }
  await reloadUploads();
}

async function regradeOptik(id){
  const fd = new FormData();
  fd.append('action','regrade_optik');
  fd.append('id', id);
  const res = await fetch('../backend/yetkili_optikyukleme_backend.php', { method:'POST', body:fd, credentials:'include' });
  const j = await res.json();
  if(!j.ok){ alert('Hata: '+(j.error||'yeniden değerlendirilemedi')); return; }
  await reloadUploads();
}

(async ()=>{ try{ await initPage(); } catch(e){ alert('Hata: '+(e.message||e)); } })();
</script>
</body>
</html>
