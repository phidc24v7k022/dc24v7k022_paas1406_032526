<?php
declare(strict_types=1);
require __DIR__ . '/taobang.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $masv  = trim($_POST['masv'] ?? '');
    $hoten  = trim($_POST['hoten'] ?? '');
    $namsinhRaw = trim($_POST['namsinh'] ?? '');
    $dienthoai = trim($_POST['dienthoai'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($masv === '')  $errors[] = "MSSV không được để trống.";
    if ($hoten === '')  $errors[] = "Họ tên không được để trống.";
    if ($dienthoai === '')  $errors[] = "Số điện thoại không được để trống.";
    if ($namsinhRaw === '' || filter_var($namsinhRaw, FILTER_VALIDATE_INT) === false) {
        $errors[] = "Năm sinh phải là số nguyên hợp lệ.";
    }
    $namsinh = (int)$namsinhRaw;
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare(
            "INSERT INTO dc24v7k022_paas_db (masv, hoten, namsinh, dienthoai, email) VALUES (:masv, :hoten, :namsinh, :dienthoai, :email)"
        );
        $stmt->execute([
            ':masv'  => $masv,
            ':hoten'  => $hoten,
            ':namsinh'  => $namsinh,
            ':dienthoai'  => $dienthoai,
            ':email' => $email,
        ]);

        header("Location: lietkesv.php?msg=" . urlencode("Thêm dữ liệu thành công!"));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm mới - Sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .form-box { background: #fff; padding: 20px; border-radius: 6px; max-width: 450px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 8px 16px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        a.back { display: inline-block; margin-bottom: 15px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <a class="back" href="lietkesv.php">&larr; Quay lại danh sách</a>
    <h1>Thêm mới</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $e): ?>
                <div><?= htmlspecialchars($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-box">
        <form method="post" action="themsv.php">
            <label>MSSV</label>
            <input type="text" name="masv" value="<?= htmlspecialchars($_POST['masv'] ?? '') ?>" required>

            <label>Họ tên</label>
            <input type="text" name="hoten" value="<?= htmlspecialchars($_POST['hoten'] ?? '') ?>" required>

            <label>Năm sinh</label>
            <input type="number" name="namsinh" value="<?= htmlspecialchars($_POST['namsinh'] ?? '') ?>" min="1900" max="<?= (int)date('Y') ?>" required>

            <label>Số điện thoại</label>
            <input type="text" name="dienthoai" value="<?= htmlspecialchars($_POST['dienthoai'] ?? '') ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

            <button type="submit">Lưu</button>
        </form>
    </div>
</body>
</html>
