@extends('layouts.sidebar_user')

@section('title', 'Detail Tracking - ' . ($proyek->kode ?? 'MKL-2024-001'))

@push('styles')
<style>
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-secondary);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: #fff;
        margin-bottom: 16px;
        transition: all 0.2s;
    }
    .back-btn:hover { background: #f5f4fb; }

    .info-bar {
        background: #fff;
        border: 1.5px solid #ede9fe;
        border-radius: 12px;
        padding: 20px 28px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .info-bar-item .ib-label {
        font-size: 11px;
        color: var(--text-secondary);
        margin-bottom: 4px;
    }

    .info-bar-item .ib-value {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .info-bar-item .ib-value.purple { color: #5b21b6; }

    .overall-progress-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 24px;
    }

    .overall-title {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .overall-sub {
        font-size: 13px;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }

    .overall-pct {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-primary);
        float: right;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 32px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 28px;
    }

    .timeline-item:last-child { margin-bottom: 0; }

    .timeline-dot {
        position: absolute;
        left: -32px;
        top: 2px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        border: 2px solid #d1d5db;
    }

    .timeline-dot.done { background: #dcfce7; border-color: #16a34a; }
    .timeline-dot.active { background: #dbeafe; border-color: #3b82f6; }

    .timeline-line {
        position: absolute;
        left: -21px;
        top: 26px;
        width: 2px;
        height: calc(100% + 4px);
        background: #e5e7eb;
    }

    .timeline-item.done .timeline-line { background: #bbf7d0; }

    .timeline-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .timeline-name {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .timeline-date {
        font-size: 12px;
        color: var(--text-secondary);
        margin-bottom: 6px;
    }

    .timeline-desc {
        font-size: 13px;
        color: var(--text-secondary);
    }

    .timeline-status {
        font-size: 12px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .ts-selesai { background: var(--status-green-bg); color: var(--status-green); }
    .ts-proses { background: var(--status-blue-bg); color: var(--status-blue); }
    .ts-menunggu { color: var(--text-secondary); }

    /* Notes */
    .note-item {
        background: #f5f3ff;
        border-left: 3px solid #7c3aed;
        border-radius: 0 8px 8px 0;
        padding: 14px 16px;
        margin-bottom: 12px;
    }

    .note-date {
        font-size: 11px;
        color: #7c3aed;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .note-text {
        font-size: 13.5px;
        color: var(--text-primary);
    }

    /* Delivery card */
    .delivery-card {
        background: linear-gradient(135deg, #3b1f6b 60%, #5b21b6);
        border-radius: 16px;
        padding: 24px 28px;
        display: flex;
        align-items: center;
        gap: 20px;
        color: #fff;
        margin-top: 24px;
    }

    .delivery-icon {
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .delivery-label { font-size: 14px; opacity: 0.85; margin-bottom: 4px; }
    .delivery-date { font-size: 24px; font-weight: 800; }
    .delivery-sub { font-size: 12px; opacity: 0.7; margin-top: 4px; }
</style>
@endpush

@section('content')
<a href="{{ route('tracking.index') }}" class="back-btn">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Tracking Proses Maklon
</a>

<h1 class="page-title" style="margin-bottom:4px;">Tracking Proses Maklon</h1>
<p class="page-subtitle">Detail progress produksi {{ $proyek->kode ?? 'MKL-2024-001' }}</p>

{{-- INFO BAR --}}
<div class="info-bar">
    <div class="info-bar-item">
        <div class="ib-label">ID Proyek</div>
        <div class="ib-value purple">{{ $proyek->kode ?? 'MKL-2024-001' }}</div>
    </div>
    <div class="info-bar-item">
        <div class="ib-label">Jenis Parfum</div>
        <div class="ib-value">{{ $proyek->jenis_parfum ?? 'Eau de Parfum' }}</div>
    </div>
    <div class="info-bar-item">
        <div class="ib-label">Jumlah Produksi</div>
        <div class="ib-value">{{ number_format($proyek->jumlah_produksi ?? 1000) }} unit</div>
    </div>
    <div class="info-bar-item">
        <div class="ib-label">Estimasi Selesai</div>
        <div class="ib-value">{{ isset($proyek->estimasi_selesai) ? \Carbon\Carbon::parse($proyek->estimasi_selesai)->format('d F Y') : '15 Maret 2024' }}</div>
    </div>
</div>

{{-- OVERALL PROGRESS --}}
<div class="overall-progress-card">
    <div class="overall-title">Progress Keseluruhan</div>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
        <span class="overall-sub">{{ $tahapSelesai ?? 3 }} dari {{ $totalTahap ?? 7 }} tahap selesai</span>
        <span class="overall-pct">{{ $progress ?? 43 }}%</span>
    </div>
    <div class="progress-bar" style="height:12px;">
        <div class="progress-fill" style="width: {{ $progress ?? 43 }}%; background: #1e1b4b;"></div>
    </div>
</div>

{{-- TIMELINE --}}
<div class="section-card">
    <div class="section-title">
        <svg width="20" height="20" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Timeline Produksi
    </div>

    <div class="timeline">
        @php
        $defaultTimeline = [
            ['name'=>'Pengajuan Diterima','date'=>'15 Januari 2024','desc'=>'Pengajuan maklon telah diterima dan diverifikasi','status'=>'done'],
            ['name'=>'Pembuatan Formula','date'=>'20 Januari 2024','desc'=>'Formula parfum telah dibuat dan disetujui','status'=>'done'],
            ['name'=>'Produksi Batch Pertama','date'=>'1 Februari 2024','desc'=>'Produksi batch pertama telah selesai (500 unit)','status'=>'done'],
            ['name'=>'Produksi Batch Kedua','date'=>'20 Februari 2024','desc'=>'Sedang dalam proses produksi (500 unit)','status'=>'active'],
            ['name'=>'Quality Control','date'=>'1 Maret 2024','desc'=>'Pemeriksaan kualitas produk','status'=>'pending'],
            ['name'=>'Pengemasan','date'=>'8 Maret 2024','desc'=>'Pengemasan produk dengan desain yang telah disetujui','status'=>'pending'],
            ['name'=>'Pengiriman','date'=>'15 Maret 2024','desc'=>'Pengiriman produk ke lokasi klien','status'=>'pending'],
        ];
        $timeline = $timeline ?? $defaultTimeline;
        @endphp

        @foreach($timeline as $i => $tahap)
        @php
            $isDone = ($tahap['status'] ?? '') === 'done' || ($tahap['status'] ?? '') === 'Selesai';
            $isActive = ($tahap['status'] ?? '') === 'active' || ($tahap['status'] ?? '') === 'Sedang Proses';
            $isLast = $i === count($timeline) - 1;
        @endphp
        <div class="timeline-item {{ $isDone ? 'done' : '' }}">
            <div class="timeline-dot {{ $isDone ? 'done' : ($isActive ? 'active' : '') }}">
                @if($isDone)
                    <svg width="13" height="13" fill="none" stroke="#16a34a" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                @elseif($isActive)
                    <svg width="13" height="13" fill="none" stroke="#3b82f6" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" fill="#3b82f6"/></svg>
                @else
                    <svg width="13" height="13" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                @endif
            </div>
            @if(!$isLast)
            <div class="timeline-line"></div>
            @endif
            <div class="timeline-header">
                <div>
                    <div class="timeline-name">{{ $tahap['name'] ?? $tahap->nama ?? '' }}</div>
                    <div class="timeline-date">{{ $tahap['date'] ?? (isset($tahap->tanggal) ? \Carbon\Carbon::parse($tahap->tanggal)->isoFormat('D MMMM Y') : '') }}</div>
                    <div class="timeline-desc">{{ $tahap['desc'] ?? $tahap->deskripsi ?? '' }}</div>
                </div>
                <div>
                    @if($isDone)
                        <span class="timeline-status ts-selesai">Selesai</span>
                    @elseif($isActive)
                        <span class="timeline-status ts-proses">Sedang Proses</span>
                    @else
                        <span class="timeline-status ts-menunggu">Menunggu</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- CATATAN & UPDATE --}}
<div class="section-card">
    <div class="section-title">
        <svg width="18" height="18" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Catatan & Update
    </div>

    @forelse($catatan ?? [] as $note)
    <div class="note-item">
        <div class="note-date">{{ \Carbon\Carbon::parse($note->tanggal)->isoFormat('D MMMM Y') }}</div>
        <div class="note-text">{{ $note->isi }}</div>
    </div>
    @empty
    <div class="note-item">
        <div class="note-date">15 Februari 2024</div>
        <div class="note-text">Batch pertama telah lulus quality control dengan hasil sangat baik</div>
    </div>
    <div class="note-item">
        <div class="note-date">18 Februari 2024</div>
        <div class="note-text">Sample batch pertama telah dikirim ke klien untuk approval</div>
    </div>
    @endforelse
</div>

{{-- ESTIMASI PENGIRIMAN --}}
<div class="delivery-card">
    <div class="delivery-icon">
        <svg width="26" height="26" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
    </div>
    <div>
        <div class="delivery-label">Estimasi Pengiriman</div>
        <div class="delivery-date">{{ isset($proyek->estimasi_selesai) ? \Carbon\Carbon::parse($proyek->estimasi_selesai)->format('d F Y') : '15 Maret 2024' }}</div>
        <div class="delivery-sub">Produk akan dikirim setelah semua tahap selesai</div>
    </div>
</div>
@endsection
