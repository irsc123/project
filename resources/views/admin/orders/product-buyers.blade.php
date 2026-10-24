<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>من اشترى {{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { direction: rtl; text-align: right; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); font-family: 'Tajawal', 'Segoe UI', sans-serif; min-height: 100vh; padding-bottom: 60px; }
        .navbar { backdrop-filter: blur(10px); background: rgba(0, 0, 0, 0.85) !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); }
        .navbar-brand { font-size: 1.6rem; font-weight: bold; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .nav-link { font-size: 1rem; transition: 0.3s; color: #fff !important; }
        .nav-link:hover { color: #a78bfa !important; transform: translateY(-2px); }
        .card { border-radius: 20px; border: none; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); margin-top: 40px; }
        .card-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 25px; border-bottom: none; }
        .table thead th { background: #f8f9fa; border: none; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><i class="fas fa-cloud-upload-alt"></i> ديجيتال ماركت</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-boxes"></i> إدارة المنتجات</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-cart"></i> إدارة الطلبات</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-users"></i> من اشترى المنتج: {{ $product->name }}</h4>
            <div>القسم: {{ $product->category->name ?? '-' }}</div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3"><div class="alert alert-light mb-0">إجمالي المشتريين: <strong>{{ $summary['buyers'] }}</strong></div></div>
                <div class="col-md-3"><div class="alert alert-light mb-0">عدد الطلبات: <strong>{{ $summary['orders'] }}</strong></div></div>
                <div class="col-md-3"><div class="alert alert-light mb-0">إجمالي الكمية المباعة: <strong>{{ $summary['quantity'] }}</strong></div></div>
                <div class="col-md-3"><div class="alert alert-light mb-0">إجمالي المبيعات لهذا المنتج: <strong>{{ number_format($summary['revenue'], 2) }} ريال</strong></div></div>
            </div>

            <h5 class="mb-3">ملخص حسب العميل</h5>
            <div class="table-responsive mb-5">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>العميل</th>
                            <th>البريد</th>
                            <th>عدد الطلبات</th>
                            <th>إجمالي الكمية</th>
                            <th>إجمالي ما دفعه لهذا المنتج</th>
                            <th>آخر شراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buyers as $buyer)
                            <tr>
                                <td>{{ $buyer['user']->name }}</td>
                                <td>{{ $buyer['user']->email }}</td>
                                <td>{{ $buyer['orders_count'] }}</td>
                                <td>{{ $buyer['quantity'] }}</td>
                                <td>{{ number_format($buyer['total'], 2) }} ريال</td>
                                <td>{{ \Carbon\Carbon::parse($buyer['last_purchase'])->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">لا توجد مشتريات بعد لهذا المنتج.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <h5 class="mb-3">تفاصيل كل عملية شراء</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>رقم الطلب</th>
                            <th>العميل</th>
                            <th>البريد</th>
                            <th>الكمية</th>
                            <th>سعر الوحدة</th>
                            <th>إجمالي السطر</th>
                            <th>حالة الطلب</th>
                            <th>التاريخ</th>
                            <th>رابط الطلب</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $item)
                            <tr>
                                <td>#{{ $item->order->id }}</td>
                                <td>{{ $item->order->user->name }}</td>
                                <td>{{ $item->order->user->email }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit_price }} ريال</td>
                                <td>{{ $item->total_price }} ريال</td>
                                <td>{{ $item->order->status_label }}</td>
                                <td>{{ $item->order->created_at->format('Y-m-d H:i') }}</td>
                                <td><a href="{{ route('admin.orders.show', $item->order) }}" class="btn btn-sm btn-primary">عرض الطلب</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
