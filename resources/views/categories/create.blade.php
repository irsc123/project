<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة قسم جديد - ديجيتال ماركت</title>
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
        .form-control {
            border-radius: 12px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        textarea.form-control {
            resize: vertical;
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
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
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
                    <a class="nav-link" href="{{ route('categories.index') }}">
                        <i class="fas fa-tags"></i> الأقسام
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
                <i class="fas fa-folder-plus"></i> إضافة قسم جديد
            </h4>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-tag"></i> اسم القسم
                    </label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="مثال: برامج - كورسات - كتب">
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="fas fa-align-right"></i> وصف القسم (اختياري)
                    </label>
                    <textarea name="description" class="form-control" rows="3" placeholder="وصف مختصر للقسم...">{{ old('description') }}</textarea>
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> حفظ القسم
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i> رجوع للأقسام
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