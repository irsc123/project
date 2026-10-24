<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تم الطلب بنجاح</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { direction: rtl; text-align: right; background:#f7f7f7; }
        .card { margin-top: 80px; border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card text-center">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <span style="font-size: 4rem;">✅</span>
                    </div>
                    <h3 class="mb-3">تم إنشاء طلبك بنجاح</h3>
                    <p class="text-muted">رقم الطلب: <strong>#{{ $order->id }}</strong></p>
                    <p class="text-muted">إجمالي الطلب: <strong>{{ $order->total_amount }} ريال</strong></p>
                    <p class="text-muted">حالة الطلب: <strong>{{ $order->status_label }}</strong></p>
                    <p class="text-muted">طريقة الدفع: <strong>{{ $order->payment_method_label }}</strong></p>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">العودة للرئيسية</a>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">سلة المشتريات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
