@extends('layouts.admin')

@section('title', 'Kullanıcılar')
@section('page-title', 'Kullanıcılar')
@section('breadcrumb', 'Kullanıcılar')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Kayıtlı Kullanıcılar</h5></div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr><th>#</th><th>Ad Soyad</th><th>E-posta</th><th>Telefon</th><th>Kayıt Tarihi</th><th>İşlem</th></tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '-' }}</td>
                    <td>{{ $user->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs btn-info mr-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Kullanıcıyı silmek istediğinize emin misiniz?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Kullanıcı bulunamadı.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="card-footer">{{ $users->links() }}</div>
    @endif
</div>
@endsection
