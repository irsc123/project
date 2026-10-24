<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>قسم {{ $category->name }} - ديجيتال ماركت</title>
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
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            text-align: center;
        }
        .product-icon i {
            font-size: 4rem;
            color: white;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        .product-type {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .price {
            color: #667eea;
            font-weight: bold;
            font-size: 1.3rem;
        }
        .discount-price {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.3rem;
        }
        .original-price {
            color: #999;
            font-size: 0.9rem;
            text-decoration: line-through;
            margin-right: 10px;
        }
        .btn-buy {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        .btn-buy:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* ======= CATEGORY HEADER ======= */
        .category-header {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        .category-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .category-description {
            color: #666;
            font-size: 1rem;
        }
        .products-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 30px;
            display: inline-block;
            font-size: 0.9rem;
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

<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> رجوع للرئيسية
        </a>
    </div>

    <div class="category-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="category-title">
                    <i class="fas fa-tags"></i> {{ $category->name }}
                </h1>
                @if($category->description)
                    <p class="category-description mt-2">{{ $category->description }}</p>
                @endif
            </div>
            <div>
                <span class="products-count">
                    <i class="fas fa-box"></i> {{ $category->products->count() }} منتج
                </span>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        @forelse($category->products as $product)
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.show', $product->id) }}">
                    <div class="product-card">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        @else
                            <div class="product-icon">
                                <i class="fas fa-digital-tiling"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <h5>{{ $product->name }}</h5>
                            <p class="small text-muted">{{ Str::limit($product->description, 50) }}</p>
                            @if($product->discount_price)
                                <p class="mb-1">
                                    <span class="discount-price">{{ $product->discount_price }} ريال</span>
                                    <del class="original-price">{{ $product->price }} ريال</del>
                                </p>
                            @else
                                <p class="price">{{ $product->price }} ريال</p>
                            @endif
                            <button class="btn-buy" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                <i class="fas fa-shopping-cart"></i> شراء الآن
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-4">
                    <i class="fas fa-box-open" style="font-size: 4rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">لا توجد منتجات في هذا القسم حالياً.</p>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-plus-circle"></i> أضف منتج جديد
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        @endforelse
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
<script>
    function addToCart(productId) {
        @auth
            @if(auth()->user()->role === 'admin')
                alert('المسؤول لا يمكنه إضافة منتجات للسلة');
                return;
            @else
                fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId, quantity: 1 })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('تم إضافة المنتج إلى السلة');
                    }
                })
                .catch(error => {
                    alert('تم إضافة المنتج إلى السلة');
                });
            @endif
        @else
            window.location.href = '{{ route("login") }}';
        @endauth
    }
</script>
</body>
</html>