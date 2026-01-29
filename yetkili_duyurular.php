<?php
// yetkili_duyurular.php
session_start();
if (!isset($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf'];

// login akışında set edildiği varsayılıyor:
$yetkiliId = $_SESSION['yetkili_id'] ?? 0;
$adsoyad = trim($_SESSION['adsoyad'] ?? '');
if ($adsoyad === '') {
  $ad = trim($_SESSION['yetkili_ad']   ?? '');
  $soy= trim($_SESSION['yetkili_soyad']?? '');
  $adsoyad = trim("$ad $soy");
}
if ($adsoyad === '') {
  $adsoyad = 'Yönetici';
}

// avatar kaynağı (yoksa profil.png)
$avatarSrc = $yetkiliId > 0
  ? "../backend/yetkili_duyurular_backend.php?action=avatar&id=" . urlencode($yetkiliId) . "&v=" . time()
  : "../images/profil.png";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Yetkili Duyurular - MTUOSDS</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
  <style>
    * { box-sizing: border-box; }
    html, body { height: 100%; margin: 0; font-family: 'League Spartan', sans-serif; background-color: #f4f6f9; }
    .wrapper { display: flex; min-height: 100vh; }
    .sidebar { width: 270px; background: linear-gradient(to bottom, #002147, #005B96); color: white; padding: 20px; display: flex; flex-direction: column; }
    .sidebar-header { text-align: center; margin-bottom: 30px; }
    .sidebar-header img { width: 100px; margin-bottom: 10px; }
    .sidebar-header h2 { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; margin: 0; }
    .sidebar-menu a { display: flex; align-items: center; gap: 10px; color: white; text-decoration: none; margin-bottom: 18px; padding: 12px; border-radius: 6px; font-size: 16px; }
    .sidebar-menu a:hover, .sidebar-menu a.active { background-color: rgba(255, 255, 255, 0.2); }
    .content-wrapper { flex: 1; display: flex; flex-direction: column; }
    .main-content { flex: 1; padding: 30px; }
    .user-info { display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #002147; margin-bottom: 20px; font-size: 18px; }
    .user-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #005B96; }
    .card-custom { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }
    .footer { padding: 20px; background-color: #f1f1f1; border-top: 1px solid #ddd; font-size: 15px; color: #333; }
    .btn-primary { background-color: #002147; border-color: #002147; }
    .badge-onemli { background:#dc3545; }
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
      <a href="yetkili_kullanici_yonetimi.php"><i class="bi bi-people"></i> Kullanıcı Yönetimi</a>
      <a href="yetkili_duyurular.php" class="active"><i class="bi bi-megaphone"></i> Duyurular</a>
      <a href="yetkili_yardim_destek.php"><i class="bi bi-question-circle"></i> Yardım & Destek</a>
    </div>
  </div>

  <!-- İçerik -->
  <div class="content-wrapper">
    <div class="main-content">
      <div class="user-info dropdown">
        <span><?= htmlspecialchars($adsoyad) ?></span>
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUserMenu" data-bs-toggle="dropdown">
          <img
            src="<?= htmlspecialchars($avatarSrc) ?>"
            alt="Profil Fotoğrafı"
            class="user-avatar"
            onerror="this.onerror=null;this.src='../images/profil.png';">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUserMenu">
          <li><a class="dropdown-item" href="yetkili_profil.php"><i class="bi bi-person-circle"></i> Profilimi Düzenle</a></li>
          <li><a class="dropdown-item text-danger" href="yetkiligiris.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a></li>
        </ul>
      </div>

      <div class="card-custom">
        <h5 class="mb-3 fw-bold text-dark">Duyuru Listesi</h5>
        <p class="mb-4">Bu sayfada duyuruları yönetebilirsiniz.</p>

        <div class="table-responsive">
          <table id="duyuruTable" class="table table-bordered w-100">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Başlık</th>
                <th>İçerik</th>
                <th>Enstitü</th>
                <th>Yayın</th>
                <th>Bitiş</th>
                <th>Önem</th>
                <th style="width:100px">İşlemler</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#duyuruModal">
            <i class="bi bi-plus-lg"></i> Duyuru Oluştur
          </button>
        </div>
      </div>
    </div>

    <!-- Güncelleme Modal -->
    <div class="modal fade" id="guncelleModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bold text-dark">Duyuru Güncelle</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form id="formGuncelle">
            <input type="hidden" name="csrf" value="<?=htmlspecialchars($csrf)?>">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" id="guncelle_id">
            <div class="modal-body">
              <div class="mb-3">
                <label for="guncelle_baslik" class="form-label">Duyuru Başlığı</label>
                <input type="text" class="form-control" id="guncelle_baslik" name="baslik" required>
              </div>
              <div class="mb-3">
                <label for="guncelle_icerik" class="form-label">Duyuru İçeriği</label>
                <textarea class="form-control" id="guncelle_icerik" name="icerik" rows="5" required></textarea>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Yayın Tarihi</label>
                  <input type="datetime-local" class="form-control" id="guncelle_yayin" name="yayin_tarihi">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Bitiş Tarihi</label>
                  <input type="datetime-local" class="form-control" id="guncelle_bitis" name="bitis_tarihi">
                </div>
                <div class="col-md-6">
                  <label class="form-label">İlgili Enstitü</label>
                  <input type="text" class="form-control" id="guncelle_enstitu" name="enstitu" placeholder="FBE / SBE / ...">
                </div>
                <div class="col-md-6 d-flex align-items-end">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="guncelle_onemli" name="onemli" value="1">
                    <label class="form-check-label" for="guncelle_onemli">Önemli</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="submit" class="btn btn-success">Güncelle</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Yeni Duyuru Modal -->
    <div class="modal fade" id="duyuruModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bold text-dark">Duyuru Oluştur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form id="formEkle">
            <input type="hidden" name="csrf" value="<?=htmlspecialchars($csrf)?>">
            <input type="hidden" name="action" value="create">
            <div class="modal-body">
              <div class="mb-3">
                <label for="baslik" class="form-label">Duyuru Başlığı</label>
                <input type="text" class="form-control" id="baslik" name="baslik" required>
              </div>
              <div class="mb-3">
                <label for="icerik" class="form-label">Duyuru İçeriği</label>
                <textarea class="form-control" id="icerik" name="icerik" rows="4" required></textarea>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Yayın Tarihi</label>
                  <input type="datetime-local" class="form-control" id="yayin" name="yayin_tarihi">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Bitiş Tarihi</label>
                  <input type="datetime-local" class="form-control" id="bitis" name="bitis_tarihi">
                </div>
                <div class="col-md-6">
                  <label class="form-label">İlgili Enstitü</label>
                  <input type="text" class="form-control" id="enstitu" name="enstitu" placeholder="FBE / SBE / ...">
                </div>
                <div class="col-md-6 d-flex align-items-end">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="onemli" name="onemli" value="1">
                    <label class="form-check-label" for="onemli">Önemli</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="submit" class="btn btn-danger">Kaydet</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <footer class="footer">
      <p class="d-flex align-items-center justify-content-center">
        <img src="../images/mtü-logo.png" alt="MTÜ Logo" style="width: 30px; margin-right: 10px;" />
        Malatya Turgut Özal Üniversitesi Dijital Dönüşüm Ofisi
      </p>
      <p style="text-align: center; font-size: 14px; color: #666;">
        © 2025 Malatya Turgut Özal Üniversitesi. Tüm Hakları Saklıdır.
      </p>
    </footer>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  let table;

  function fmtDT(mysqlDT) {
    if (!mysqlDT) return '';
    return mysqlDT.replace(' ', 'T').slice(0,16);
  }

  $(document).ready(function () {
    table = $('#duyuruTable').DataTable({
      ajax: {
        url: '../backend/yetkili_duyurular_backend.php',
        type: 'GET',
        data: { action: 'list' },
        dataSrc: function (json) {
          if (!json.ok) { alert(json.msg || 'Listeleme hatası'); return []; }
          return json.data;
        }
      },
      columns: [
        { data: 'id' },
        { data: 'baslik' },
        { data: 'icerik_html', render: function (data) { return data || ''; } }, // HTML göster
        { data: 'enstitu', defaultContent: '' },
        { data: 'yayin_tarihi', render: d => d ? d.replace(':00','') : '' },
        { data: 'bitis_tarihi', render: d => d ? d.replace(':00','') : '' },
        { data: 'onemli', render: d => d == 1 ? '<span class="badge text-bg-danger">Önemli</span>' : '' },
        {
          data: null, orderable: false,
          render: function (row) {
            return `
              <div class="btn-group">
                <button class="btn btn-sm btn-warning editBtn" data-id="${row.id}"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-sm btn-danger delBtn" data-id="${row.id}"><i class="bi bi-trash"></i></button>
              </div>`;
          }
        },
      ],
      language: {
        search: "Ara:",
        lengthMenu: "Sayfada _MENU_ kayıt göster",
        info: "_TOTAL_ kayıttan _START_ - _END_",
        paginate: { previous: "Önceki", next: "Sonraki" },
        zeroRecords: "Kayıt bulunamadı",
      }
    });

    // Ekle
    $('#formEkle').on('submit', function(e) {
      e.preventDefault();
      const formData = $(this).serialize();
      $.post('../backend/yetkili_duyurular_backend.php', formData, function(res){
        if (res.ok) {
          $('#duyuruModal').modal('hide');
          $('#formEkle')[0].reset();
          table.ajax.reload(null, false);
        } else {
          alert(res.msg || 'Kayıt hatası');
        }
      }, 'json');
    });

    // Güncelle modal aç
    $(document).on('click', '.editBtn', function () {
      const id = $(this).data('id');
      $.post('../backend/yetkili_duyurular_backend.php', { action: 'get', id, csrf: '<?=htmlspecialchars($csrf)?>' }, function(res){
        if (!res.ok) { alert(res.msg || 'Kayıt getirilemedi'); return; }
        const d = res.data;
        $('#guncelle_id').val(d.id);
        $('#guncelle_baslik').val(d.baslik);
        $('#guncelle_icerik').val(d.icerik); // textarea'ya ham içerik
        $('#guncelle_enstitu').val(d.enstitu || '');
        $('#guncelle_onemli').prop('checked', d.onemli == 1);
        $('#guncelle_yayin').val(fmtDT(d.yayin_tarihi));
        $('#guncelle_bitis').val(fmtDT(d.bitis_tarihi));
        $('#guncelleModal').modal('show');
      }, 'json');
    });

    // Güncelle kaydet
    $('#formGuncelle').on('submit', function(e){
      e.preventDefault();
      const formData = $(this).serialize();
      $.post('../backend/yetkili_duyurular_backend.php', formData, function(res){
        if (res.ok) {
          $('#guncelleModal').modal('hide');
          table.ajax.reload(null, false);
        } else {
          alert(res.msg || 'Güncelleme hatası');
        }
      }, 'json');
    });

    // Sil
    $(document).on('click', '.delBtn', function () {
      const id = $(this).data('id');
      if (!confirm('Bu duyuruyu silmek istediğinize emin misiniz?')) return;
      $.post('../backend/yetkili_duyurular_backend.php', { action: 'delete', id, csrf: '<?=htmlspecialchars($csrf)?>' }, function(res){
        if (res.ok) table.ajax.reload(null, false);
        else alert(res.msg || 'Silme hatası');
      }, 'json');
    });
  });
</script>
</body>
</html>
