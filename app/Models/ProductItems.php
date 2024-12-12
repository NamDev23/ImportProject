<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItems extends Model
{
    use HasFactory;

    // Khai báo bảng liên kết (nếu khác tên bảng mặc định)
    protected $table = 'product_items';

    // Các trường có thể được gán (fillable)
    protected $fillable = [
        'product_name',           // Tên hàng
        'short_name',             // Tên tắt
        'unit_of_measurement1',   // Đơn vị tính 1
        'unit_of_measurement2',   // Đơn vị tính 2
        'coefficient_1',          // Hệ số 1
        'unit_of_measurement3',   // Đơn vị tính 3
        'coefficient_2',          // Hệ số 2
        'purchase_price',         // Giá nhập
        'sale_price',             // Giá bán
        'declared_price',         // Giá kê khai
        'purchase_cost_price',    // Giá nhập giá vốn
        'official_price',         // Giá niêm yết
        'unit_cost_price',        // Giá vốn dịch danh
        'hapu_price',             // Giá hapu
        'last_updated_hapu_date', // Ngày cập nhật giá hapu
        'min_sale_price',         // Giá bán tối thiểu
        'max_sale_price',         // Giá bán tối đa
        'certification_number',   // Số đăng ký CL
        'specification',          // Quy cách
        'barcode',                // Mã nội đệ
        'origin',                 // Nơi sản xuất
        'position',               // Vị trí
        'product_type',           // Loại hàng
        'classification',         // Phân loại
        'product_group',          // Nhóm hàng
    ];

    // Các trường ngày tháng không cần khai báo trong $fillable vì chúng tự động quản lý qua timestamps
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Các trường không cho phép gán trực tiếp (guarded)
    protected $guarded = [];

    // Tạo một mối quan hệ hoặc phương thức nếu cần (nếu có liên kết giữa bảng khác)
}
