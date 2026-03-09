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
        <div class="stat-value">{{ $proyekAktif ?? 1 }}</div>
        <div class="stat-desc">Sedang dikerjakan</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:4px;"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Rata-rata Progress
        </div>
        <div class="stat-value">{{ $rataProgress ?? 38 }}%</div>
        <div class="stat-desc">Dari semua proyek</div>
    </div>
</div>

{{-- DAFTAR PROYEK AKTIF --}}
<div class="section-card">
    <div class="section-title">
        <svg width="20" height="20" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Daftar Proyek Aktif
    </div>

    @forelse($daftarProyek ?? [] as $item)
    <div class="project-item">
        <div class="project-header">
            <div class="project-id-row">
                <span class="project-id">{{ $item->kode }}</span>
                @if($item->status === 'Dalam Produksi')
                    <span class="badge badge-blue">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Dalam Produksi
                    </span>
                @elseif($item->status === 'Menunggu Approval')
                    <span class="badge badge-yellow">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Menunggu Approval
                    </span>
                @endif
            </div>
            <a href="{{ route('tracking.detail', $item->id) }}" class="btn-detail">
                Lihat Detail
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        <div class="project-type">{{ $item->jenis_parfum }} • {{ $item->target_pasar }}</div>
        <div style="font-size:12px;font-weight:600;color:#5b21b6;margin-bottom:12px;">Tahap Saat Ini: {{ $item->tahap_saat_ini }}</div>
        <div class="project-meta" style="grid-template-columns: 1fr 1fr 1fr;">
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
                <div class="meta-value">{{ \Carbon\Carbon::parse($item->estimasi_selesai)->format('d M Y') }}</div>
            </div>
        </div>
        <div class="progress-wrap">
            <div class="progress-header">
                <span class="progress-label">Progress Produksi</span>
                <span class="progress-pct">{{ $item->progress }}%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $item->progress }}%"></div>
            </div>
        </div>
    </div>
    @empty
    {{-- Demo data --}}
    <div class="project-item">
        <div class="project-header">
            <div class="project-id-row">
                <span class="project-id">MKL-2024-001</span>
                <span class="badge badge-blue">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Dalam Produksi
                </span>
            </div>
            <a href="{{ route('tracking.detail', 1) }}" class="btn-detail">
                Lihat Detail
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        <div class="project-type">Eau de Parfum • Premium</div>
        <div style="font-size:12px;font-weight:600;color:#5b21b6;margin-bottom:12px;">Tahap Saat Ini: Packaging</div>
        <div class="project-meta" style="grid-template-columns: 1fr 1fr 1fr;">
            <div>
                <div class="meta-label">Jumlah Produksi</div>
                <div class="meta-value">1,000 unit</div>
            </div>
            <div>
                <div class="meta-label">Tanggal Pengajuan</div>
                <div class="meta-value">15 Jan 2024</div>
            </div>
            <div>
                <div class="meta-label">Estimasi Selesai</div>
                <div class="meta-value">15 Mar 2024</div>
            </div>
        </div>
        <div class="progress-wrap">
            <div class="progress-header">
                <span class="progress-label">Progress Produksi</span>
                <span class="progress-pct">65%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 65%"></div>
            </div>
        </div>
    </div>

    <div class="project-item">
        <div class="project-header">
            <div class="project-id-row">
                <span class="project-id">MKL-2024-002</span>
                <span class="badge badge-yellow">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Menunggu Approval
                </span>
            </div>
            <a href="{{ route('tracking.detail', 2) }}" class="btn-detail">
                Lihat Detail
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        <div class="project-type">Eau de Toilette • Mass Market</div>
        <div style="font-size:12px;font-weight:600;color:#5b21b6;margin-bottom:12px;">Tahap Saat Ini: Review Formulasi</div>
        <div class="project-meta" style="grid-template-columns: 1fr 1fr 1fr;">
            <div>
                <div class="meta-label">Jumlah Produksi</div>
                <div class="meta-value">5,000 unit</div>
            </div>
            <div>
                <div class="meta-label">Tanggal Pengajuan</div>
                <div class="meta-value">1 Feb 2024</div>
            </div>
            <div>
                <div class="meta-label">Estimasi Selesai</div>
                <div class="meta-value">1 Apr 2024</div>
            </div>
        </div>
        <div class="progress-wrap">
            <div class="progress-header">
                <span class="progress-label">Progress Produksi</span>
                <span class="progress-pct">10%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 10%"></div>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
