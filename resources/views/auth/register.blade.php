@extends('layouts.app')

@section('title', 'Kayıt Ol')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Kayıt Ol</h3>
                        <p class="text-muted small">Yeni hesap oluşturun</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ad Soyad</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Adınız Soyadınız" autofocus>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">E-posta</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="ornek@mail.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Telefon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="05xx xxx xx xx">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Şifre</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="En az 6 karakter">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Şifre Tekrar</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Şifreyi tekrar girin">
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold rounded-pill">
                            Kayıt Ol
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <small class="text-muted">Zaten hesabınız var mı?
                            <a href="{{ route('login') }}" class="text-danger fw-semibold">Giriş Yap</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
