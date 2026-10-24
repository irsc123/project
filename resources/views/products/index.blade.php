<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة المنتجات - ديجيتال ماركت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            direction: rtl;
            text-align: right;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Tajawal', 'Segoe UI', sans-serif;
            min-height: 100vh;
            padding-bottom: 60px;
        }

        /* ======= NAVBAR ======= */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(0, 0, 0, 0.85) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-link {
            font-size: 1rem;
            transition: 0.3s;
            color: #fff !important;
        }
        .nav-link:hover {
            color: #a78bfa !important;
            transform: translateY(-2px);
        }

        /* ======= CARD STYLES ======= */
        .card {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }
        .card-header h4 {
            margin: 0;
            font-weight: bold;
        }
        .card-body {
            padding: 30px;
        }

        /* ======= TABLE STYLES ======= */
        .table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px;
            font-weight: bold;
        }
        .table tbody tr:hover {
            background-color: #f8f9ff;
            transition: 0.3s;
        }
        .table tbody td {
            vertical-align: middle;
            padding: 12px;
        }

        /* ======= BUTTONS ======= */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 8px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #6c757d;
            border: none;
            border-radius: 10px;
            padding: 5px 12px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e74c3c 100%);
            border: none;
            border-radius: 10px;
            padding: 5px 12px;
            font-size: 0.85rem;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(243, 156, 18, 0.3);
        }
        .btn-danger {
            border-radius: 10px;
            padding: 5px 12px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            transform: translateY(-2px);
        }
        .btn-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            border: none;
            border-radius: 12px;
            padding: 8px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
            color: white;
        }

        /* ======= ALERTS ======= */
        .alert {
            border-radius: 12px;
            border: none;
        }
        .alert-success {
            background: linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%);
            color: #155724;
        }

        /* ======= BADGES ======= */
        .badge-stock {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .badge-low-stock {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .price-tag {
            font-weight: bold;
            color: #667eea;
        }
        .discount-tag {
            font-weight: bold;
            color: #e74c3c;
        }

        /* ======= FOOTER ======= */
        .footer {
            background: rgba(0,0,0,0.9);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        .footer a {
            color: #a78bfa;
            text-decoration: none;
        }
        .footer a:hover {
            color: #667eea;
        }
    </style>
</head>
<body>

{{-- شريط علوي --}}
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-cloud-upload-alt"></i> ديجيتال ماركت
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> الرئيسية
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-boxes"></i> إدارة المنتجات
                </h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-success">
                        <i class="fas fa-arrow-right"></i> الرئيسية
                    </a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> إضافة منتج جديد
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($products->count())
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="fas fa-box"></i> الاسم</th>
                                <th><i class="fas fa-tags"></i> القسم</th>
                                <th><i class="fas fa-dollar-sign"></i> السعر</th>
                                <th><i class="fas fa-percent"></i> الخصم</th>
                                <th><i class="fas fa-warehouse"></i> المخزون</th>
                                <th><i class="fas fa-cogs"></i> إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        @if($product->is_best_seller)
                                            <br>
                                            <small class="text-warning">
                                                <i class="fas fa-fire"></i> الأكثر مبيعاً
                                            </small>
                                        @endif
                                    </td>
                                    <td>{{ $product->category?->name ?? 'بدون قسم' }}</td>
                                    <td class="price-tag">{{ $product->price }} ريال</td>
                                    <td>
                                        @if($product->discount_price)
                                            <span class="discount-tag">
                                                <i class="fas fa-tag"></i> {{ $product->discount_price }} ريال
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                (وفر {{ number_format($product->price - $product->discount_price, 2) }} ريال)
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->in_stock > 10)
                                            <span class="badge-stock">
                                                <i class="fas fa-check-circle"></i> {{ $product->in_stock }}
                                            </span>
                                        @elseif($product->in_stock > 0)
                                            <span class="badge-low-stock">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $product->in_stock }}
                                            </span>
                                        @else
                                            <span class="badge-low-stock">
                                                <i class="fas fa-times-circle"></i> نفد من المخزون
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {{-- زر تعديل --}}
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               class="btn btn-secondary btn-sm" 
                                               title="تعديل المنتج">
                                                <i class="fas fa-edit"></i> تعديل
                                            </a>

                                            {{-- زر خصم --}}
                                            <a href="{{ route('products.discount.edit', $product->id) }}" 
                                               class="btn btn-warning btn-sm" 
                                               title="تعديل الخصم">
                                                <i class="fas fa-percent"></i> خصم
                                            </a>

                                            {{-- زر حذف --}}
                                            <form action="{{ route('products.destroy', $product->id) }}" 
                                                  method="POST"
                                                  style="display:inline-block"
                                                  onsubmit="return confirm('⚠ هل أنت متأكد من حذف هذا المنتج؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" title="حذف المنتج">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open" style="font-size: 4rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">لا توجد منتجات حالياً.</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus-circle"></i> أضف أول منتج
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="footer">
    <div class="container">
        <div class="text-center">
            <p class="mb-0">
                <i class="fas fa-cloud-upload-alt"></i> ديجيتال ماركت - متجر المنتجات الرقمية
            </p>
            <small>© 2024 جميع الحقوق محفوظة</small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>