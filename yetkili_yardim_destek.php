<?php
session_start();
if (!isset($_SESSION['yetkili_id'])) {
  header('Location: yetkili_giris.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Yardım & Destek - MTÜ OSDS</title>

<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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
.card-custom { background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); }
.footer { background:#f1f1f1; border-top:1px solid #ddd; text-align:center; font-size:15px; color:#333; padding:15px; }
.footer img { width:28px; margin-right:8px; vertical-align:middle; }
table.dataTable { border-collapse:collapse !important; width:100% !important; table-layout:fixed; }
table.dataTable thead th { background-color:#002147; color:#fff; text-align:center; vertical-align:middle; }
table.dataTable td { vertical-align:middle; white-space:normal; word-wrap:break-word; text-align:left; padding:10px; }
table.dataTable td:nth-child(1){ width:5%; text-align:center; }
table.dataTable td:nth-child(2){ width:15%; }
table.dataTable td:nth-child(3){ width:15%; }
table.dataTable td:nth-child(4){ width:25%; }
table.dataTable td:nth-child(5){ width:15%; }
table.dataTable td:nth-child(6){ width:15%; text-align:center; }
table.dataTable td:nth-child(7){ width:10%; text-align:center; }
</style>
</head>
<body>

<div class="wrapper">
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="../images/mtü-logo.png" alt="MTÜ Logo">
      <h2>Yetkili Paneli</h2>
    </div>
    <div class="sidebar-menu">
      <a href="yetkili_anasayfa.php"><i class="bi bi-house-door"></i> Ana Sayfa</a>
      <a href="yetkili_sinavyonetimi.php"><i class="bi bi-journal-text"></i> Sınav Yönetimi</a>
      <a href="yetkili_optik_yukleme.php"><i class="bi bi-upload"></i> Optik Yükleme</a>
      <a href="yetkili_sonuclar.php"><i class="bi bi-bar-chart-line"></i> Sonuçlar</a>
      <a href="yetkili_analizler.php"><i class="bi bi-graph-up"></i> Analizler</a>
      <a href="yetkili_kullanici_yonetimi.php"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
      <a href="yetkili_duyurular.php"><i class="bi bi-megaphone"></i> Duyurular</a>
      <a href="yetkili_yardim_destek.php" class="active"><i class="bi bi-question-circle"></i> Yardım & Destek</a>
    </div>
  </div>

  <div class="content-wrapper">
    <div class="main-content">
      <div class="user-info dropdown">
        <span id="userName">Yönetici</span>
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
          <img id="userAvatar" src="../images/profil.png" alt="Profil Fotoğrafı" class="user-avatar">
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="yetkili_profil.php"><i class="bi bi-person-circle"></i> Profilimi Düzenle</a></li>
          <li><a class="dropdown-item text-danger" href="yetkili_cikis.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a></li>
        </ul>
      </div>

      <div class="card-custom">
        <h4 class="fw-bold mb-3 text-primary">Yardım & Destek Talepleri</h4>
        <div class="table-responsive">
          <table id="yardimTable" class="table table-bordered table-striped align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Öğrenci</th>
                <th>Konu</th>
                <th>Açıklama</th>
                <th>Yanıt</th>
                <th>Tarih</th>
                <th>İşlemler</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <footer class="footer">
      <p><img src="../images/mtü-logo.png" alt="MTÜ Logo"> Malatya Turgut Özal Üniversitesi Dijital Dönüşüm Ofisi</p>
      <p>© 2025 Malatya Turgut Özal Üniversitesi. Tüm Hakları Saklıdır.</p>
    </footer>
  </div>
</div>

<!-- Detay Modal -->
<div class="modal fade" id="detayModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Talep Detayı</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Öğrenci:</strong> <span id="dOgrenci"></span></p>
        <p><strong>Konu:</strong> <span id="dKonu"></span></p>
        <p><strong>Açıklama:</strong><br><span id="dAciklama"></span></p>
        <p><strong>Yanıt:</strong><br><span id="dYanit"></span></p>
        <p><strong>Tarih:</strong> <span id="dTarih"></span></p>
      </div>
    </div>
  </div>
</div>

<!-- Yanıt Modal -->
<div class="modal fade" id="yanitModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Yanıt Ver</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="yId">
        <textarea id="yMetin" class="form-control" rows="4" placeholder="Yanıtınızı yazın..."></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button class="btn btn-success" id="btnYanitKaydet"><i class="bi bi-save"></i> Kaydet</button>
      </div>
    </div>
  </div>
</div>

<script>
const API = '../backend/yetkili_yardim_destek_backend.php';
function fmtDate(dt){ if(!dt)return '-'; const d=new Date(dt.replace(' ','T')); return isNaN(d)?dt:d.toLocaleString('tr-TR'); }
async function safeJson(url,opts={}){ const r=await fetch(url,{credentials:'include',cache:'no-store',...opts}); const t=await r.text(); return JSON.parse(t); }

async function loadProfil(){
  try{
    const js = await safeJson('../backend/yetkili_profil_backend.php?action=get');
    if(js.ok && js.item){
      document.getElementById('userName').textContent = `${js.item.ad} ${js.item.soyad}`.trim();
      document.getElementById('userAvatar').src = js.item.fotograf || '../images/profil.png';
    }
  }catch{}
}

async function loadTable(){
  const js = await safeJson(`${API}?mode=list`);
  const tbody=document.querySelector('#yardimTable tbody');
  tbody.innerHTML='';
  (js.items||[]).forEach(it=>{
    tbody.insertAdjacentHTML('beforeend',`
      <tr>
        <td>${it.id}</td>
        <td>${it.ogrenci_adsoyad || ('#'+it.ogrenci_id)}</td>
        <td>${it.konu || '-'}</td>
        <td>${it.aciklama || '-'}</td>
        <td>${it.yanit ? it.yanit : '<span class="badge bg-secondary">Yanıt yok</span>'}</td>
        <td>${fmtDate(it.created_at)}</td>
        <td>
          <button class="btn btn-info btn-sm me-1" onclick="detay(${it.id})"><i class="bi bi-eye"></i></button>
          <button class="btn ${it.yanit ? 'btn-outline-success':'btn-success'} btn-sm me-1" onclick="yanit(${it.id})"><i class="bi bi-reply"></i></button>
          <button class="btn btn-danger btn-sm" onclick="sil(${it.id})"><i class="bi bi-trash"></i></button>
        </td>
      </tr>`);
  });
  $('#yardimTable').DataTable({destroy:true,ordering:false,language:{zeroRecords:"Kayıt bulunamadı"}});
}

async function detay(id){
  const js=await safeJson(`${API}?mode=get&id=${id}`);
  if(js.ok){
    const it=js.item;
    document.getElementById('dOgrenci').textContent=it.ogrenci_adsoyad||('#'+it.ogrenci_id);
    document.getElementById('dKonu').textContent=it.konu;
    document.getElementById('dAciklama').textContent=it.aciklama;
    document.getElementById('dYanit').textContent=it.yanit||'Yanıt yok';
    document.getElementById('dTarih').textContent=fmtDate(it.created_at);
    new bootstrap.Modal(document.getElementById('detayModal')).show();
  }
}

async function yanit(id){
  document.getElementById('yId').value=id;
  const js=await safeJson(`${API}?mode=get&id=${id}`);
  document.getElementById('yMetin').value=js.item?.yanit||'';
  new bootstrap.Modal(document.getElementById('yanitModal')).show();
}

document.getElementById('btnYanitKaydet').addEventListener('click',async()=>{
  const id=document.getElementById('yId').value;
  const metin=document.getElementById('yMetin').value.trim();
  if(!metin){alert('Yanıt boş olamaz');return;}
  const fd=new FormData();fd.append('id',id);fd.append('yanit',metin);
  const js=await safeJson(`${API}?mode=yanit`,{method:'POST',body:fd});
  if(js.ok){
  bootstrap.Modal.getInstance(document.getElementById('yanitModal')).hide();
  location.reload(); // sayfayı yeniler
}

});

async function sil(id){
  if(!confirm('Bu talebi silmek istiyor musunuz?'))return;
  const fd=new FormData();fd.append('id',id);
  const js=await safeJson(`${API}?mode=delete`,{method:'POST',body:fd});
 if(js.ok){
  alert('Kayıt silindi.');
  location.reload(); // sayfayı yeniler
}
}

document.addEventListener('DOMContentLoaded',()=>{loadProfil();loadTable();});
</script>
</body>
</html>
