@extends('layouts.admin')
@section('title', 'SSS')
@section('page-title', 'Sık Sorulan Sorular')
@section('breadcrumb', 'SSS')

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Yeni SSS Ekle</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.faqs.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Soru <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question') }}" placeholder="Soru yazın...">
                        @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Cevap <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" rows="4" placeholder="Cevap yazın...">{{ old('answer') }}</textarea>
                        @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Sıra</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked>
                        <label class="custom-control-label" for="status">Aktif</label>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Kaydet</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">SSS Listesi</h5></div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>#</th><th>Soru</th><th>Durum</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                        <tr>
                            <td>{{ $faq->order }}</td>
                            <td>
                                <strong>{{ Str::limit($faq->question, 50) }}</strong>
                                <div class="text-muted small">{{ Str::limit($faq->answer, 60) }}</div>
                            </td>
                            <td>
                                <span class="badge badge-{{ $faq->status ? 'success' : 'secondary' }}">{{ $faq->status ? 'Aktif' : 'Pasif' }}</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editFaq{{ $faq->id }}"><i class="fas fa-edit"></i></button>
                                <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" class="d-inline" onsubmit="return confirm('Silinsin mi?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editFaq{{ $faq->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"><h5 class="modal-title">SSS Düzenle</h5><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></div>
                                    <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
                                        @csrf @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Soru</label>
                                                <input type="text" name="question" class="form-control" value="{{ $faq->question }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Cevap</label>
                                                <textarea name="answer" class="form-control" rows="4">{{ $faq->answer }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Sıra</label>
                                                <input type="number" name="order" class="form-control" value="{{ $faq->order }}">
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="editStatus{{ $faq->id }}" name="status" value="1" {{ $faq->status ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="editStatus{{ $faq->id }}">Aktif</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Henüz SSS eklenmedi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
