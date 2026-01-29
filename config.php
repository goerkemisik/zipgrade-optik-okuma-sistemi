<?php
// === GÜVENLİ SESSION AYARLARI ===
if (session_status() === PHP_SESSION_NONE) {
  session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',          // tüm dizinlerde geçerli
    'httponly' => true,
    'samesite' => 'Lax',
    // 'secure' => true, // HTTPS ortamında aktif et
  ]);
  session_start();
}

// === VERİTABANI AYARLARI ===
$DB_HOST = 'localhost';
$DB_NAME = 'mtuosds';
$DB_USER = 'root';
$DB_PASS = '';

try {
  $pdo = new PDO(
    "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
    $DB_USER,
    $DB_PASS,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false
    ]
  );
} catch (Throwable $e) {
  error_log("DB bağlantı hatası: " . $e->getMessage(), 3, __DIR__ . '/error.log');
  die("Sistem hatası, lütfen daha sonra tekrar deneyiniz.");
}

// === XSS KORUMALI HTML KAÇIŞ ===
if (!function_exists('h')) {
  function h($s) {
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
  }
}

// === CSRF TOKEN ÜRETİMİ ===
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
