@extends('layouts.admin')

@section('title', 'Kategori Düzenle')
@section('page-title', 'Kategori Düzenle')
@section('breadcrumb', 'Düzenle')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Kategori Bilgileri</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Kategori Adı <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Resim</label>
                        @if($category->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$category->image) }}" height="80" style="border-radius:6px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control-file" accept="image/*">
                        <small class="text-muted">Değiştirmek istemiyorsanız boş bırakın.</small>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ $category->status ? 'checked' : '' }}>
                            <label class="custom-control-label" for="status">Aktif</label>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save mr-1"></i>Güncelle</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
