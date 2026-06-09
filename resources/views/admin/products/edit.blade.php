@extends('layouts.admin')

@section('title', 'Ürün Düzenle')
@section('page-title', 'Ürün Düzenle')
@section('breadcrumb', 'Düzenle')

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Ürün Bilgileri</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Ürün Adı <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Seçiniz</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fiyat (₺) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" step="0.01" min="0">
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>İndirimli Fiyat (₺)</label>
                                <input type="number" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" min="0">
                                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="sizes-group" style="display:none;">
                        <label>Beden Seçenekleri</label>
                        <div>
                            @php $clothingSizes = ['XS','S','M','L','XL','XXL']; $shoeSizes = ['36','37','38','39','40','41','42','43','44']; $currentSizes = old('sizes', $product->sizes ?? []); @endphp
                            <p class="text-muted small mb-1">Giyim Bedenleri:</p>
                            @foreach($clothingSizes as $sz)
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="sz_{{ $sz }}" name="sizes[]" value="{{ $sz }}" {{ in_array($sz, $currentSizes) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="sz_{{ $sz }}">{{ $sz }}</label>
                            </div>
                            @endforeach
                            <div class="mt-2">
                                <p class="text-muted small mb-1">Ayakkabı Numaraları:</p>
                                @foreach($shoeSizes as $sz)
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="sz_shoe_{{ $sz }}" name="sizes[]" value="{{ $sz }}" {{ in_array($sz, $currentSizes) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="sz_shoe_{{ $sz }}">{{ $sz }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ürün Resmi</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$product->image) }}" height="100" style="border-radius:6px;" id="preview">
                            </div>
                        @else
                            <img id="preview" src="" style="display:none;max-height:120px;margin-top:10px;border-radius:6px;">
                        @endif
                        <input type="file" name="image" class="form-control-file" accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted">Değiştirmek istemiyorsanız boş bırakın.</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" class="custom-control-input" id="featured" name="featured" value="1" {{ $product->featured ? 'checked' : '' }}>
                                <label class="custom-control-label" for="featured">Öne Çıkan Ürün</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ $product->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save mr-1"></i>Güncelle</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('preview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var catSelect = document.querySelector('select[name="category_id"]');
    function toggleSizes() {
        var val = catSelect.value;
        document.getElementById('sizes-group').style.display = (val == 2) ? 'block' : 'none';
    }
    catSelect.addEventListener('change', toggleSizes);
    toggleSizes();
});
</script>
@endpush
