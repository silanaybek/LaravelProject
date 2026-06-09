<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Anasayfa') - PikselPazar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#e94560; --dark:#1a1a2e; --secondary:#16213e; }
        * { font-family: 'Inter', sans-serif; }
        body { background: #f8f9fa; }

        /* Navbar */
        .navbar-main { background: var(--dark); padding: 0; }
        .navbar-brand { color: var(--primary) !important; font-weight: 700; font-size: 1.6rem; }
        .navbar-brand span { color: #fff; }
        .navbar-main .nav-link { color: rgba(255,255,255,.85) !important; padding: 1rem 1rem; font-size:.9rem; }
        .navbar-main .nav-link:hover { color: var(--primary) !important; }
        .navbar-toggler { border-color: rgba(255,255,255,.3); }
        .navbar-toggler-icon { filter: invert(1); }

        /* Search */
        .search-bar { background: var(--secondary); padding: .5rem 0; }
        .search-bar .input-group input { border-radius: 25px 0 0 25px; border: none; padding-left: 1.2rem; }
        .search-bar .input-group button { border-radius: 0 25px 25px 0; background: var(--primary); border: none; padding: 0 1.5rem; }

        /* Cart badge */
        .cart-count { background: var(--primary); color: #fff; border-radius: 50%; font-size: .65rem;
                      padding: 2px 6px; position: absolute; top: 5px; right: -5px; font-weight: 700; }

        /* Product card */
        .product-card { border: none; border-radius: 12px; overflow: hidden; transition: transform .2s, box-shadow .2s;
                        box-shadow: 0 2px 10px rgba(0,0,0,.07); background: #fff; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,.12); }
        .product-card .card-img-top { height: 220px; object-fit: cover; }
        .product-card .badge-discount { background: var(--primary); position: absolute; top: 12px; left: 12px;
                                         border-radius: 20px; padding: 3px 10px; font-size: .75rem; }
        .product-card .badge-featured { background: #ffc107; color: #000; position: absolute; top: 12px; right: 12px;
                                         border-radius: 20px; padding: 3px 10px; font-size: .75rem; }
        .product-card .price { color: var(--primary); font-size: 1.2rem; font-weight: 700; }
        .product-card .price-old { text-decoration: line-through; color: #aaa; font-size: .85rem; }
        .btn-add-cart { background: var(--primary); color: #fff; border: none; border-radius: 8px; width: 100%; padding: .6rem;
                         font-weight: 600; transition: background .2s; }
        .btn-add-cart:hover { background: #c73652; color: #fff; }

        /* Hero / Slider */
        .hero-slider .carousel-item { height: 480px; }
        .hero-slider .carousel-item img { height: 480px; object-fit: cover; }
        .hero-slider .carousel-caption { bottom: 80px; }
        .hero-slider .carousel-caption h2 { font-size: 2.5rem; font-weight: 700; text-shadow: 2px 2px 6px rgba(0,0,0,.5); }
        .hero-slider .carousel-caption p { font-size: 1.1rem; text-shadow: 1px 1px 4px rgba(0,0,0,.5); }
        .hero-slider .btn-shop { background: var(--primary); border: none; padding: .7rem 2rem; border-radius: 30px;
                                  font-weight: 600; color: #fff; }

        /* Section */
        .section-title { font-size: 1.6rem; font-weight: 700; position: relative; padding-bottom: .6rem; margin-bottom: 2rem; }
        .section-title::after { content:''; position: absolute; bottom: 0; left: 0; width: 50px; height: 3px;
                                  background: var(--primary); border-radius: 2px; }

        /* Category card */
        .cat-card { border: none; border-radius: 12px; overflow: hidden; cursor: pointer; transition: transform .2s;
                    text-decoration: none; color: inherit; display: block; background: #fff;
                    box-shadow: 0 2px 10px rgba(0,0,0,.07); }
        .cat-card:hover { transform: translateY(-4px); }
        .cat-card img { height: 150px; object-fit: cover; width: 100%; }
        .cat-card .cat-body { padding: 1rem; text-align: center; }

        /* Footer */
        footer { background: var(--dark); color: rgba(255,255,255,.75); margin-top: 4rem; padding: 3rem 0 1.5rem; }
        footer h5 { color: #fff; font-weight: 600; margin-bottom: 1.2rem; }
        footer a { color: rgba(255,255,255,.65); text-decoration: none; display: block; margin-bottom: .4rem; }
        footer a:hover { color: var(--primary); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.1); margin-top: 2rem; padding-top: 1rem; font-size: .85rem; }

        /* Alert */
        .alert { border: none; border-radius: 10px; }
    </style>
    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-main">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Piksel<span>Pazar</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Anasayfa</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Ürünler</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">İletişim</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item me-3">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        @php $cartCount = \App\Models\CartItem::where('session_id', session()->getId())->sum('quantity'); @endphp
                        @if($cartCount > 0)<span class="cart-count">{{ $cartCount }}</span>@endif
                    </a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if(auth()->user()->role === 'admin')
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-cogs me-2"></i>Admin Panel</a></li>
                        <li><hr class="dropdown-divider"></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="fas fa-box me-2"></i>Siparişlerim</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Çıkış Yap</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Giriş</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- Search Bar --}}
<div class="search-bar d-none d-md-block">
    <div class="container">
        <form method="GET" action="{{ route('products.index') }}" class="d-flex justify-content-center">
            <div class="input-group" style="max-width:550px;">
                <input type="text" name="search" class="form-control" placeholder="Ürün ara..." value="{{ request('search') }}">
                <button type="submit"><i class="fas fa-search text-white"></i></button>
            </div>
        </form>
    </div>
</div>

<main>
    @if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif
    @yield('content')
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>Shop<span style="color:var(--primary)">Zone</span></h5>
                <p style="font-size:.9rem;">Kaliteli ürünler, uygun fiyatlar. Güvenli alışveriş için doğru adres.</p>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Hızlı Erişim</h5>
                <a href="{{ route('home') }}">Anasayfa</a>
                <a href="{{ route('products.index') }}">Ürünler</a>
                <a href="{{ route('contact') }}">İletişim</a>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Hesabım</h5>
                @auth
                <a href="#">Siparişlerim</a>
                @else
                <a href="{{ route('login') }}">Giriş Yap</a>
                <a href="{{ route('register') }}">Kayıt Ol</a>
                @endauth
                <a href="{{ route('cart.index') }}">Sepetim</a>
            </div>
            <div class="col-md-3 mb-4">
                <h5>İletişim</h5>
                <p style="font-size:.85rem;"><i class="fas fa-envelope me-2" style="color:var(--primary)"></i>info@pikselpazar.com</p>
                <p style="font-size:.85rem;"><i class="fas fa-phone me-2" style="color:var(--primary)"></i>+90 212 000 00 00</p>
                <p style="font-size:.85rem;"><i class="fas fa-map-marker-alt me-2" style="color:var(--primary)"></i>İstanbul, Türkiye</p>
            </div>
        </div>
        <div class="footer-bottom text-center">
            &copy; {{ date('Y') }} PikselPazar. Tüm hakları saklıdır.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
