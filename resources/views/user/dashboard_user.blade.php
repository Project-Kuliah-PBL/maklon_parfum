@extends('layouts.sidebar_user')

@section('title', 'Dashboard Klien')

@section('content')
<h1 class="page-title">Dashboard Klien</h1>
<p class="page-subtitle">Pantau status pengajuan maklon dan riwayat proyek Anda</p>

{{-- STAT CARDS --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">Total Pengajuan Aktif</div>
        <div class="stat-value">{{ $totalAktif ?? 2 }}</div>
        <div class="stat-desc">Dalam proses</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Proyek Selesai</div>
        <div class="stat-value">{{ $totalSelesai ?? 3 }}</div>
        <div class="stat-desc">Total proyek</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Produksi</div>
        <div class="stat-value">{{ number_format($totalProduksi ?? 11500) }}</div>
        <div class="stat-desc">Unit parfum</div>
    </div>
</div>

{{-- STATUS PENGAJUAN MAKLON --}}
<div class="section-card">
    <div class="section-title">
        <svg width="20" height="20" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Status Pengajuan Maklon
    </div>

    @forelse($pengajuanAktif ?? [] as $item)
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
                @else
                    <span class="badge badge-green">{{ $item->status }}</span>
                @endif
            </div>
            <a href="{{ route('tracking.detail', $item->id) }}" class="btn-detail">
                Lihat Detail
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        <div class="project-type">{{ $item->jenis_parfum }} • Target: {{ $item->target_pasar }}</div>
        <div class="project-meta">
            <div>
                <div class="meta-label">Jumlah Produksi</div>
                <div class="meta-value">{{ number_format($item->jumlah_produksi) }} unit</div>
            </div>
            <div>
                <div class="meta-label">Tanggal Pengajuan</div>
                <div class="meta-value">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->isoFormat('D MMMM Y') }}</div>
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
    <div style="text-align:center;padding:48px 0;">
        <div style="width:56px;height:56px;background:#f5f3ff;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
            <svg width="26" height="26" fill="none" stroke="#a78bfa" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <p style="font-weight:700;font-size:15px;color:#1e1b4b;margin-bottom:6px;">Belum Ada Pengajuan Aktif</p>
        <p style="font-size:13px;color:#9ca3af;margin-bottom:20px;">Mulai pengajuan maklon pertama Anda sekarang.</p>
        <a href="{{ route('pemesanan.pengajuan') }}"
           style="background:#3b1f6b;color:#fff;padding:10px 24px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;display:inline-block;">
            + Buat Pengajuan Baru
        </a>
    </div>
    @endforelse
</div>

{{-- RIWAYAT PROYEK --}}
<div class="section-card">
    <div class="section-title">
        <svg width="20" height="20" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
        Riwayat Proyek
    </div>

    <table class="history-table">
        <thead>
            <tr>
                <th>ID Proyek</th>
                <th>Jenis Parfum</th>
                <th>Jumlah Produksi</th>
                <th>Status</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayatProyek ?? [] as $proyek)
            <tr>
                <td>{{ $proyek->id_proyek }}</td>
                <td>{{ $proyek->jenis_parfum }}</td>
                <td>{{ number_format($proyek->jumlah_produksi) }} unit</td>
                <td><span class="badge badge-green">✓ Selesai</span></td>
                <td>{{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->isoFormat('D MMMM Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:36px;color:#9ca3af;font-size:13px;">
                    Belum ada riwayat proyek yang selesai.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection