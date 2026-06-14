<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM dc24v7k022_paas_db WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: index.php?msg=" . urlencode("Xóa thành công!"));
    exit;
}

header("Location: index.php?msg=" . urlencode("ID không hợp lệ."));
exit;
