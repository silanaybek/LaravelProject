@extends('layouts.admin')

@section('title', 'Kategoriler')
@section('page-title', 'Kategoriler')
@section('breadcrumb', 'Kategoriler')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tüm Kategoriler</h5>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Yeni Kategori
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th><th>Resim</th><th>Ad</th><th>Ürün Sayısı</th><th>Durum</th><th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" width="45" height="45" style="object-fit:cover; border-radius:6px;">
                        @else
                            <div style="width:45px;height:45px;background:#eee;border-radius:6px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
                        @endif
                    </td>
                    <td><strong>{{ $category->name }}</strong><br><small class="text-muted">{{ $category->slug }}</small></td>
                    <td>{{ $category->products_count ?? 0 }}</td>
                    <td>
                        @if($category->status)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-secondary">Pasif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-xs btn-warning mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Henüz kategori eklenmemiş.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="card-footer">{{ $categories->links() }}</div>
    @endif
</div>
@endsection
