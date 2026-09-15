<?php
require_once __DIR__ . '/admin/config.php'; // dung chung doc_json_file()/ghi_json_file()

/** Khai báo các file cài đặt cho phép tải - dùng key ngắn gọn trong URL, tránh lộ đường dẫn thật. */
const DOWNLOAD_MAP = [
    'qlbh-soft' => [
        'file' => 'downloads/QLBH-SOFT-Setup.exe',
        'ten' => 'QLBH-SOFT-Setup.exe',
    ],
];

const LUOT_TAI_FILE = __DIR__ . '/data/luot_tai.json';
const DANH_GIA_FILE = __DIR__ . '/data/danh_gia.json';

/** Tăng đếm lượt tải cho 1 sản phẩm (dùng chung doc_json_file/ghi_json_file từ admin/config.php). */
function tang_luot_tai(string $key): void
{
    $data = doc_json_file(LUOT_TAI_FILE);
    $data[$key] = (int) ($data[$key] ?? 0) + 1;
    ghi_json_file(LUOT_TAI_FILE, $data);
}

function doc_luot_tai(string $key): int
{
    $data = doc_json_file(LUOT_TAI_FILE);
    return (int) ($data[$key] ?? 0);
}

/** Ghi 1 lượt đánh giá sao (1-5) ẩn danh cho 1 sản phẩm. */
function ghi_danh_gia(string $key, int $diem): void
{
    $data = doc_json_file(DANH_GIA_FILE);
    $tong = (float) ($data[$key]['tong_diem'] ?? 0) + $diem;
    $soLuot = (int) ($data[$key]['so_luot'] ?? 0) + 1;
    $data[$key] = ['tong_diem' => $tong, 'so_luot' => $soLuot];
    ghi_json_file(DANH_GIA_FILE, $data);
}

/** Đọc điểm trung bình + số lượt đánh giá của 1 sản phẩm. */
function doc_danh_gia(string $key): array
{
    $data = doc_json_file(DANH_GIA_FILE);
    $soLuot = (int) ($data[$key]['so_luot'] ?? 0);
    $tong = (float) ($data[$key]['tong_diem'] ?? 0);
    return [
        'trung_binh' => $soLuot > 0 ? round($tong / $soLuot, 1) : 0,
        'so_luot' => $soLuot,
    ];
}
