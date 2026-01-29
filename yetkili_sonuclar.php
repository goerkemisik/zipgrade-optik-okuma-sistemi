<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yetkili Sonuçlar - MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    * { box-sizing: border-box; }
    html, body { height:100%; margin:0; font-family:'League Spartan', sans-serif; background:#f4f6f9; }
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
    .table thead { background:#002147; color:#fff; }
    #sonucTable td, #sonucTable th { vertical-align: middle; }
    .col-actions { white-space:nowrap; }
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
        <a href="yetkili_sonuclar.php" class="active"><i class="bi bi-bar-chart-line"></i> Sonuçlar</a>
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
        <span id="userName">Yönetici Adı</span>
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUserMenu" data-bs-toggle="dropdown">
          <img id="userAvatar" src="../images/profil.png" alt="Profil Fotoğrafı" class="user-avatar">
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="yetkili_profil.php"><i class="bi bi-person-circle"></i> Profilimi Düzenle</a></li>
          <li><a class="dropdown-item text-danger" href="yetkili_cikis.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a></li>
        </ul>
      </div>

      <div class="card-custom">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
          <h4 class="m-0"><strong>Sınav Sonuçları</strong></h4>
          <div class="d-flex gap-2">
            <input type="text" id="fltQ" class="form-control form-control-sm" placeholder="Sınav adı ara…">
            <button id="btnAra" class="btn btn-sm btn-primary"><i class="bi bi-search"></i> Ara</button>
            <button id="btnTemizle" class="btn btn-sm btn-outline-secondary">Temizle</button>
          </div>
        </div>

        <p class="text-muted">Bu sayfada yüklenen sınav sonuçlarını görüntüleyebilir, CSV indirebilir veya silebilirsiniz.</p>

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="sonucTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Sınav Adı</th>
                <th>Dosya</th>
                <th>Yüklenme Tarihi</th>
                <th>Öğr. Sayısı</th>
                <th class="col-actions">İşlemler</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <p><img src="../images/mtü-logo.png" alt="Logo" /> Malatya Turgut Özal Üniversitesi Dijital Dönüşüm Ofisi</p>
      <p>© 2025 Malatya Turgut Özal Üniversitesi. Tüm Hakları Saklıdır.</p>
    </footer>
  </div>
</div>

<!-- Ayrıntı Modal (sınavın öğrenci bazlı sonuçları) -->
<div class="modal fade" id="viewModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="bi bi-eye"></i> Sınav Sonuçları</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div>
            <div class="fw-bold" id="vmSinavAdi">-</div>
            <div class="text-muted small" id="vmSinavMeta"></div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped w-100" id="viewTable">
            <thead>
              <tr>
                <th>Öğrenci</th>
                <th>Doğru</th>
                <th>Yanlış</th>
                <th>Boş</th>
                <th>Puan</th>
                <th>Çözülen</th>
                <th>Optik ID</th>
                <th class="col-actions">İşlem</th><!-- YENİ -->
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
const API = '../backend/yetkili_sonuclar_backend.php';
let CURRENT_VIEW_SINAV_ID = null; // açık modalın sınavı

function ncb(url){ const s=url.includes('?')?'&':'?'; return `${url}${s}_=${Date.now()}`; }
function fmtDate(dt){
  if(!dt) return '-';
  const tryIso = new Date(dt);
  if(!isNaN(tryIso)) return tryIso.toLocaleString('tr-TR');
  const trySpace = new Date(String(dt).replace(' ','T'));
  if(!isNaN(trySpace)) return trySpace.toLocaleString('tr-TR');
  return dt;
}
async function safeJson(url, opts = {}){
  const res = await fetch(url, { credentials:'include', cache:'no-store', ...opts });
  const txt = await res.text();
  if(!res.ok){ console.error('HTTP', res.status, url, txt.slice(0,800)); throw new Error('HTTP '+res.status); }
  try { return JSON.parse(txt); }
  catch { console.error('JSON parse:', txt.slice(0,800)); throw new Error('Geçersiz JSON'); }
}

/* slugify (dosya adı için) */
function slugify(str){
  if (!str) return '';
  const trMap = {'Ç':'C','ç':'c','Ğ':'G','ğ':'g','İ':'I','ı':'i','Ö':'O','ö':'o','Ş':'S','ş':'s','Ü':'U','ü':'u'};
  str = String(str).replace(/[ÇçĞğİıÖöŞşÜü]/g, m => trMap[m] || m);
  return str.replace(/\s+/g,'_').replace(/[^A-Za-z0-9_.-]/g,'').replace(/_+/g,'_').replace(/^_+|_+$/g,'');
}

/* Profil */
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


/* Ana tabloyu doldur */
async function loadMainTable(q=''){
  try{
    const js = await safeJson(ncb(`${API}?mode=list${q ? `&q=${encodeURIComponent(q)}` : ''}`));
    if(!js.ok){ alert(js.error || 'Liste hatası'); return; }

    if ($.fn.DataTable.isDataTable('#sonucTable')) {
      $('#sonucTable').DataTable().clear().destroy();
    }

    const tbody = document.querySelector('#sonucTable tbody');
    tbody.innerHTML = '';

    const items = js.items || [];
    if(items.length === 0){
  const tr = document.createElement('tr');
  const td = document.createElement('td');
  td.colSpan = 6;
  td.className = 'text-center text-muted';
  td.textContent = 'Kayıt bulunamadı.';
  tr.appendChild(td);
  tbody.appendChild(tr);
  return; // ⬅ DataTables kurulmasın!
}else {
      for (const it of items){
        const tr = document.createElement('tr');

        // ID (sinav_id)
        tr.appendChild(Object.assign(document.createElement('td'), {textContent: it.sinav_id}));

        // Sınav adı
        tr.appendChild(Object.assign(document.createElement('td'), {textContent: it.sinav_adi || ('Sınav #'+it.sinav_id)}));

        // Dosya adı (ders_adi + sinav_adi + "_sonuclar.csv")
        const tdDosya = document.createElement('td');
        const ders   = it.ders_adi ? slugify(it.ders_adi) : null;
        const sinav  = slugify(it.sinav_adi || ('Sinav_'+it.sinav_id));
        const pretty = (ders ? (ders + '_' + sinav) : sinav) + '_sonuclar.csv';
        tdDosya.textContent = pretty;
        tr.appendChild(tdDosya);

        // Yüklenme
        tr.appendChild(Object.assign(document.createElement('td'), {textContent: fmtDate(it.yuklenme)}));

        // Öğrenci sayısı
        tr.appendChild(Object.assign(document.createElement('td'), {textContent: (it.ogr_sayisi ?? '-')}));

        // İşlemler
        const tdAct = document.createElement('td');
        tdAct.className = 'col-actions';

        const btnIndir = document.createElement('button');
        btnIndir.className = 'btn btn-success btn-sm me-1';
        btnIndir.innerHTML = '<i class="bi bi-download"></i> İndir';
        btnIndir.addEventListener('click', ()=> {
          window.location.href = ncb(`${API}?mode=download_csv&sinav_id=${it.sinav_id}`);
        });

        const btnGor = document.createElement('button');
        btnGor.className = 'btn btn-primary btn-sm me-1';
        btnGor.innerHTML = '<i class="bi bi-eye"></i> Görüntüle';
        btnGor.addEventListener('click', ()=> openView(it));

        const btnSil = document.createElement('button');
        btnSil.className = 'btn btn-danger btn-sm';
        btnSil.innerHTML = '<i class="bi bi-trash"></i> Sil';
        btnSil.addEventListener('click', ()=> delExam(it.sinav_id, it.sinav_adi));

        tdAct.appendChild(btnIndir);
        tdAct.appendChild(btnGor);
        tdAct.appendChild(btnSil);
        tr.appendChild(tdAct);

        tbody.appendChild(tr);
      }
    }

    $('#sonucTable').DataTable({
      order: [[0,'desc']],
      language: {
        lengthMenu: "_MENU_ kayıt göster",
        zeroRecords: "Kayıt bulunamadı",
        info: "_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
        infoEmpty: "Kayıt yok",
        search: "Ara:",
        paginate: { first: "İlk", last: "Son", next: "Sonraki", previous: "Önceki" }
      }
    });

  } catch(e){
    console.error('Liste yüklenemedi:', e);
    alert('Liste yüklenirken hata oluştu. Konsolu kontrol edin.');
  }
}

/* Modalı doldur (mode=view) + tekil silme butonu */
async function openView(item){
  const sinavId = item.sinav_id;
  CURRENT_VIEW_SINAV_ID = sinavId;
  try{
    const js = await safeJson(ncb(`${API}?mode=view&sinav_id=${sinavId}`));
    if(!js.ok){ alert(js.error||'Ayrıntı hatası'); return; }

    document.getElementById('vmSinavAdi').textContent = item.sinav_adi || ('Sınav #'+sinavId);
    document.getElementById('vmSinavMeta').textContent =
      `Öğrenci sayısı: ${item.ogr_sayisi ?? '-'} • Yüklenme: ${fmtDate(item.yuklenme)}`;

    const tbody = document.querySelector('#viewTable tbody');
    if ($.fn.DataTable.isDataTable('#viewTable')) {
      $('#viewTable').DataTable().clear().destroy();
    }
    tbody.innerHTML = '';

    const rows = js.items || [];
    if(rows.length === 0){
  const tr = document.createElement('tr');
  const td = document.createElement('td');
  td.colSpan = 8;
  td.className = 'text-center text-muted';
  td.textContent = 'Kayıt bulunamadı.';
  tr.appendChild(td);
  tbody.appendChild(tr);
  return; // ⬅ EKLENECEK — DataTable kurulumunu atla
}
else {
      for (const r of rows){
        const tr = document.createElement('tr');

        const adsoyad = ((r.ogr_ad || r.ad || '') + ' ' + (r.ogr_soyad || r.soyad || '')).trim();
        const tdOgr = document.createElement('td'); tdOgr.textContent = adsoyad || ('Öğrenci #'+r.ogrenci_id); tr.appendChild(tdOgr);
        const tdD   = document.createElement('td'); tdD.textContent   = r.dogru; tr.appendChild(tdD);
        const tdY   = document.createElement('td'); tdY.textContent   = r.yanlis; tr.appendChild(tdY);
        const tdB   = document.createElement('td'); tdB.textContent   = r.bos; tr.appendChild(tdB);
        const tdP   = document.createElement('td'); tdP.textContent   = r.puan; tr.appendChild(tdP);
        const tdC   = document.createElement('td'); tdC.textContent   = r.cozulensoru ?? ''; tr.appendChild(tdC);
        const tdOpt = document.createElement('td'); tdOpt.textContent = r.optik_id ?? ''; tr.appendChild(tdOpt);

        // İşlem kolonu (tekil sil)
        const tdAct = document.createElement('td');
        tdAct.className = 'col-actions';
        const btnSilTekil = document.createElement('button');
        btnSilTekil.className = 'btn btn-danger btn-sm';
        btnSilTekil.innerHTML = '<i class="bi bi-trash"></i> Sil';
        btnSilTekil.addEventListener('click', ()=> delResult(r.id, sinavId));
        tdAct.appendChild(btnSilTekil);
        tr.appendChild(tdAct);

        tbody.appendChild(tr);
      }
    }

    $('#viewTable').DataTable({
      order: [[4,'desc']], // puan
      columnDefs: [
        { orderable:false, targets: -1 } // İşlem kolonu sıralanmasın
      ],
      language: {
        lengthMenu: "_MENU_ kayıt göster",
        zeroRecords: "Kayıt bulunamadı",
        info: "_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
        infoEmpty: "Kayıt yok",
        search: "Ara:",
        paginate: { first: "İlk", last: "Son", next: "Sonraki", previous: "Önceki" }
      }
    });

    new bootstrap.Modal(document.getElementById('viewModal')).show();
  }catch(e){
    console.error('Ayrıntı yüklenemedi:', e);
    alert('Ayrıntı yüklenirken hata oluştu.');
  }
}

/* Tekil sonuç silme */
async function delResult(resultId, sinavId){
  if(!confirm('Bu öğrenci sonucunu silmek istiyor musunuz?')) return;
  try{
    const fd = new FormData();
    fd.append('id', resultId);
    fd.append('sinav_id', sinavId);

    const js = await safeJson(ncb(`${API}?mode=delete_result`), { method:'POST', body: fd });
    if(!js.ok){ alert(js.error || 'Silme hatası'); return; }

    // Modal listesini ve ana tabloyu tazele
    await openView({ sinav_id: sinavId, sinav_adi: document.getElementById('vmSinavAdi')?.textContent || '' });
    const q = document.getElementById('fltQ')?.value || '';
    await loadMainTable(q.trim());
  }catch(e){
    console.error('Tekil silme hatası:', e);
    alert('Silme sırasında hata oluştu.');
  }
}

/* Tüm sınav sonuçlarını silme */
async function delExam(sinavId, sinavAdi){
  if(!confirm(`"${sinavAdi || ('Sınav #'+sinavId)}" sınavına ait TÜM öğrenci sonuçlarını silmek istiyor musunuz?\nBu işlem geri alınamaz.`)) return;
  try{
    const fd = new FormData(); fd.append('sinav_id', sinavId);
    const js = await safeJson(ncb(`${API}?mode=delete`), { method:'POST', body: fd });
    if(!js.ok){ alert(js.error || 'Silme hatası'); return; }
    await loadMainTable(document.getElementById('fltQ')?.value || '');
  }catch(e){
    console.error('Silme hatası:', e);
    alert('Silme sırasında hata oluştu.');
  }
}

document.addEventListener('DOMContentLoaded', ()=>{
  loadProfil();
  loadMainTable();
  document.getElementById('btnAra')?.addEventListener('click', ()=>{
    const q = document.getElementById('fltQ')?.value || '';
    loadMainTable(q.trim());
  });
  document.getElementById('btnTemizle')?.addEventListener('click', ()=>{
    const q = document.getElementById('fltQ'); if(q) q.value='';
    loadMainTable('');
  });
});
</script>

</body>
</html>
