<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الطلب #{{ $order->id }}</title>
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
        .product-img { width: 70px; height: 70px; object-fit: cover; border-radius: 10px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><i class="fas fa-cloud-upload-alt"></i> ديجيتال ماركت</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-arrow-right"></i> العودة للطلبات</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header"><h5 class="mb-0">بيانات العميل</h5></div>
                <div class="card-body">
                    <p><strong>الاسم:</strong> {{ $order->user->name }}</p>
                    <p><strong>البريد الإلكتروني:</strong> {{ $order->user->email }}</p>
                    <p><strong>رقم الطلب:</strong> #{{ $order->id }}</p>
                    <p><strong>تاريخ الطلب:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>طريقة الدفع:</strong> {{ $order->payment_method_label }}</p>
                    <p><strong>عنوان التوصيل:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>الإجمالي:</strong> {{ $order->total_amount }} ريال</p>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header"><h5 class="mb-0">تحديث حالة الطلب</h5></div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select mb-2">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>قيد التجهيز</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>تم الشحن</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                        </select>
                        <button class="btn btn-primary w-100">حفظ</button>
                    </form>
                    <div class="mt-2 text-center">الحالة الحالية: <strong>{{ $order->status_label }}</strong></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header"><h5 class="mb-0">منتجات الطلب (من اشترى ماذا وكم)</h5></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>القسم</th>
                                    <th>سعر الوحدة</th>
                                    <th>الكمية</th>
                                    <th>إجمالي السطر</th>
                                    <th>تقرير المشتريات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/70x70?text=No+Image' }}" class="product-img">
                                                <div>
                                                    <div class="fw-bold">{{ $item->product->name }}</div>
                                                    <small class="text-muted">ID: {{ $item->product->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->product->category->name ?? '-' }}</td>
                                        <td>{{ $item->unit_price }} ريال</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->total_price }} ريال</td>
                                        <td>
                                            <a href="{{ route('admin.products.buyers', $item->product) }}" class="btn btn-sm btn-outline-primary">من اشترى هذا المنتج</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
