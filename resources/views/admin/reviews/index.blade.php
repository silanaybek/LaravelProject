@extends('layouts.admin')
@section('title', 'Yorumlar')
@section('page-title', 'Ürün Yorumları')
@section('breadcrumb', 'Yorumlar')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Tüm Yorumlar ({{ $reviews->total() }})</h5></div>
    <div class="card-body p-0">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th><th>Ürün</th><th>Kullanıcı</th><th>Puan</th><th>Yorum</th><th>Tarih</th><th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>
                        <a href="{{ route('products.show', $review->product->slug) }}" target="_blank" class="text-decoration-none">
                            {{ $review->product->name }}
                        </a>
                    </td>
                    <td>{{ $review->user->name }}</td>
                    <td>
                        @for($s=1;$s<=5;$s++)
                            <i class="fas fa-star" style="color:{{ $s<=$review->rating ? '#ffc107' : '#ddd' }};font-size:.8rem;"></i>
                        @endfor
                        <span class="ml-1 text-muted small">{{ $review->rating }}/5</span>
                    </td>
                    <td><span class="text-muted">{{ Str::limit($review->comment, 60) }}</span></td>
                    <td><small class="text-muted">{{ $review->created_at->format('d.m.Y') }}</small></td>
                    <td>
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" onsubmit="return confirm('Silinsin mi?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Henüz yorum yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($reviews->hasPages())
    <div class="card-footer">{{ $reviews->links() }}</div>
    @endif
</div>
@endsection
