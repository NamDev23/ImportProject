<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Import Product Items</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: FontAwesome for loading spinner -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Định dạng cho hiệu ứng loading */
        #loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            padding-top: 20%;
            font-size: 24px;
            z-index: 9999;
        }

        /* Định dạng cho bảng */
        .table-container {
            margin-top: 30px;
            overflow-x: auto;
        }

        .table th,
        .table td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        /* Thêm khoảng cách giữa các ô và tăng kích thước font */
        .table td,
        .table th {
            padding: 12px 15px;
            font-size: 14px;
        }

        @media (max-width: 768px) {

            .table th,
            .table td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Import Product Items</h2>

        <!-- Hiển thị thông báo nếu thành công -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Hiển thị thông báo nếu có lỗi -->
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <!-- Form import -->
        <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data" id="import-form">
            @csrf

            <div class="mb-3">
                <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Import</button>
        </form>

        <!-- Hiển thị danh sách sản phẩm đã được import -->
        @if(isset($productItems) && $productItems->count() > 0)
        <h3 class="mt-5">Danh sách sản phẩm đã import (Tổng số: {{ $productItems->total() }} bản ghi)</h3>

        <!-- Bảng sản phẩm -->
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên hàng</th>
                        <th>Tên tắt</th>
                        <th>Đơn vị tính 1</th>
                        <th>Đơn vị tính 2</th>
                        <th>Hệ số 1</th>
                        <th>Đơn vị tính 3</th>
                        <th>Hệ số 2</th>
                        <th>Giá nhập</th>
                        <th>Giá bán</th>
                        <th>Giá kê khai</th>
                        <th>Giá nhập giá vốn</th>
                        <th>Giá niêm yết</th>
                        <th>Giá vốn dịch danh</th>
                        <th>Giá hapu</th>
                        <th>Ngày cập nhật giá hapu</th>
                        <th>Giá bán tối thiểu</th>
                        <th>Giá bán tối đa</th>
                        <th>Số đăng ký CL</th>
                        <th>Quy cách</th>
                        <th>Mã nội đệ</th>
                        <th>Nơi sản xuất</th>
                        <th>Vị trí</th>
                        <th>Loại hàng</th>
                        <th>Phân loại</th>
                        <th>Nhóm hàng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productItems as $productItem)
                    <tr>
                        <td>{{ $productItem->id }}</td>
                        <td>{{ $productItem->product_name }}</td>
                        <td>{{ $productItem->short_name }}</td>
                        <td>{{ $productItem->unit_of_measurement1 }}</td>
                        <td>{{ $productItem->unit_of_measurement2 }}</td>
                        <td>{{ $productItem->coefficient_1 }}</td>
                        <td>{{ $productItem->unit_of_measurement3 }}</td>
                        <td>{{ $productItem->coefficient_2 }}</td>
                        <td>{{ number_format($productItem->purchase_price) }}</td>
                        <td>{{ number_format($productItem->sale_price) }}</td>
                        <td>{{ number_format($productItem->declared_price) }}</td>
                        <td>{{ number_format($productItem->purchase_cost_price) }}</td>
                        <td>{{ number_format($productItem->official_price) }}</td>
                        <td>{{ number_format($productItem->unit_cost_price) }}</td>
                        <td>{{ number_format($productItem->hapu_price) }}</td>
                        <td>{{ $productItem->last_updated_hapu_date }}</td>
                        <td>{{ number_format($productItem->min_sale_price) }}</td>
                        <td>{{ number_format($productItem->max_sale_price) }}</td>
                        <td>{{ $productItem->certification_number }}</td>
                        <td>{{ $productItem->specification }}</td>
                        <td>{{ $productItem->barcode }}</td>
                        <td>{{ $productItem->origin }}</td>
                        <td>{{ $productItem->position }}</td>
                        <td>{{ $productItem->product_type }}</td>
                        <td>{{ $productItem->classification }}</td>
                        <td>{{ $productItem->product_group }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-4">
            {{ $productItems->links('pagination::bootstrap-5') }}
        </div>
        @else
        <p class="mt-5">Chưa có sản phẩm nào được import.</p>
        @endif
    </div>

    <!-- Màn hình loading -->
    <div id="loading">
        <i class="fas fa-spinner fa-spin"></i> Đang xử lý, vui lòng đợi...
    </div>

    <script>
        // Lắng nghe sự kiện submit form
        document.getElementById('import-form').addEventListener('submit', function() {
            // Hiển thị hiệu ứng loading khi người dùng submit form
            document.getElementById('loading').style.display = 'block';
        });
    </script>

</body>

</html>