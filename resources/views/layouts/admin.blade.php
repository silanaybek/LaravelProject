<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - PikselPazar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brand-link { background: #1a1a2e; }
        .main-sidebar { background: #1a1a2e; }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active { background: #e94560; }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link:hover { background: #16213e; }
        .content-wrapper { background: #f4f6f9; }
        .card { border: none; box-shadow: 0 0 15px rgba(0,0,0,.07); border-radius: 10px; }
        .btn-primary { background: #e94560; border-color: #e94560; }
        .btn-primary:hover { background: #c73652; border-color: #c73652; }
        .badge-new { background:#6c757d; } .badge-accepted { background:#17a2b8; }
        .badge-onshipping { background:#007bff; } .badge-completed { background:#28a745; }
        .badge-cancelled { background:#dc3545; }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
        </ul>
        <form class="d-none d-md-flex ml-3" method="GET" action="{{ route('admin.products.index') }}" style="width:260px;">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Ürün, kategori ara..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ml-auto">
            @php $unreadMessages = \App\Models\ContactMessage::whereDate('created_at', '>=', now()->subDays(7))->count(); @endphp
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contact.index') }}" title="İletişim Mesajları">
                    <i class="fas fa-envelope"></i>
                    @if($unreadMessages > 0)
                    <span class="badge badge-danger navbar-badge">{{ $unreadMessages }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-circle fa-lg"></i> {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.settings.index') }}" class="dropdown-item"><i class="fas fa-cog mr-2"></i>Ayarlar</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Çıkış Yap</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
            <span class="brand-text font-weight-bold" style="color:#e94560; font-size:1.4rem;">Piksel<span style="color:#fff">Pazar</span></span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i><p>Anasayfa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i><p>Kategoriler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box-open"></i><p>Ürünler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i><p>Siparişler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reviews.index') }}" class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-star"></i><p>Yorumlar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i><p>Kullanıcılar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contact.index') }}" class="nav-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i><p>İletişim Mesajları</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-question-circle"></i><p>SSS</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i><p>Ayarlar</p>
                        </a>
                    </li>
                    <li class="nav-item mt-2" style="border-top:1px solid #2d2d4e;padding-top:8px;">
                        <a href="{{ route('home') }}" class="nav-link" target="_blank">
                            <i class="nav-icon fas fa-store"></i><p>Siteyi Görüntüle</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="font-size:1.3rem; font-weight:600;">@yield('page-title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="main-footer text-sm text-muted">
        <strong>PikselPazar</strong> Admin Panel &copy; {{ date('Y') }}
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html>
