<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductItemsTable extends Migration
{
    public function up()
    {
        Schema::create('product_items', function (Blueprint $table) {
            $table->integerIncrements('id');  // Primary key auto-increment

            $table->string('product_name');  // Tên hàng
            $table->string('short_name');  // Tên tắt
            $table->string('unit_of_measurement1');  // Đơn vị tính 1
            $table->string('unit_of_measurement2')->nullable();  // Đơn vị tính 2 (nếu có)
            $table->integer('coefficient_1')->default(0);  // Hệ số 1
            $table->string('unit_of_measurement3')->nullable();  // Đơn vị tính 3 (nếu có)
            $table->integer('coefficient_2')->default(0);  // Hệ số 2
            $table->decimal('purchase_price', 15, 2);  // Giá nhập
            $table->decimal('sale_price', 15, 2);  // Giá bán
            $table->decimal('declared_price', 15, 2)->default(0);  // Giá kê khai
            $table->decimal('purchase_cost_price', 15, 2);  // Giá nhập giá vốn
            $table->decimal('official_price', 15, 2)->default(0);  // Giá niêm yết
            $table->decimal('unit_cost_price', 15, 2)->default(0);  // Giá vốn dịch danh
            $table->decimal('hapu_price', 15, 2)->default(0);  // Giá hapu
            $table->datetime('last_updated_hapu_date')->nullable();   // Ngày cập nhật giá hapu
            $table->decimal('min_sale_price', 15, 2)->default(0);  // Giá bán tối thiểu
            $table->decimal('max_sale_price', 15, 2)->default(0);  // Giá bán tối đa
            $table->string('certification_number')->nullable();  // Số đăng ký CL
            $table->string('specification')->nullable();  // Quy cách
            $table->string('barcode')->nullable();  // Mã nội đệ
            $table->string('origin')->nullable();  // Nơi để
            $table->string('position')->nullable();  // Vị trí
            $table->string('product_type');  // Loại hàngphp a
            $table->string('classification')->nullable();  // Phân loại
            $table->string('product_group')->nullable();  // Nhóm hàng
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_items');
    }
}
