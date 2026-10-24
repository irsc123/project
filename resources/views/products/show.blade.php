<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - ديجيتال ماركت</title>
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

        /* ======= PRODUCT CARD ======= */
        .product-container {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .product-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .product-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 25px 25px 0 0;
        }
        .product-info {
            padding: 30px;
        }
        .product-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .product-category {
            display: inline-block;
            padding: 5px 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }
        .product-description {
            color: #666;
            line-height: 1.8;
            margin: 20px 0;
            font-size: 1rem;
        }
        .price-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 15px;
            margin: 20px 0;
        }
        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 1.2rem;
            margin-left: 10px;
        }
        .discount-price {
            color: #e74c3c;
            font-size: 2rem;
            font-weight: bold;
        }
        .normal-price {
            color: #667eea;
            font-size: 2rem;
            font-weight: bold;
        }
        .stock-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: bold;
        }
        .stock-high {
            background: #d4fc79;
            color: #155724;
        }
        .stock-low {
            background: #ff9a9e;
            color: #721c24;
        }
        .stock-out {
            background: #ccc;
            color: #666;
        }
        
        /* ======= QUANTITY INPUT ======= */
        .quantity-input {
            max-width: 120px;
            border-radius: 12px;
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            text-align: center;
        }
        .quantity-input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        /* ======= BUTTONS ======= */
        .btn-add-to-cart {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-add-to-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }
        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 10px 25px;
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
        .btn-whatsapp {
            background: #25d366;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
            color: white;
        }

        /* ======= BADGES ======= */
        .badge-seller {
            background: linear-gradient(135deg, #f39c12 0%, #e74c3c 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 10px;
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
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> لوحة التحكم
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container product-container">
    <div class="product-card">
        <div class="row g-0">
            <div class="col-md-5">
                @if($product->image)
                    <img src="{{ $product->image }}" class="product-img" alt="{{ $product->name }}">
                @else
                    <div class="product-img d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-digital-tiling" style="font-size: 5rem; color: white;"></i>
                    </div>
                @endif
            </div>

            <div class="col-md-7">
                <div class="product-info">
                    <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                        <span class="product-category">
                            <i class="fas fa-tags"></i> {{ $product->category?->name ?? 'بدون قسم' }}
                        </span>
                        @if($product->is_best_seller)
                            <span class="badge-seller">
                                <i class="fas fa-fire"></i> الأكثر مبيعاً
                            </span>
                        @endif
                    </div>

                    <h1 class="product-title">{{ $product->name }}</h1>

                    <!-- حالة المخزون -->
                    <div class="mb-3">
                        @if($product->in_stock > 10)
                            <span class="stock-badge stock-high">
                                <i class="fas fa-check-circle"></i> متوفر بكثرة ({{ $product->in_stock }})
                            </span>
                        @elseif($product->in_stock > 0)
                            <span class="stock-badge stock-low">
                                <i class="fas fa-exclamation-triangle"></i> متبقي {{ $product->in_stock }} فقط
                            </span>
                        @else
                            <span class="stock-badge stock-out">
                                <i class="fas fa-times-circle"></i> غير متوفر حالياً
                            </span>
                        @endif
                    </div>

                    <!-- السعر -->
                    <div class="price-box">
                        @if($product->discount_price)
                            <div>
                                <span class="discount-price">{{ $product->discount_price }} ريال</span>
                                <span class="original-price">{{ $product->price }} ريال</span>
                                <br>
                                <small class="text-success">
                                    <i class="fas fa-gift"></i> وفر {{ number_format($product->price - $product->discount_price, 2) }} ريال
                                </small>
                            </div>
                        @else
                            <div>
                                <span class="normal-price">{{ $product->price }} ريال</span>
                            </div>
                        @endif
                    </div>

                    <!-- الوصف -->
                    <div class="product-description">
                        <h5><i class="fas fa-align-right"></i> وصف المنتج:</h5>
                        <p>{{ $product->description ?? 'لا يوجد وصف لهذا المنتج' }}</p>
                    </div>

                    <!-- نموذج الإضافة للسلة -->
                    @if($product->in_stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row align-items-end">
                                <div class="col-auto">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-calculator"></i> الكمية:
                                    </label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->in_stock }}" class="quantity-input form-control">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn-add-to-cart">
                                        <i class="fas fa-shopping-cart"></i> إضافة إلى السلة
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <button class="btn-add-to-cart" disabled style="opacity: 0.5; cursor: not-allowed;">
                            <i class="fas fa-times-circle"></i> غير متوفر حالياً
                        </button>
                    @endif

                    <!-- أزرار إضافية -->
                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="{{ route('home') }}" class="btn-back">
                            <i class="fas fa-arrow-right"></i> العودة للرئيسية
                        </a>
                        <a href="https://wa.me/?text=أريد%20شراء%20{{ urlencode($product->name) }}" 
                           target="_blank" 
                           class="btn-whatsapp">
                            <i class="fab fa-whatsapp"></i> استفسار عن المنتج
                        </a>
                    </div>
                </div>
            </div>
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