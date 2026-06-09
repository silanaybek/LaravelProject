@extends('layouts.admin')
@section('title', 'Ayarlar')
@section('page-title', 'Site Ayarları')
@section('breadcrumb', 'Ayarlar')

@section('content')
<div class="row">
    <div class="col-md-8">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            <div class="card">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-globe mr-2"></i>Genel Bilgiler</h5></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Site Adı</label>
                        <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'PikselPazar' }}">
                    </div>
                    <div class="form-group">
                        <label>Site Açıklaması</label>
                        <textarea name="site_description" class="form-control" rows="3">{{ $settings['site_description'] ?? '' }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>E-posta</label>
                                <input type="email" name="site_email" class="form-control" value="{{ $settings['site_email'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefon</label>
                                <input type="text" name="site_phone" class="form-control" value="{{ $settings['site_phone'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Adres</label>
                        <textarea name="site_address" class="form-control" rows="2">{{ $settings['site_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-share-alt mr-2"></i>Sosyal Medya</h5></div>
                <div class="card-body">
                    <div class="form-group">
                        <label><i class="fab fa-facebook text-primary mr-1"></i>Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-instagram text-danger mr-1"></i>Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-twitter text-info mr-1"></i>Twitter / X</label>
                        <input type="text" name="twitter" class="form-control" value="{{ $settings['twitter'] ?? '' }}" placeholder="https://twitter.com/...">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-save mr-1"></i>Kaydet</button>
        </form>
    </div>
</div>
@endsection
