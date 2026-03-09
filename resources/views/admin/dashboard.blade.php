@extends('layouts.admin')

@section('title', 'Arum Jaya Dashboard')
@section('page-title', 'Admin Dashboard Overview')
@section('page-subtitle', 'Ringkasan operasional manufaktur parfum hari ini.')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($stats as $stat)
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="{{ $stat['bg'] }} {{ $stat['color'] }} p-2 rounded-lg">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-bold {{ $stat['type'] === 'positive' ? 'text-emerald-500' : 'text-slate-400' }}">
                    {{ $stat['trend'] }}
                </span>
            </div>
            <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">{{ $stat['label'] }}</p>
            <h3 class="text-2xl font-bold mt-1">{{ $stat['value'] }}</h3>
        </div>
        @endforeach
    </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 flex justify-between items-center border-b border-slate-50">
                <h3 class="font-bold text-slate-800">Aktivitas Terbaru</h3>
                <a href="#" class="text-brand-purple text-sm font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-50">
                            <th class="px-6 py-4">ID PROYEK</th>
                            <th class="px-6 py-4">KLIEN</th>
                            <th class="px-6 py-4">JENIS</th>
                            <th class="px-6 py-4">STATUS</th>
                            <th class="px-6 py-4 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($activities as $act)
                        <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">

                        <td class="px-6 py-4 font-medium">
                        MKL-{{ $act->id }}
                        </td>

                        <td class="px-6 py-4">
                        <div class="flex items-center gap-3">

                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                        {{ substr($act->user->name,0,2) }}
                        </div>

                        <span class="font-medium text-slate-800">
                        {{ $act->user->name }}
                        </span>

                        </div>
                        </td>

                        <td class="px-6 py-4">
                        {{ $act->jenis_parfum }}
                        </td>

                        <td class="px-6 py-4">

                        <span class="px-3 py-1 rounded-lg text-[10px] font-bold
                        @if($act->status == 'pending')
                        bg-orange-100 text-orange-600
                        @elseif($act->status == 'proses')
                        bg-blue-100 text-blue-600
                        @elseif($act->status == 'selesai')
                        bg-green-100 text-green-600
                        @else
                        bg-red-100 text-red-600
                        @endif
                        ">

                        {{ strtoupper($act->status) }}

                        </span>

                        </td>

                        <td class="px-6 py-4 text-right">
                        <button class="text-slate-400 hover:text-brand-purple">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                        </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection