<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الطلبات</title>
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
        .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-processing { background: #cfe2ff; color: #084298; }
        .status-shipped { background: #e0cffc; color: #4c1d95; }
        .status-completed { background: #d1e7dd; color: #0f5132; }
        .status-cancelled { background: #f8d7da; color: #842029; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><i class="fas fa-cloud-upload-alt"></i> ديجيتال ماركت</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-boxes"></i> المنتجات</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-tags"></i> الأقسام</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-shopping-cart"></i> إدارة الطلبات</h4>
            <div class="text-white">إجمالي المبيعات: {{ number_format($stats['revenue'], 2) }} ريال</div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3"><div class="alert alert-light mb-0">عدد الطلبات: <strong>{{ $stats['orders'] }}</strong></div></div>
                <div class="col-md-3"><div class="alert alert-light mb-0">إجمالي الوحدات المباعة: <strong>{{ $stats['items'] }}</strong></div></div>
                <div class="col-md-3"><div class="alert alert-light mb-0">عدد العملاء الذين اشتروا: <strong>{{ $stats['buyers'] }}</strong></div></div>
                <div class="col-md-3"><div class="alert alert-light mb-0">طلبات غير ملغية: <strong>{{ $orders->where('status','!=','cancelled')->count() + ($orders->currentPage() > 1 ? '' : 0) }}</strong></div></div>
            </div>

            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">كل الحالات</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>قيد التجهيز</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>تم الشحن</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>العميل</th>
                            <th>البريد</th>
                            <th>عدد المنتجات</th>
                            <th>إجمالي الكمية</th>
                            <th>الإجمالي</th>
                            <th>طريقة الدفع</th>
                            <th>الحالة</th>
                            <th>التاريخ</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->items_count }}</td>
                                <td>{{ $order->items_quantity ?? 0 }}</td>
                                <td>{{ $order->total_amount }} ريال</td>
                                <td>{{ $order->payment_method_label }}</td>
                                <td>
                                    <span class="badge-status status-{{ $order->status }}">{{ $order->status_label }}</span>
                                </td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">تفاصيل + منتجات</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
</body>
</html>
