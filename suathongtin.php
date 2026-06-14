<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php?msg=" . urlencode("ID không hợp lệ."));
    exit;
}

$errors = [];

// Lấy dữ liệu hiện tại
$stmt = $conn->prepare("SELECT * FROM dc24v7k022_paas_db WHERE id = :id");
$stmt->execute([':id' => $id]);
$person = $stmt->fetch();

if (!$person) {
    header("Location: index.php?msg=" . urlencode("Không tìm thấy bản ghi."));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $masv  = trim($_POST['masv'] ?? '');
    $hoten  = trim($_POST['hoten'] ?? '');
    $namsinh  = trim($_POST['namsinh'] ?? '');
    $dienthoai = trim($_POST['dienthoai'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($masv === '')  $errors[] = "MSSV không được để trống.";
    if ($hoten === '')  $errors[] = "Họ tên không được để trống.";
    if ($namsinh === '')  $errors[] = "Năm sinh không được để trống.";
    if ($dienthoai === '')  $errors[] = "Số điện thoại không được để trống.";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare(
            "UPDATE dc24v7k022_paas_db SET masv = :masv, hoten = :hoten, namsinh = :namsinh, dienthoai = :dienthoai, email = :email WHERE id = :id"
        );
        $stmt->execute([
            ':masv'  => $masv,
            ':hoten'  => $hoten,
            ':namsinh'  => $namsinh,
            ':dienthoai'  => $dienthoai,
            ':email' => $email,
            ':id'    => $id,
        ]);

        header("Location: index.php?msg=" . urlencode("Cập nhật thành công!"));
        exit;
    }

    // Giữ lại dữ liệu vừa nhập nếu lỗi
    $person = [
        'id'    => $id,
        'masv'  => $masv,
        'hoten'  => $hoten,
        'namsinh'  => $namsinh,
        'dienthoai'  => $dienthoai,
        'email' => $email,
    ];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa - Sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .form-box { background: #fff; padding: 20px; border-radius: 6px; max-width: 450px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        a.back { display: inline-block; margin-bottom: 15px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <a class="back" href="index.php">&larr; Quay lại danh sách</a>
    <h1>Sửa thông tin (ID: <?= (int)$person['id'] ?>)</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $e): ?>
                <div><?= htmlspecialchars($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-box">
        <form method="post" action="suathongtin.php?id=<?= (int)$person['id'] ?>">
            <label>MSSV</label>
            <input type="text" name="masv" value="<?= htmlspecialchars($person['masv']) ?>" required>

            <label>Năm sinh</label>
            <input type="text" name="namsinh" value="<?= htmlspecialchars($person['namsinh']) ?>" required>

            <label>Số điện thoại</label>
            <input type="text" name="dienthoai" value="<?= htmlspecialchars($person['dienthoai']) ?>" required>

            <label>Họ tên</label>
            <input type="text" name="hoten" value="<?= htmlspecialchars($person['hoten']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($person['email']) ?>" required>

            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>
</html>
