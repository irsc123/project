<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>سلة المشتريات</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { direction: rtl; text-align: right; background:#f7f7f7; }
        .card { margin-top: 40px; }
        .product-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h4 class="mb-0">🛒 سلة المشتريات</h4>
            <a href="{{ route('home') }}" class="btn btn-link">⬅ الرجوع للرئيسية</a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($items->count())
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>الإجمالي</th>
                            <th>إزالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            @php
                                $price = $item->product->discount_price ?? $item->product->price;
                                $rowTotal = $price * $item->quantity;
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->product->image ?? 'https://via.placeholder.com/60x60?text=No+Image' }}" class="product-img me-2" alt="">
                                        <div>
                                            <strong>{{ $item->product->name }}</strong><br>
                                            <small class="text-muted">القسم: {{ $item->product->category?->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $price }} ريال</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $rowTotal }} ريال</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('حذف هذا المنتج من السلة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h5 class="mb-0">المجموع الكلي: {{ $total }} ريال</h5>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success">إتمام الطلب</a>
                </div>

            @else
                <p>سلتك فارغة حالياً.</p>
            @endif

        </div>
    </div>
</div>

</body>
</html>
