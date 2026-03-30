@extends('layouts.sidebar_user')
@section('title', 'Tracking Proses Maklon')

@section('content')
<h1 class="page-title">Tracking Proses Maklon</h1>
<p class="page-subtitle">Pantau progress dan timeline produksi maklon Anda</p>

{{-- STAT CARDS --}}
<div class="stat-grid" style="grid-template-columns: 1fr 1fr;">
    <div class="stat-card">
        <div class="stat-label">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:4px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Proyek Dalam Produksi
        </div>
        <div class="stat-value">{{ $proyekAktif }}</div>
        <div class="stat-desc">Sedang dikerjakan</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:4px;"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Rata-rata Progress
        </div>
        <div class="stat-value">{{ $rataProgress }}%</div>
        <div class="stat-desc">Dari semua proyek aktif</div>
    </div>
</div>

{{-- DAFTAR PROYEK --}}
<div class="section-card">
    <div class="section-title">
        <svg width="20" height="20" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Semua Proyek Maklon
    </div>

    @forelse($daftarProyek as $item)
    <div class="project-item">
        <div class="project-header">
            <div class="project-id-row">
                <span class="project-id">{{ $item->kode }}</span>
                @if($item->status === 'Dalam Produksi')
                    <span class="badge badge-blue">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Dalam Produksi
                    </span>
                @elseif($item->status === 'Menunggu Approval')
                    <span class="badge badge-yellow">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Menunggu Approval
                    </span>
                @elseif($item->status === 'Selesai')
                    <span class="badge badge-green">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        Selesai
                    </span>
                @elseif($item->status === 'Ditolak')
                    <span class="badge" style="background:#fee2e2;color:#dc2626;">✕ Ditolak</span>
                @endif
            </div>
            <a href="{{ route('tracking.detail', $item->id) }}" class="btn-detail">
                Lihat Detail
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <div class="project-type">{{ $item->jenis_parfum }} • {{ $item->target_pasar }}</div>

        <div style="font-size:12px;font-weight:600;color:#5b21b6;margin-bottom:12px;">
            Tahap Saat Ini: {{ $item->tahap_saat_ini }}
        </div>

        <div class="project-meta" style="grid-template-columns:1fr 1fr 1fr;">
            <div>
                <div class="meta-label">Jumlah Produksi</div>
                <div class="meta-value">{{ number_format($item->jumlah_produksi) }} unit</div>
            </div>
            <div>
                <div class="meta-label">Tanggal Pengajuan</div>
                <div class="meta-value">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</div>
            </div>
            <div>
                <div class="meta-label">Estimasi Selesai</div>
                <div class="meta-value">
                    {{ $item->estimasi_selesai
                        ? \Carbon\Carbon::parse($item->estimasi_selesai)->format('d M Y')
                        : 'Menunggu konfirmasi' }}
                </div>
            </div>
        </div>

        @if($item->status !== 'Menunggu Approval')
        <div class="progress-wrap">
            <div class="progress-header">
                <span class="progress-label">Progress Produksi</span>
                <span class="progress-pct">{{ $item->progress }}%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill"
                     style="width:{{ $item->progress }}%;{{ $item->status === 'Selesai' ? 'background:#16a34a' : '' }}">
                </div>
            </div>
        </div>
        @endif
    </div>
    @empty
    {{-- Empty state --}}
    <div style="text-align:center;padding:56px 0;">
        <div style="width:64px;height:64px;background:#f5f3ff;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <svg width="28" height="28" fill="none" stroke="#a78bfa" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <p style="font-weight:700;font-size:16px;color:#1e1b4b;margin-bottom:8px;">Belum Ada Proyek</p>
        <p style="font-size:13px;color:#9ca3af;margin-bottom:20px;">Anda belum memiliki proyek maklon. Mulai pengajuan sekarang!</p>
        <a href="{{ route('pemesanan.pengajuan') }}"
           style="background:#3b1f6b;color:#fff;padding:10px 24px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;display:inline-block;">
            + Buat Pengajuan Baru
        </a>
    </div>
    @endforelse
</div>
@endsection
