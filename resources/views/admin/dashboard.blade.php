<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - ديجيتال ماركت</title>
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

        /* ======= DASHBOARD STYLES ======= */
        .page-title {
            margin-top: 30px;
            margin-bottom: 30px;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        .page-title i {
            margin-left: 10px;
        }

        .dashboard-card {
            border-radius: 20px;
            padding: 30px 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .dashboard-icon {
            font-size: 3.5rem;
            margin-bottom: 15px;
        }

        .dashboard-card h4 {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* ======= WELCOME SECTION ======= */
        .welcome-card {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        .welcome-text {
            font-size: 1.2rem;
            color: #333;
        }
        .admin-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: bold;
            display: inline-block;
        }

        /* ======= STATS SECTION ======= */
        .stats-section {
            margin-bottom: 40px;
        }
        .stat-card {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
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

        /* ======= BUTTONS ======= */
        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 8px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
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
                    <a class="nav-link" href="{{ route('products.index') }}">
                        <i class="fas fa-boxes"></i> المنتجات
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

<div class="container py-4">

    <!-- بطاقة الترحيب -->
    <div class="welcome-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="mb-2">
                    <i class="fas fa-user-shield"></i> مرحباً بك في لوحة التحكم
                </h2>
                <p class="welcome-text mb-0">
                    <strong>{{ Auth::user()->name ?? 'المسؤول' }}</strong> | 
                    <span style="color: #667eea;">{{ Auth::user()->email ?? 'admin@digitalmarket.com' }}</span>
                </p>
            </div>
            <div>
                <span class="admin-badge">
                    <i class="fas fa-crown"></i> مسؤول النظام
                </span>
                <a href="{{ route('home') }}" class="btn-back me-2">
                    <i class="fas fa-arrow-right"></i> الرئيسية
                </a>
            </div>
        </div>
    </div>

    <!-- إحصائيات سريعة -->
    <div class="stats-section">
        <div class="row">
            <div class="col-md-3 col-6 mb-3">
                <div class="stat-card">
                    <div class="stat-number">{{ $productsCount ?? 0 }}</div>
                    <div class="stat-label">
                        <i class="fas fa-box"></i> إجمالي المنتجات
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stat-card">
                    <div class="stat-number">{{ $categoriesCount ?? 0 }}</div>
                    <div class="stat-label">
                        <i class="fas fa-tags"></i> الأقسام
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="stat-number">{{ $ordersCount ?? 0 }}</div>
                        <div class="stat-label">
                            <i class="fas fa-shopping-cart"></i> الطلبات
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stat-card">
                    <div class="stat-number">{{ $usersCount ?? 0 }}</div>
                    <div class="stat-label">
                        <i class="fas fa-users"></i> المستخدمين
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="page-title">
        <i class="fas fa-cogs"></i> أدوات الإدارة
    </h2>

    <div class="row">
        <!-- زر الأقسام -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas fa-folder-tree" style="color: #667eea;"></i>
                    </div>
                    <h4>إدارة الأقسام</h4>
                    <p class="text-muted">إضافة - تعديل - حذف الأقسام</p>
                </div>
            </a>
        </div>

        <!-- زر المنتجات -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas fa-boxes" style="color: #667eea;"></i>
                    </div>
                    <h4>إدارة المنتجات</h4>
                    <p class="text-muted">إضافة - تعديل - حذف - خصومات</p>
                </div>
            </a>
        </div>

        <!-- زر الطلبات -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas fa-truck" style="color: #667eea;"></i>
                    </div>
                    <h4>إدارة الطلبات</h4>
                    <p class="text-muted">من اشترى، ماذا، الكمية، تفاصيل الطلب</p>
                </div>
            </a>
        </div>

        <!-- زر المستخدمين -->
        <div class="col-md-4 mb-4">
            <a href="#" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas fa-users-cog" style="color: #667eea;"></i>
                    </div>
                    <h4>إدارة المستخدمين</h4>
                    <p class="text-muted">إدارة حسابات العملاء (قريباً)</p>
                </div>
            </a>
        </div>

        <!-- زر التقارير -->
        <div class="col-md-4 mb-4">
            <a href="#" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas fa-chart-line" style="color: #667eea;"></i>
                    </div>
                    <h4>التقارير</h4>
                    <p class="text-muted">إحصائيات المبيعات (قريباً)</p>
                </div>
            </a>
        </div>

        <!-- زر الإعدادات -->
        <div class="col-md-4 mb-4">
            <a href="#" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas fa-sliders-h" style="color: #667eea;"></i>
                    </div>
                    <h4>إعدادات المتجر</h4>
                    <p class="text-muted">إعدادات عامة وتخصيص (قريباً)</p>
                </div>
            </a>
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