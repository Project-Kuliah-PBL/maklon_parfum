@extends('layouts.sidebar_user')
@section('title', 'Pengaturan Akun')

@push('styles')
<style>
    .profile-header-card { background:linear-gradient(135deg,#f5f3ff 0%,#ede9fe 100%);border:1.5px solid #ddd6fe;border-radius:16px;padding:28px 32px;display:flex;align-items:center;gap:20px;margin-bottom:24px; }
    .profile-avatar-lg { width:70px;height:70px;border-radius:50%;background:var(--sidebar-bg);color:#fff;font-size:22px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
    .profile-name  { font-size:20px;font-weight:800;margin-bottom:4px; }
    .profile-email { font-size:14px;color:var(--text-secondary);margin-bottom:10px; }
    .badge-role    { background:var(--sidebar-bg);color:#fff;font-size:12px;font-weight:600;padding:4px 14px;border-radius:20px;display:inline-block; }
    .tabs     { display:flex;background:#f3f4f6;border-radius:10px;padding:4px;margin-bottom:24px;width:fit-content; }
    .tab-btn  { padding:9px 28px;border-radius:8px;border:none;background:transparent;font-family:inherit;font-size:14px;font-weight:600;color:var(--text-secondary);cursor:pointer;transition:all .2s;text-decoration:none; }
    .tab-btn.active { background:#fff;color:var(--text-primary);box-shadow:0 1px 4px rgba(0,0,0,.08); }
    .form-card  { background:#fff;border:1px solid var(--border);border-radius:16px;padding:28px 32px; }
    .form-section-title { font-size:16px;font-weight:700;display:flex;align-items:center;gap:8px;margin-bottom:24px; }
    .form-grid  { display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px; }
    .form-group { display:flex;flex-direction:column;gap:6px; }
    .form-group.full { grid-column:1/-1; }
    .form-label { font-size:13px;font-weight:600;color:var(--text-primary);display:flex;align-items:center;gap:6px; }
    .form-input { border:1.5px solid var(--border);border-radius:10px;padding:11px 14px;font-family:inherit;font-size:14px;color:var(--text-primary);background:#fafafa;transition:border-color .2s,box-shadow .2s;outline:none; }
    .form-input:focus { border-color:#7c3aed;box-shadow:0 0 0 3px rgba(124,58,237,.08);background:#fff; }
    .form-input[disabled] { background:#f3f4f6;color:var(--text-secondary);cursor:not-allowed; }
    textarea.form-input { resize:vertical;min-height:90px; }
    .form-hint  { font-size:11.5px;color:var(--text-secondary);margin-top:2px; }
    .btn-save   { background:var(--sidebar-bg);color:#fff;border:none;padding:11px 24px;border-radius:10px;font-family:inherit;font-size:14px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:opacity .2s; }
    .btn-save:hover { opacity:.88; }
    .form-footer { display:flex;justify-content:flex-end;margin-top:24px; }
    .req-box  { background:#f5f3ff;border:1.5px solid #ede9fe;border-radius:10px;padding:16px 18px;margin-top:20px; }
    .req-title { font-size:13px;font-weight:700;margin-bottom:8px; }
    .req-item  { font-size:13px;color:var(--text-secondary);margin-bottom:4px; }
    .req-item::before { content:'• ';color:#7c3aed;font-weight:700; }
    .tips-card { background:#fffbeb;border:1.5px solid #fde68a;border-radius:16px;padding:24px 28px;margin-top:20px; }
    .tips-title { font-size:15px;font-weight:700;margin-bottom:12px; }
    .tip-item  { font-size:13px;color:var(--text-secondary);margin-bottom:6px; }
    .tip-item::before { content:'• ';color:#d97706;font-weight:700; }
    .err-msg { color:#b91c1c;font-size:12px; }
    @media(max-width:640px){ .form-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
<h1 class="page-title">Pengaturan Akun</h1>
<p class="page-subtitle">Kelola informasi profil dan keamanan akun Anda</p>

{{-- PROFILE HEADER --}}
<div class="profile-header-card">
    <div class="profile-avatar-lg">
        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
    </div>
    <div>
        <div class="profile-name">{{ auth()->user()->name }}</div>
        <div class="profile-email">{{ auth()->user()->email }}</div>
        <span class="badge-role">Klien Aktif</span>
    </div>
</div>

{{-- TABS --}}
@php $tab = request('tab', 'profil'); @endphp
<div class="tabs">
    <a href="{{ route('account.settings', ['tab'=>'profil']) }}"   class="tab-btn {{ $tab==='profil'   ? 'active' : '' }}">Profil</a>
    <a href="{{ route('account.settings', ['tab'=>'keamanan']) }}" class="tab-btn {{ $tab==='keamanan' ? 'active' : '' }}">Keamanan</a>
</div>

{{-- ─── TAB PROFIL ─── --}}
@if($tab === 'profil')
<div class="form-card">
    <div class="form-section-title">
        <svg width="18" height="18" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        Informasi Profil
    </div>

    <form action="{{ route('account.update-profile') }}" method="POST">
        @csrf @method('PUT')
        <div class="form-grid">

            {{-- Nama --}}
            <div class="form-group">
                <label class="form-label">Nama Pemilik Brand <span style="color:#b91c1c">*</span></label>
                <input type="text" name="name" class="form-input"
                       value="{{ old('name', auth()->user()->name) }}">
                @error('name')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label">Email <span style="color:#b91c1c">*</span></label>
                <input type="email" name="email" class="form-input"
                       value="{{ old('email', auth()->user()->email) }}">
                @error('email')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            {{-- Nama Brand --}}
            <div class="form-group">
                <label class="form-label">Nama Brand</label>
                <input type="text" name="nama_brand" class="form-input"
                       placeholder="Nama brand produk Anda"
                       value="{{ old('nama_brand', auth()->user()->nama_brand) }}">
                @error('nama_brand')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            {{-- No Telp — kolom DB: no_telp --}}
            <div class="form-group">
                <label class="form-label">Nomor HP</label>
                <input type="tel" name="no_telp" class="form-input"
                       placeholder="08xxxxxxxxxx"
                       value="{{ old('no_telp', auth()->user()->no_telp) }}">
                @error('no_telp')<span class="err-msg">{{ $message }}</span>@enderror
            </div>

            {{-- Username (read-only) --}}
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-input" value="{{ auth()->user()->username }}" disabled>
                <span class="form-hint">Username tidak dapat diubah</span>
            </div>

            {{-- Role --}}
            <div class="form-group">
                <label class="form-label">Jenis Akun</label>
                <input type="text" class="form-input" value="Customer" disabled>
                <span class="form-hint">Hubungi admin untuk mengubah</span>
            </div>

        </div>
        <div class="form-footer">
            <button type="submit" class="btn-save">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endif

{{-- ─── TAB KEAMANAN ─── --}}
@if($tab === 'keamanan')
<div class="form-card">
    <div class="form-section-title">
        <svg width="18" height="18" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Keamanan Akun
    </div>

    <form action="{{ route('account.update-password') }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group" style="margin-bottom:16px;">
            <label class="form-label">Password Saat Ini <span style="color:#b91c1c">*</span></label>
            <input type="password" name="current_password" class="form-input" placeholder="Masukkan password saat ini">
            @error('current_password')<span class="err-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group" style="margin-bottom:16px;">
            <label class="form-label">Password Baru <span style="color:#b91c1c">*</span></label>
            <input type="password" name="password" class="form-input" placeholder="Minimal 8 karakter">
            @error('password')<span class="err-msg">{{ $message }}</span>@enderror
        </div>

        <div class="form-group" style="margin-bottom:4px;">
            <label class="form-label">Konfirmasi Password Baru <span style="color:#b91c1c">*</span></label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password baru">
        </div>

        <div class="req-box">
            <div class="req-title">Persyaratan Password:</div>
            <div class="req-item">Minimal 8 karakter</div>
            <div class="req-item">Kombinasi huruf dan angka disarankan</div>
            <div class="req-item">Gunakan karakter spesial untuk keamanan lebih</div>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn-save">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Update Password
            </button>
        </div>
    </form>
</div>

<div class="tips-card">
    <div class="tips-title">Tips Keamanan Akun</div>
    <div class="tip-item">Jangan bagikan password kepada siapapun</div>
    <div class="tip-item">Gunakan password yang unik dan kuat</div>
    <div class="tip-item">Ubah password secara berkala</div>
    <div class="tip-item">Logout setelah menggunakan perangkat publik</div>
</div>
@endif

@endsection
    