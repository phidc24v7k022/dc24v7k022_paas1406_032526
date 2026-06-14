<?php
declare(strict_types=1);

use Platformsh\ConfigReader\Config;

require __DIR__ . '/vendor/autoload.php';

$config = new Config();
if (!$config->isValidPlatform()) {
    die("Not in a Platform.sh/Upsun Environment.");
}

$credentials = $config->credentials('database');
$dsn = sprintf(
    'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
    $credentials['host'],
    $credentials['port'],
    $credentials['path']
);

try {
    $conn = new \PDO($dsn, $credentials['username'], $credentials['password'], [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        \PDO::MYSQL_ATTR_FOUND_ROWS    => true,
        \PDO::ATTR_DEFAULT_FETCH_MODE  => \PDO::FETCH_ASSOC,
    ]);

    // Tạo bảng People với mssv, email nếu chưa có
    $conn->exec("CREATE TABLE IF NOT EXISTS dc24v7k022_paas_db (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        hoten VARCHAR(50) NOT NULL,
        dienthoai VARCHAR(50) NOT NULL,
        masv VARCHAR(20) NOT NULL,
        namsinh INT NOT NULL,
        email VARCHAR(100) NOT NULL
    )");

    $conn->exec("ALTER TABLE dc24v7k022_paas_db MODIFY namsinh INT NOT NULL");

    if (basename($_SERVER['SCRIPT_FILENAME']) === 'taobang.php') {
        echo "Bảng dc24v7k022_paas_db đã được tạo thành công.";
    }

} catch (\Exception $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}
