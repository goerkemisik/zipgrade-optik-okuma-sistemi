<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MTÜ Optik Sınav Değerlendirme Sistemi</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'League Spartan', sans-serif;
      background-color: #f8f9fa;
      background-image: url("https://enstitubasvuru.firat.edu.tr/panel/images/pattern2.png");
      background-size: contain;
      background-repeat: repeat;
      text-align: center;
    }

    .logo img {
      width: 140px;
      margin-top: 40px;
    }

    h1 {
      margin-top: 20px;
      font-weight: 600;
      color: #002147;
      font-size: 2.2rem;
    }

    .card-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 50px;
      padding: 70px 20px;
    }

    .entry-card {
      background: #fff;
      border-radius: 28px;
      box-shadow: 0 0 30px rgba(0,0,0,0.1);
      width: 380px;
      padding: 50px 30px;
      transition: transform 0.3s;
    }

    .entry-card:hover {
      transform: translateY(-8px);
    }

    .entry-card img {
      width: 100%;
      max-height: 200px;
      object-fit: contain;
      margin-bottom: 30px;
    }

    .entry-button {
      background: linear-gradient(90deg, #002147, #00B1D4);
      border: none;
      color: #fff;
      padding: 16px 32px;
      border-radius: 30px;
      font-size: 19px;
      transition: background 0.3s;
      text-decoration: none;
      display: inline-block;
    }

    .entry-button:hover {
      background: linear-gradient(90deg, #004876, #00b6df);
    }
  </style>
</head>
<body>
  <div class="logo">
    <img src="images/mtü-logo.png" alt="MTÜ Logo">
  </div>

  <h1>Optik Sınav Değerlendirme Sistemi</h1>

    <div class="card-container">
  <div class="entry-card">
    <img src="images/mevcutogrenci.png" alt="Mevcut Girişi">
    <a href="ogrenci/ogrencigiris.php" class="entry-button">Öğrenci Girişi</a>
  </div>
  <div class="entry-card">
    <img src="images/yetkili.png" alt="Yetkili Girişi">
    <a href="yetkili/yetkiligiris.php" class="entry-button">Yetkili Girişi</a>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</html>
