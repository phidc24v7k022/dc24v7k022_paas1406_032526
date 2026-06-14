<?php
declare(strict_types=1);
require __DIR__ . '/taobang.php';

$stmt = $conn->query("SELECT * FROM dc24v7k022_paas_db ORDER BY id ASC");
$people = $stmt->fetchAll();

$msg = isset($_GET['msg']) ? trim($_GET['msg']) : '';
$msgType = 'success';
if ($msg !== '') {
    $errorKeywords = ['không hợp lệ', 'không tìm thấy', 'lỗi'];
    foreach ($errorKeywords as $keyword) {
        if (stripos($msg, $keyword) !== false) {
            $msgType = 'error';
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 50%, #ecfeff 100%);
            color: #1e293b;
        }
        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }
        .header {
            margin-bottom: 24px;
        }
        .header h1 {
            margin: 0 0 8px;
            font-size: 2rem;
            color: #0f172a;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 16px;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }
        .back-link:hover { text-decoration: underline; }
        .info-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }
        .info-card p {
            margin: 0 0 8px;
            color: #475569;
            line-height: 1.5;
        }
        .info-card p:last-child { margin-bottom: 0; }
        .msg {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .msg-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .msg-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .menu-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 24px;
        }
        .menu-bar a {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .menu-bar a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.14);
        }
        .menu-bar .btn-home    { background: linear-gradient(135deg, #64748b, #475569); }
        .menu-bar .btn-taobang { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .menu-bar .btn-taosv   { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .menu-bar .btn-lietke  { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
        .table-wrap {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }
        th {
            background: #1e293b;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
        }
        tr:last-child td { border-bottom: none; }
        tr:nth-child(even) { background: #f8fafc; }
        tr:hover { background: #f1f5f9; }
        .empty-row td {
            text-align: center;
            color: #94a3b8;
            padding: 32px;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 3px;
            border-radius: 6px;
            text-decoration: none;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: opacity 0.15s;
        }
        .btn:hover { opacity: 0.88; }
        .btn-edit   { background: #3b82f6; }
        .btn-delete { background: #ef4444; }
        .actions { white-space: nowrap; }
    </style>
</head>
<body>
    <div class="page">
        <a class="back-link" href="index.php">&larr; Về trang chủ</a>

        <div class="header">
            <h1>Danh sách sinh viên</h1>
        </div>

        <?php if ($msg !== ''): ?>
            <div class="msg msg-<?= $msgType ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <div class="info-card">
            <p>Kiểm tra Paas, ngày 14/06/2026 — Học kỳ 3 — 20252026</p>
            <p>Họ và tên: LÊ HOÀNG PHI — MSSV: DC24V7K022</p>
            <p>Thực hành buổi 6 — Platform.sh/Upsun — Số thứ tự: 14 — Lớp: DC24V7K1</p>
        </div>

        <div class="menu-bar">
            <a class="btn-home" href="index.php">Trang chủ</a>
            <a class="btn-taobang" href="taobang.php">Tạo bảng</a>
            <a class="btn-taosv" href="themsv.php">Thêm sinh viên</a>
            <a class="btn-lietke" href="lietkesv.php">Danh sách sinh viên</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>MSSV</th>
                        <th>Họ tên</th>
                        <th>Năm sinh</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($people) === 0): ?>
                        <tr class="empty-row">
                            <td colspan="7">Chưa có dữ liệu. Hãy <a href="themsv.php">thêm sinh viên</a>.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($people as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$p['id']) ?></td>
                            <td><?= htmlspecialchars($p['masv']) ?></td>
                            <td><?= htmlspecialchars($p['hoten']) ?></td>
                            <td><?= (int)$p['namsinh'] ?></td>
                            <td><?= htmlspecialchars($p['dienthoai']) ?></td>
                            <td><?= htmlspecialchars($p['email']) ?></td>
                            <td class="actions">
                                <a class="btn btn-edit" href="suathongtin.php?id=<?= (int)$p['id'] ?>">Sửa</a>
                                <a class="btn btn-delete" href="xoasv.php?id=<?= (int)$p['id'] ?>"
                                   onclick="return confirm('Bạn có chắc muốn xóa bản ghi này?');">Xóa</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
