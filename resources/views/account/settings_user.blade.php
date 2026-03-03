@extends('layouts.sidebar_user')

@section('title', 'Pengaturan Akun')

@push('styles')
<style>
    .profile-header-card {
        background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);
        border: 1.5px solid #ddd6fe;
        border-radius: 16px;
        padding: 28px 32px;
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
    }

    .profile-avatar-lg {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: var(--sidebar-bg);
        color: #fff;
        font-size: 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .profile-name { font-size: 20px; font-weight: 800; margin-bottom: 4px; }
    .profile-email { font-size: 14px; color: var(--text-secondary); margin-bottom: 10px; }

    .badge-premium {
        background: var(--sidebar-bg);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 14px;
        border-radius: 20px;
        display: inline-block;
    }

    /* Tabs */
    .tabs {
        display: flex;
        background: #f3f4f6;
        border-radius: 10px;
        padding: 4px;
        margin-bottom: 24px;
        width: fit-content;
    }

    .tab-btn {
        padding: 9px 28px;
        border-radius: 8px;
        border: none;
        background: transparent;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .tab-btn.active {
        background: #fff;
        color: var(--text-primary);
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    }

    /* Form */
    .form-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px 32px;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group.full { grid-column: 1 / -1; }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-label svg { color: var(--text-secondary); }

    .form-input {
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 11px 14px;
        font-family: inherit;
        font-size: 14px;
        color: var(--text-primary);
        background: #fafafa;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }

    .form-input:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
        background: #fff;
    }

    .form-input[disabled] {
        background: #f3f4f6;
        color: var(--text-secondary);
        cursor: not-allowed;
    }

    textarea.form-input { resize: vertical; min-height: 100px; }

    .form-hint { font-size: 11.5px; color: var(--text-secondary); margin-top: 2px; }

    .btn-save {
        background: var(--sidebar-bg);
        color: #fff;
        border: none;
        padding: 11px 24px;
        border-radius: 10px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s;
    }

    .btn-save:hover { opacity: 0.88; }

    .form-footer { display: flex; justify-content: flex-end; margin-top: 24px; }

    /* Password requirements */
    .requirements-box {
        background: #f5f3ff;
        border: 1.5px solid #ede9fe;
        border-radius: 10px;
        padding: 16px 18px;
        margin-top: 20px;
    }

    .req-title { font-size: 13px; font-weight: 700; margin-bottom: 8px; }
    .req-item { font-size: 13px; color: var(--text-secondary); margin-bottom: 4px; }
    .req-item::before { content: '• '; color: #7c3aed; font-weight: 700; }

    /* Security tips */
    .tips-card {
        background: #fffbeb;
        border: 1.5px solid #fde68a;
        border-radius: 16px;
        padding: 24px 28px;
        margin-top: 20px;
    }

    .tips-title { font-size: 15px; font-weight: 700; margin-bottom: 12px; }
    .tip-item { font-size: 13px; color: var(--text-secondary); margin-bottom: 6px; }
    .tip-item::before { content: '• '; color: #d97706; font-weight: 700; }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<h1 class="page-title">Pengaturan Akun</h1>
<p class="page-subtitle">Kelola informasi profil dan keamanan akun Anda</p>

{{-- PROFILE HEADER --}}
<div class="profile-header-card">
    <div class="profile-avatar-lg">
        {{ strtoupper(substr(auth()->user()->name ?? 'Brand Parfum ABC', 0, 2)) }}
    </div>
    <div>
        <div class="profile-name">{{ auth()->user()->name ?? 'Brand Parfum ABC' }}</div>
        <div class="profile-email">{{ auth()->user()->email ?? 'brand@email.com' }}</div>
        <span class="badge-premium">Akun Premium</span>
    </div>
</div>

{{-- TABS --}}
@php $activeTab = request('tab', 'profil'); @endphp
<div class="tabs">
    <a href="{{ route('account.settings', ['tab' => 'profil']) }}" class="tab-btn {{ $activeTab === 'profil' ? 'active' : '' }}">Profil</a>
    <a href="{{ route('account.settings', ['tab' => 'keamanan']) }}" class="tab-btn {{ $activeTab === 'keamanan' ? 'active' : '' }}">Keamanan</a>
</div>

{{-- TAB: PROFIL --}}
@if($activeTab === 'profil')
<div class="form-card">
    <div class="form-section-title">
        <svg width="18" height="18" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        Informasi Profil
    </div>

    <form action="{{ route('account.update-profile') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M8 10h8M8 14h4"/></svg>
                    Nama Brand/Klien
                </label>
                <input type="text" name="name" class="form-input" value="{{ old('name', auth()->user()->name ?? 'Brand Parfum ABC') }}">
                @error('name') <span style="color:#b91c1c;font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Email
                </label>
                <input type="email" name="email" class="form-input" value="{{ old('email', auth()->user()->email ?? 'brand@email.com') }}">
                @error('email') <span style="color:#b91c1c;font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.39 18a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91A16 16 0 0 0 14 15.91l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    Nomor HP
                </label>
                <input type="tel" name="phone" class="form-input" value="{{ old('phone', auth()->user()->phone ?? '+62812345678910') }}">
                @error('phone') <span style="color:#b91c1c;font-size:12px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Jenis Akun</label>
                <input type="text" class="form-input" value="Premium" disabled>
                <span class="form-hint">Hubungi admin untuk mengubah jenis akun</span>
            </div>

            <div class="form-group full">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="address" class="form-input">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                @error('address') <span style="color:#b91c1c;font-size:12px;">{{ $message }}</span> @enderror
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

{{-- TAB: KEAMANAN --}}
@if($activeTab === 'keamanan')
<div class="form-card">
    <div class="form-section-title">
        <svg width="18" height="18" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Keamanan Akun
    </div>

    <form action="{{ route('account.update-password') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group" style="margin-bottom:16px;">
            <label class="form-label">Password Saat Ini</label>
            <input type="password" name="current_password" class="form-input" placeholder="Masukkan password saat ini">
            @error('current_password') <span style="color:#b91c1c;font-size:12px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-bottom:16px;">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-input" placeholder="Masukkan password baru (min. 8 karakter)">
            @error('password') <span style="color:#b91c1c;font-size:12px;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-bottom:16px;">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Konfirmasi password baru">
        </div>

        <div class="requirements-box">
            <div class="req-title">Persyaratan Password:</div>
            <div class="req-item">Minimal 8 karakter</div>
            <div class="req-item">Kombinasi huruf dan angka</div>
            <div class="req-item">Disarankan menggunakan karakter spesial</div>
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
    <div class="tip-item">Jangan bagikan password Anda kepada siapapun</div>
    <div class="tip-item">Gunakan password yang unik dan kuat</div>
    <div class="tip-item">Ubah password secara berkala</div>
    <div class="tip-item">Logout dari akun setelah menggunakan perangkat publik</div>
</div>
@endif

@endsection
