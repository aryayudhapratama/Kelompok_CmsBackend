@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="text-gray-500 text-sm font-semibold mb-2">Total Admin</div>
            <div class="text-2xl font-bold mb-1">{{ $totalAdmin }}</div>
            <div class="text-blue-500 text-xs font-semibold flex items-center gap-1">
                <i class="fas fa-user-shield"></i> Admin
            </div>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="text-gray-500 text-sm font-semibold mb-2">Total Redaktur</div>
            <div class="text-2xl font-bold mb-1">{{ $totalRedaktur }}</div>
            <div class="text-green-500 text-xs font-semibold flex items-center gap-1">
                <i class="fas fa-user-edit"></i> Redaktur
            </div>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="text-gray-500 text-sm font-semibold mb-2">Total Reporter</div>
            <div class="text-2xl font-bold mb-1">{{ $totalReporter }}</div>
            <div class="text-yellow-500 text-xs font-semibold flex items-center gap-1">
                <i class="fas fa-user-pen"></i> Reporter
            </div>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start">
            <div class="text-gray-500 text-sm font-semibold mb-2">Total File Manager</div>
            <div class="text-2xl font-bold mb-1">{{ $totalFile }}</div>
            <div class="text-indigo-500 text-xs font-semibold flex items-center gap-1">
                <i class="fas fa-folder-open"></i> File
            </div>
        </div>
    </div>
@endsection