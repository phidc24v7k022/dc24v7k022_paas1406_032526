<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

$stmt = $conn->query("SELECT * FROM dc24v7k022_paas_db ORDER BY id ASC");
$people = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách People</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        h1 { color: #333; }
        table { border-collapse: collapse; width: 100%; background: #fff; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #4a4a4a; color: #fff; }
        tr:nth-child(even) { background: #f9f9f9; }
        a.btn, button.btn {
            display: inline-block; padding: 5px 10px; margin: 0 2px;
            border-radius: 4px; text-decoration: none; color: #fff; font-size: 14px;
            border: none; cursor: pointer;
        }
        .btn-add    { background: #28a745; }
        .btn-edit   { background: #007bff; }
        .btn-delete { background: #dc3545; }
        .top-bar { margin-bottom: 15px; }
        .msg { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>

    <?php if (isset($_GET['msg'])): ?>
        <div class="msg"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <div>-Kiểm tra Paas, ngày 14/06/2026 - Học kỳ 3 - 20252026</div>
    <div>-Họ và tên: LÊ HOÀNG PHI; MSSV: DC24V7K022</div>
    <div>-Thực hành buổi 6 - Platform.sh/Upsun. Số thứ tự trong danh sách: 14, Lớp: DC24V7K1</div>
    Menu thông tin:
    <a href="taobang.php">Tạo bảng</a>
    <a href="taosv.php">Thêm sinh viên</a>
    <a href="index.php">Danh sách sinh viên</a>
    <a href="xoasv.php">Xóa sinh viên</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Thành phố</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($dc24v7k022_paas_db) === 0): ?>
                <tr><td colspan="6" style="text-align:center;">Chưa có dữ liệu</td></tr>
            <?php else: ?>
                <?php foreach ($dc24v7k022_paas_db as $p): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$p['id']) ?></td>
                    <td><?= htmlspecialchars($p['masv']) ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['namsinh']) ?></td>
                    <td><?= htmlspecialchars($p['dienthoai']) ?></td>
                    <td><?= htmlspecialchars($p['email']) ?></td>
                    <td>
                        <a class="btn btn-edit" href="suathongtin.php?id=<?= (int)$p['id'] ?>">Sửa</a>
                        <a class="btn btn-delete" href="xoasv.php?id=<?= (int)$p['id'] ?>"
                           onclick="return confirm('Bạn có chắc muốn xóa bản ghi này?');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
