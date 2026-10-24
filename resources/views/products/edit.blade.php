<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل منتج - ديجيتال ماركت</title>
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

        /* ======= FORM STYLES ======= */
        .form-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        /* ======= PREVIEW IMAGE ======= */
        .preview-img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #667eea;
            padding: 3px;
        }
        .current-image-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
        }

        /* ======= BUTTONS ======= */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
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
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
            display: inline-block;
            text-align: center;
        }
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
        }
        .btn-link-custom {
            background: transparent;
            border: none;
            color: #667eea;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-link-custom:hover {
            color: #764ba2;
            transform: translateX(-5px);
        }

        /* ======= ALERTS ======= */
        .alert {
            border-radius: 12px;
            border: none;
        }
        .alert-danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #721c24;
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                        <i class="fas fa-boxes"></i> قائمة المنتجات
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h4>
                <i class="fas fa-edit"></i> تعديل المنتج
            </h4>
        </div>
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-tags"></i> القسم
                    </label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-box"></i> اسم المنتج
                    </label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-align-right"></i> وصف المنتج
                    </label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-dollar-sign"></i> السعر الأساسي
                        </label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-percent"></i> سعر الخصم (اختياري)
                        </label>
                        <input type="number" step="0.01" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-warehouse"></i> الكمية في المخزون
                    </label>
                    <input type="number" name="in_stock" class="form-control" value="{{ old('in_stock', $product->in_stock) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">
                        <i class="fas fa-image"></i> الصورة الحالية
                    </label>
                    <div class="current-image-box">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="current image" class="preview-img mb-2">
                            <p class="text-muted small mt-2">الصورة الحالية للمنتج</p>
                        @else
                            <p class="text-muted mb-0">
                                <i class="fas fa-ban"></i> لا توجد صورة حالياً.
                            </p>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-upload"></i> تغيير الصورة (اختياري)
                    </label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> اتركه فارغاً إذا لا تريد تغيير الصورة.
                    </small>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="is_best_seller" class="form-check-input" id="bestSellerCheck"
                           {{ old('is_best_seller', $product->is_best_seller) ? 'checked' : '' }}>
                    <label class="form-check-label" for="bestSellerCheck">
                        <i class="fas fa-fire"></i> إضافته ضمن "الأكثر مبيعاً"
                    </label>
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> حفظ التعديلات
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i> الرجوع إلى الرئيسية
                    </a>
                </div>
            </form>

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