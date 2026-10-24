<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إتمام الطلب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { direction: rtl; text-align: right; background:#f7f7f7; }
        .card { margin-top: 40px; border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
<div class="container">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="mb-0">معلومات التوصيل والدفع</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">عنوان التوصيل الكامل *</label>
                            <textarea name="shipping_address" class="form-control" rows="3" required placeholder="المدينة، الحي، الشارع، رقم المبنى...">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">رقم الجوال (اختياري)</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">طريقة الدفع *</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>الدفع عند الاستلام</option>
                                    <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                                    <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>بطاقة</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ملاحظات (اختياري)</label>
                            <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                        </div>
                        <button class="btn btn-success">تأكيد الطلب</button>
                        <a href="{{ route('cart.index') }}" class="btn btn-link">العودة للسلة</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">ملخص الطلب</h5>
                </div>
                <div class="card-body">
                    @foreach($items as $item)
                        @php
                            $price = $item->product->discount_price ?? $item->product->price;
                            $rowTotal = $price * $item->quantity;
                        @endphp
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <div>{{ $item->product->name }}</div>
                                <small class="text-muted">الكمية: {{ $item->quantity }} × {{ $price }} ريال</small>
                            </div>
                            <div>{{ $rowTotal }} ريال</div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="d-flex justify-content-between fw-bold">
                        <span>الإجمالي</span>
                        <span>{{ $total }} ريال</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
