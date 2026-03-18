@extends('layouts.sidebar_user')
@section('title', 'Detail Tracking - ' . $proyek->kode)

@push('styles')
<style>
    .back-btn { display:inline-flex;align-items:center;gap:6px;color:var(--text-secondary);font-size:13px;font-weight:600;text-decoration:none;padding:8px 12px;border-radius:8px;border:1px solid var(--border);background:#fff;margin-bottom:16px;transition:all .2s; }
    .back-btn:hover { background:#f5f4fb; }
    .info-bar { background:#fff;border:1.5px solid #ede9fe;border-radius:12px;padding:20px 28px;display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px; }
    @media(max-width:640px){ .info-bar { grid-template-columns:1fr 1fr; } }
    .ib-label { font-size:11px;color:var(--text-secondary);margin-bottom:4px; }
    .ib-value { font-size:15px;font-weight:700;color:var(--text-primary); }
    .ib-value.purple { color:#5b21b6; }
    .overall-card { background:#fff;border:1px solid var(--border);border-radius:16px;padding:28px;margin-bottom:24px; }
    .timeline { position:relative;padding-left:32px; }
    .tl-item { position:relative;margin-bottom:28px; }
    .tl-item:last-child { margin-bottom:0; }
    .tl-dot { position:absolute;left:-32px;top:2px;width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#f3f4f6;border:2px solid #d1d5db; }
    .tl-dot.done   { background:#dcfce7;border-color:#16a34a; }
    .tl-dot.active { background:#dbeafe;border-color:#3b82f6; }
    .tl-line { position:absolute;left:-21px;top:26px;width:2px;height:calc(100% + 4px);background:#e5e7eb; }
    .tl-item.done .tl-line { background:#bbf7d0; }
    .tl-header { display:flex;justify-content:space-between;align-items:flex-start;gap:12px; }
    .tl-name  { font-size:15px;font-weight:700;margin-bottom:2px; }
    .tl-date  { font-size:12px;color:var(--text-secondary);margin-bottom:4px; }
    .tl-desc  { font-size:13px;color:var(--text-secondary); }
    .tl-badge { font-size:12px;font-weight:600;padding:3px 10px;border-radius:20px;white-space:nowrap; }
    .ts-done    { background:var(--status-green-bg);color:var(--status-green); }
    .ts-active  { background:var(--status-blue-bg);color:var(--status-blue); }
    .ts-pending { color:var(--text-secondary); }
    .note-item { background:#f5f3ff;border-left:3px solid #7c3aed;border-radius:0 8px 8px 0;padding:14px 16px;margin-bottom:12px; }
    .note-date { font-size:11px;color:#7c3aed;font-weight:600;margin-bottom:4px; }
    .note-text { font-size:13.5px;color:var(--text-primary); }
    .delivery-card { background:linear-gradient(135deg,#3b1f6b 60%,#5b21b6);border-radius:16px;padding:24px 28px;display:flex;align-items:center;gap:20px;color:#fff;margin-top:24px; }
    .delivery-icon { background:rgba(255,255,255,.15);border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
    .delivery-label { font-size:14px;opacity:.85;margin-bottom:4px; }
    .delivery-date  { font-size:22px;font-weight:800; }
    .delivery-sub   { font-size:12px;opacity:.7;margin-top:4px; }
</style>
@endpush

@section('content')
<a href="{{ route('tracking.index') }}" class="back-btn">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Kembali ke Tracking
</a>

<h1 class="page-title" style="margin-bottom:4px;">Detail Produksi</h1>
<p class="page-subtitle">Progress produksi {{ $proyek->kode }}</p>

{{-- INFO BAR --}}
<div class="info-bar">
    <div>
        <div class="ib-label">ID Proyek</div>
        <div class="ib-value purple">{{ $proyek->kode }}</div>
    </div>
    <div>
        <div class="ib-label">Jenis Parfum</div>
        <div class="ib-value">{{ $proyek->jenis_parfum }}</div>
    </div>
    <div>
        <div class="ib-label">Jumlah Produksi</div>
        <div class="ib-value">{{ number_format($proyek->jumlah_produksi) }} unit</div>
    </div>
    <div>
        <div class="ib-label">Estimasi Selesai</div>
        <div class="ib-value">
            {{ $proyek->estimasi_selesai
                ? \Carbon\Carbon::parse($proyek->estimasi_selesai)->isoFormat('D MMMM Y')
                : 'Menunggu konfirmasi' }}
        </div>
    </div>
</div>

{{-- OVERALL PROGRESS --}}
<div class="overall-card">
    <div style="font-size:17px;font-weight:700;margin-bottom:14px;">Progress Keseluruhan</div>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
        <span style="font-size:13px;color:var(--text-secondary);">{{ $tahapSelesai }} dari {{ $totalTahap }} tahap selesai</span>
        <span style="font-size:20px;font-weight:800;">{{ $progress }}%</span>
    </div>
    <div class="progress-bar" style="height:12px;">
        <div class="progress-fill"
             style="width:{{ $progress }}%;height:100%;{{ $progress >= 100 ? 'background:#16a34a' : 'background:#1e1b4b' }};border-radius:99px;">
        </div>
    </div>
    @if($progress >= 100)
        <p style="font-size:12px;color:#16a34a;font-weight:600;margin-top:8px;">✓ Semua tahap produksi telah selesai</p>
    @endif
</div>

{{-- TIMELINE --}}
<div class="section-card">
    <div class="section-title">
        <svg width="20" height="20" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Timeline Produksi
    </div>

    <div class="timeline">
        @foreach($timeline as $i => $tahap)
        @php
            $isDone   = ($tahap['status'] ?? '') === 'done';
            $isActive = ($tahap['status'] ?? '') === 'active';
            $isLast   = $i === count($timeline) - 1;
        @endphp
        <div class="tl-item {{ $isDone ? 'done' : '' }}">
            <div class="tl-dot {{ $isDone ? 'done' : ($isActive ? 'active' : '') }}">
                @if($isDone)
                    <svg width="12" height="12" fill="none" stroke="#16a34a" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                @elseif($isActive)
                    <svg width="10" height="10" fill="#3b82f6" viewBox="0 0 24 24"><circle cx="12" cy="12" r="6"/></svg>
                @else
                    <svg width="12" height="12" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/></svg>
                @endif
            </div>
            @if(!$isLast)<div class="tl-line"></div>@endif
            <div class="tl-header">
                <div>
                    <div class="tl-name">{{ $tahap['name'] }}</div>
                    <div class="tl-date">{{ $tahap['date'] }}</div>
                    <div class="tl-desc">{{ $tahap['desc'] }}</div>
                </div>
                <div>
                    @if($isDone)
                        <span class="tl-badge ts-done">Selesai</span>
                    @elseif($isActive)
                        <span class="tl-badge ts-active">Sedang Proses</span>
                    @else
                        <span class="tl-badge ts-pending">Menunggu</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- CATATAN --}}
@if($catatan->count())
<div class="section-card">
    <div class="section-title">
        <svg width="18" height="18" fill="none" stroke="#5b21b6" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Catatan dari Tim Produksi
    </div>
    @foreach($catatan as $note)
    <div class="note-item">
        <div class="note-date">{{ \Carbon\Carbon::parse($note->tanggal)->isoFormat('D MMMM Y') }}</div>
        <div class="note-text">{{ $note->isi }}</div>
    </div>
    @endforeach
</div>
@endif

{{-- ESTIMASI PENGIRIMAN --}}
<div class="delivery-card">
    <div class="delivery-icon">
        <svg width="26" height="26" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
    </div>
    <div>
        <div class="delivery-label">Estimasi Pengiriman</div>
        <div class="delivery-date">
            {{ $proyek->estimasi_selesai
                ? \Carbon\Carbon::parse($proyek->estimasi_selesai)->isoFormat('D MMMM Y')
                : 'Menunggu persetujuan admin' }}
        </div>
        <div class="delivery-sub">Produk dikirim setelah semua tahap produksi selesai</div>
    </div>
</div>
@endsection
