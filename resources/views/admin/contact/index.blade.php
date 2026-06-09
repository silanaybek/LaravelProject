@extends('layouts.admin')
@section('title', 'İletişim Mesajları')
@section('page-title', 'İletişim Mesajları')
@section('breadcrumb', 'İletişim Mesajları')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Gelen Mesajlar ({{ $messages->total() }})</h5></div>
    <div class="card-body p-0">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Ad Soyad</th><th>E-posta</th><th>Mesaj</th><th>Tarih</th><th></th></tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td>{{ $msg->id }}</td>
                    <td>{{ $msg->name }}</td>
                    <td><a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a></td>
                    <td><span class="text-muted">{{ Str::limit($msg->message, 80) }}</span></td>
                    <td><small class="text-muted">{{ $msg->created_at->format('d.m.Y H:i') }}</small></td>
                    <td>
                        <form method="POST" action="{{ route('admin.contact.destroy', $msg) }}" onsubmit="return confirm('Silinsin mi?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Henüz mesaj yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="card-footer">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
