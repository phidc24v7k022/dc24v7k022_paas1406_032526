<?php
declare(strict_types=1);
require __DIR__ . '/taobang.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
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
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }
        .header {
            text-align: center;
            margin-bottom: 32px;
        }
        .header h1 {
            margin: 0 0 8px;
            font-size: 2rem;
            color: #0f172a;
        }
        .header p {
            margin: 0;
            color: #64748b;
            font-size: 1rem;
        }
        .info-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px 28px;
            margin-bottom: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }
        .info-card h2 {
            margin: 0 0 16px;
            font-size: 1.1rem;
            color: #334155;
        }
        .info-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .info-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            line-height: 1.5;
        }
        .info-list li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .info-list li::before {
            content: "";
            flex-shrink: 0;
            width: 8px;
            height: 8px;
            margin-top: 8px;
            border-radius: 50%;
            background: #3b82f6;
        }
        .menu-section h2 {
            margin: 0 0 16px;
            font-size: 1.1rem;
            color: #334155;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .menu-btn {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 20px 22px;
            border-radius: 14px;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        }
        .menu-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
        }
        .menu-btn span {
            font-size: 0.85rem;
            font-weight: 400;
            opacity: 0.92;
            line-height: 1.4;
        }
        .btn-taobang   { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .btn-taosv     { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .btn-lietke    { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
        .btn-xoa       { background: linear-gradient(135deg, #ef4444, #dc2626); }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <h1>Quản lý sinh viên</h1>
            <p>Hệ thống CRUD trên nền tảng Platform.sh / Upsun</p>
        </div>

        <div class="info-card">
            <h2>Thông tin bài thực hành</h2>
            <ul class="info-list">
                <li>Kiểm tra Paas, ngày 14/06/2026 — Học kỳ 3 — 20252026</li>
                <li>Họ và tên: LÊ HOÀNG PHI — MSSV: DC24V7K022</li>
                <li>Thực hành buổi 6 — Platform.sh/Upsun — Số thứ tự: 14 — Lớp: DC24V7K1</li>
            </ul>
        </div>

        <div class="menu-section">
            <h2>Menu chức năng</h2>
            <div class="menu-grid">
                <a class="menu-btn btn-taobang" href="taobang.php">
                    Tạo bảng
                </a>
                <a class="menu-btn btn-taosv" href="taosv.php">
                    Thêm sinh viên
                </a>
                <a class="menu-btn btn-lietke" href="lietkesv.php">
                    Danh sách sinh viên
                </a>
            </div>
        </div>
    </div>
</body>
</html>
