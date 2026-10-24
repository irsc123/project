<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ديجيتال ماركت - متجر المنتجات الرقمية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            direction: rtl;
            text-align: right;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Tajawal', 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

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
            margin-left: 10px;
            transition: 0.3s;
            color: #fff !important;
        }
        .nav-link:hover {
            color: #a78bfa !important;
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
            color: white;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeInUp 0.8s ease;
        }
        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.95;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .category-title, .section-title {
            position: relative;
            padding-right: 15px;
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            margin-bottom: 30px;
        }
        .category-title::before {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            width: 5px;
            height: 70%;
            background: linear-gradient(180deg, #ff6b6b, #ff8e53);
            border-radius: 10px;
            transform: translateY(-50%);
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
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
        .product-type {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .type-software { background: #3498db; color: white; }
        .type-subscription { background: #e74c3c; color: white; }
        .type-course { background: #2ecc71; color: white; }
        .type-book { background: #f39c12; color: white; }

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
        }
        .btn-buy:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .stats-section {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            margin: 40px 0;
            color: white;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
        }

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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-cloud-upload-alt"></i> ديجيتال ماركت
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($categories as $cat)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.show', $cat->id) }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach

                {{-- السلة تظهر فقط لغير المسؤولين --}}
                @auth
                    @if(auth()->user()->role !== 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i> سلة المشتريات
                                <span class="badge bg-danger rounded-pill" id="cartCount">0</span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i> سلة المشتريات
                            <span class="badge bg-danger rounded-pill" id="cartCount">0</span>
                        </a>
                    </li>
                @endauth

                {{-- لوحة التحكم تظهر فقط للمسؤول --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> لوحة التحكم
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info fw-bold" href="{{ route('products.create') }}">
                                <i class="fas fa-plus-circle"></i> إضافة منتج
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-end">
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> لوحة التحكم
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> إنشاء حساب
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="hero-section">
    <div class="container text-center">
        <h1 class="hero-title">
            <i class="fas fa-digital-tiling"></i> عالم المنتجات الرقمية
        </h1>
        <p class="hero-subtitle">
            اكتشف أفضل البرامج، الاشتراكات، الكورسات، والكتب الرقمية بأسعار مميزة
        </p>
    </div>
</div>

<div class="container">
    <div class="stats-section">
        <div class="row">
            <div class="col-md-3 col-6 mb-3">
                <div class="stat-number">10,000+</div>
                <div>عميل سعيد</div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stat-number">500+</div>
                <div>منتج رقمي</div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stat-number">24/7</div>
                <div>دعم فني</div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stat-number">100%</div>
                <div>تسليم فوري</div>
            </div>
        </div>
    </div>

    @foreach($categoriesWithProducts as $category)
        <h3 class="category-title mt-4">
            <a href="{{ route('categories.show', $category->id) }}" style="color: white; text-decoration: none;">
                {{ $category->name }}
            </a>
        </h3>
        <div class="row">
            @forelse($category->products as $product)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none;">
                        <div class="product-card">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                            @else
                                <div class="product-icon">
                                    <i class="fas fa-digital-tiling"></i>
                                </div>
                            @endif
                            <div class="p-3">
                                <h5>{{ $product->name }}</h5>
                                <p class="small text-muted">{{ Str::limit($product->description, 60) }}</p>
                                @if($product->discount_price)
                                    <p>
                                        <span class="discount-price">{{ $product->discount_price }} ريال</span>
                                        <del class="original-price">{{ $product->price }} ريال</del>
                                    </p>
                                @else
                                    <p class="price">{{ $product->price }} ريال</p>
                                @endif
                                {{-- زر الشراء يظهر فقط لغير المسؤولين --}}
                                @auth
                                    @if(auth()->user()->role !== 'admin')
                                        <button class="btn-buy" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                            <i class="fas fa-shopping-cart"></i> شراء الآن
                                        </button>
                                    @endif
                                @else
                                    <button class="btn-buy" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                        <i class="fas fa-shopping-cart"></i> شراء الآن
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-muted" style="color: white !important;">لا توجد منتجات في هذا القسم.</p>
            @endforelse
        </div>
    @endforeach

    <h3 class="section-title mt-5">🔥 الأكثر مبيعاً</h3>
    <div class="row">
        @forelse($bestSellers as $product)
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none;">
                    <div class="product-card">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                        @else
                            <div class="product-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <h5>{{ $product->name }}</h5>
                            <p class="price">{{ $product->price }} ريال</p>
                            {{-- زر الشراء يظهر فقط لغير المسؤولين --}}
                            @auth
                                @if(auth()->user()->role !== 'admin')
                                    <button class="btn-buy" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                        <i class="fas fa-shopping-cart"></i> شراء الآن
                                    </button>
                                @endif
                            @else
                                <button class="btn-buy" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> شراء الآن
                                </button>
                            @endauth
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted" style="color: white !important;">لا توجد منتجات مميزة حالياً.</p>
        @endforelse
    </div>

    <h3 class="section-title text-danger mt-5">💸 الخصومات</h3>
    <div class="row mb-5">
        @forelse($discountProducts as $product)
            <div class="col-md-3 mb-4">
                <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none;">
                    <div class="product-card">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                        @else
                            <div class="product-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <h5>{{ $product->name }}</h5>
                            <p>
                                <span class="discount-price">{{ $product->discount_price }} ريال</span>
                                <del class="original-price">{{ $product->price }} ريال</del>
                            </p>
                            {{-- زر الشراء يظهر فقط لغير المسؤولين --}}
                            @auth
                                @if(auth()->user()->role !== 'admin')
                                    <button class="btn-buy" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                        <i class="fas fa-shopping-cart"></i> شراء الآن
                                    </button>
                                @endif
                            @else
                                <button class="btn-buy" onclick="event.preventDefault(); addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> شراء الآن
                                </button>
                            @endauth
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted" style="color: white !important;">لا توجد عروض حالياً.</p>
        @endforelse
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="text-center">
            <p><i class="fas fa-cloud-upload-alt"></i> ديجيتال ماركت - متجر المنتجات الرقمية</p>
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
                // إضافة للسلة
                fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        document.getElementById('cartCount').innerText = data.cart_count;
                        alert('تم إضافة المنتج إلى السلة');
                    }
                });
            @endif
        @else
            window.location.href = '{{ route("login") }}';
        @endauth
    }
</script>
</body>
</html>