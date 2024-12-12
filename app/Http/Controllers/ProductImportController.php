<?php

namespace App\Http\Controllers;

use App\Models\ProductItems;
use Illuminate\Http\Request;
use App\Imports\ProductItemsImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    /**
     * Hàm để hiển thị form upload file Excel
     */
    public function showImportForm()
    {
        $productItems = ProductItems::paginate(10); // Lấy danh sách sản phẩm với phân trang
        return view('import', compact('productItems'));
    }

    /**
     * Hàm để xử lý import file Excel
     */
    public function import(Request $request)
    {
        $startTime = microtime(true);
        ini_set('memory_limit', '512M');  // Tăng giới hạn bộ nhớ lên 512MB
        set_time_limit(300); // Tăng thời gian chạy tối đa lên 3 phút
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new ProductItemsImport, $request->file('file'));

            $endTime = microtime(true);

            // Tính toán thời gian thực thi
            $executionTime = $endTime - $startTime;  // Thời gian tính bằng giây

            // Chuyển đổi thời gian thành định dạng dễ đọc
            $executionTimeFormatted = number_format($executionTime, 2);

            // Thêm thông báo khi hoàn thành
            session()->flash('success', 'Import completed successfully! Thời gian xử lý: ' . $executionTimeFormatted . ' giây.');
            return redirect()->route('product.list');
        } catch (\Exception $e) {
            // Ghi lỗi vào log nếu xảy ra vấn đề
            Log::error('Error importing Excel: ' . $e->getMessage());

            // Thông báo lỗi cho người dùng
            session()->flash('error', 'Error occurred while importing data!');
            return back();
        }
    }
}
