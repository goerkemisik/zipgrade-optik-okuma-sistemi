<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yetkili Kullanıcı Yönetimi - MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
    .table thead { background:#002147; color:#fff; }
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
        <a href="yetkili_analizler.php"><i class="bi bi-graph-up"></i> Analizler</a>
        <a href="yetkili_kullanici_yonetimi.php" class="active"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
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
          <h4 class="mb-4"><strong>Kullanıcı Yönetimi</strong></h4>
          
          <div class="table-responsive">
            <table id="kullaniciTable" class="table table-bordered table-striped w-100">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Ad Soyad</th>
                  <th>Email</th>
                  <th>Durum</th>
                  <th style="width:120px;">İşlemler</th>
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


  <!-- Kullanıcı Düzenle Modal -->
  <div class="modal fade" id="kullaniciDuzenleModal" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Kullanıcı Düzenle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Ad Soyad</label>
            <input type="text" class="form-control" name="adsoyad" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label>Durum</label>
            <select class="form-select" name="durum">
              <option>Aktif</option>
              <option>Pasif</option>
            </select>
          </div>
          <hr class="my-2">
          <div class="mb-3">
            <label>Fotoğraf</label>
            <input type="file" class="form-control" name="fotograf" accept="image/*">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="fotoSil" name="foto_sil" value="1">
            <label class="form-check-label" for="fotoSil">Mevcut fotoğrafı sil</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
          <button type="submit" class="btn btn-primary">Güncelle</button>
        </div>
      </form>
    </div>
  </div>

<script>
const API = '../backend/yetkili_kullanici_yonetimi_backend.php';

function ncb(url){
  const sep = url.includes('?') ? '&' : '?';
  return `${url}${sep}_=${Date.now()}`;
}
function durumBadge(v){ return v == 1 || v === '1' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>'; }

let dt = null; // DataTable referansı

async function loadProfil(){
  try{
    const res = await fetch(ncb('../backend/yetkili_profil_backend.php?action=get'), {credentials:'include', cache:'no-store'});
    const js  = await res.json();

    if (js && js.ok && js.item){
      const nameEl = document.getElementById('userName');
      const avatarEl = document.getElementById('userAvatar');

      // ad + soyad
      const adsoyad = [js.item.ad, js.item.soyad].filter(Boolean).join(' ') || 'Yönetici';
      if (nameEl) nameEl.textContent = adsoyad;

      // fotoğraf varsa göster
      if (avatarEl)
        avatarEl.src = js.item.fotograf || '../images/profil.png';
    }
  }catch(e){
    console.warn('Profil yüklenemedi', e);
  }
}


async function fetchUsers(){
  const res = await fetch(ncb(`${API}?mode=list`), {credentials:'include', cache:'no-store'});
  const js  = await res.json();
  if(!js.ok) throw new Error(js.error||'Liste hatası');
  return js.items || [];
}

function buildTableOnce(){
  dt = $('#kullaniciTable').DataTable({
    columns: [
      { data: 'id' },
      { data: 'adsoyad' },
      { data: 'eposta',
        render: (d)=> d ? `<a href="mailto:${d}">${d}</a>` : '' },
      { data: 'durum', render: (d)=> durumBadge(d) },
      { data: null, orderable:false, searchable:false, width:120,
        render: (row)=> `
          <button class="btn btn-warning btn-sm me-1" data-action="edit" data-id="${row.id}">
            <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-danger btn-sm" data-action="del" data-id="${row.id}">
            <i class="bi bi-trash"></i>
          </button>` }
    ],
    language: {
      search: "Ara:",
      lengthMenu: "_MENU_ kayıt göster",
      zeroRecords: "Kayıt bulunamadı",
      info: "_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
      infoEmpty: "Kayıt yok",
      paginate: { first: "İlk", last: "Son", next: "Sonraki", previous: "Önceki" }
    }
  });

  // Satır butonları (edit / delete) — event delegation
  $('#kullaniciTable tbody').on('click', 'button[data-action]', async function(){
    const action = this.getAttribute('data-action');
    const id     = this.getAttribute('data-id');
    if (action === 'edit') {
      openEdit(parseInt(id,10));
    } else if (action === 'del') {
      delUser(parseInt(id,10));
    }
  });
}

async function reloadTable(){
  try{
    const items = await fetchUsers();
    dt.clear();
    dt.rows.add(items);
    dt.draw(false); // sayfa/paging korunur
  }catch(e){
    alert(e.message);
  }
}

async function openEdit(id){
  try{
    const res = await fetch(ncb(`${API}?mode=get&id=${id}`), {credentials:'include', cache:'no-store'});
    const js  = await res.json();
    if(!js.ok) throw new Error(js.error||'Kayıt alınamadı');

    const m = document.querySelector('#kullaniciDuzenleModal');
    const form = m.querySelector('form');

    // id gizli alanını garanti ekle/yenile
    let hid = form.querySelector('input[name="id"]');
    if (!hid) { hid = document.createElement('input'); hid.type='hidden'; hid.name='id'; form.prepend(hid); }
    hid.value = js.item.id;

    form.querySelector('input[name="adsoyad"]').value = `${js.item.ad??''} ${js.item.soyad??''}`.trim();
    form.querySelector('input[name="email"]').value   = js.item.eposta ?? '';
    form.querySelector('select[name="durum"]').value  = (js.item.durum??1) ? 'Aktif' : 'Pasif';
    form.querySelector('#fotoSil').checked = false;

    new bootstrap.Modal(m).show();
  }catch(e){
    alert(e.message);
  }
}

async function delUser(id){
  if(!confirm('Bu kullanıcıyı silmek istiyor musunuz?')) return;
  const btn = event?.currentTarget;
  if (btn) btn.disabled = true;
  try{
    const fd = new FormData(); fd.append('id', id);
    const res = await fetch(ncb(`${API}?mode=delete`), { method:'POST', body:fd, credentials:'include', cache:'no-store' });
    const js  = await res.json();
    if(!js.ok) throw new Error(js.error||'Silme hatası');
    await reloadTable();
  }catch(e){
    alert(e.message);
  }finally{
    if (btn) btn.disabled = false;
  }
}

document.addEventListener('DOMContentLoaded', async ()=>{
  await loadProfil();
  buildTableOnce();
  await reloadTable();

  // Düzenle formu submit
  const fDz = document.querySelector('#kullaniciDuzenleModal form');
  if (fDz) {
    fDz.addEventListener('submit', async (e)=>{
      e.preventDefault();
      const submitBtn = fDz.querySelector('button[type="submit"]');
      submitBtn.disabled = true;

      try{
        const fd = new FormData(fDz);
        const durum = fd.get('durum') === 'Aktif' ? '1' : '0';
        fd.set('durum', durum);

        const res = await fetch(ncb(`${API}?mode=update`), { method:'POST', body:fd, credentials:'include', cache:'no-store' });
        const js  = await res.json();
        if(!js.ok) throw new Error(js.error||'Güncelleme hatası');

        bootstrap.Modal.getInstance(document.querySelector('#kullaniciDuzenleModal')).hide();
        fDz.reset();
        await reloadTable();
      }catch(err){
        alert(err.message);
      }finally{
        submitBtn.disabled = false;
      }
    });

    // Modal kapanınca formu sıfırla
    document.getElementById('kullaniciDuzenleModal')
      .addEventListener('hidden.bs.modal', ()=> fDz.reset());
  }
});
</script>


</body>
</html>
