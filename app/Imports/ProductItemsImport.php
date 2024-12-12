<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\ProductItems;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Collection;

class ProductItemsImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
     * Hàm này nhận dữ liệu Excel và chuyển đổi nó thành các model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ProductItems([
            'product_name' => $row['ten_hang'],
            'short_name' => $row['ten_tat'],
            'unit_of_measurement1' => $row['dv_tinh1'],
            'unit_of_measurement2' => $row['dv_tinh_2'],
            'coefficient_1' => $row['he_so_1'],
            'unit_of_measurement3' => $row['dv_tinh_3'],
            'coefficient_2' => $row['he_so_2'],
            'purchase_price' => $row['gia_nhap'],
            'sale_price' => $row['gia_ban'],
            'declared_price' => $row['gia_ke_khai'],
            'purchase_cost_price' => $row['gia_nhap_gia_von'],
            'official_price' => $row['gia_niem_yet'],
            'unit_cost_price' => $row['gia_von_dich_danh'],
            'hapu_price' => $row['gia_hapu'],
            // 'last_updated_hapu_date' =>  $row['ngay_cap_nhat_gia_hapu'],
            'last_updated_hapu_date' => !empty($row['ngay_cap_nhat_gia_hapu'])
                ? Carbon::createFromTimestamp(($row['ngay_cap_nhat_gia_hapu'] - 25569) * 86400)->format('Y-m-d H:i:s')
                : null,
            'min_sale_price' => $row['gia_ban_toi_thieu'],
            'max_sale_price' => $row['gia_ban_toi_da'],
            'certification_number' => $row['so_dkcl'],
            'specification' => $row['quy_cach'],
            'barcode' => $row['ma_noi_de'],
            'origin' => $row['noi_de'],
            'position' => $row['vi_tri'],
            'product_type' => $row['loai_hang'],
            'classification' => $row['phan_loai'],
            'product_group' => $row['nhom_hang'],
        ]);
    }
    public function chunkSize(): int
    {
        return 500;
    }

    /**
     * Để giảm số lần ghi vào cơ sở dữ liệu.
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 500;
    }

    /**
     * Hàm xử lý việc sắp xếp dữ liệu trước khi import.
     */
    // public function onImport(Collection $rows)
    // {
    //     // Lọc dữ liệu để đảm bảo chỉ những dòng có ID hợp lệ
    //     $rows = $rows->filter(function ($row) {
    //         return is_numeric($row['ID']);
    //     });

    //     // Sắp xếp dữ liệu theo ID tăng dần
    //     $rows = $rows->sortBy('ID');

    //     // Import từng dòng vào cơ sở dữ liệu
    //     foreach ($rows as $row) {
    //         $this->model($row);
    //     }
    // }
}
