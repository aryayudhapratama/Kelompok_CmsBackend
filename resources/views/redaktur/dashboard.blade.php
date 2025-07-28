@extends('layouts.redaktur')

@section('title', 'Redaktur - Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
  <div class="bg-white p-5 rounded-xl shadow border-l-4 border-green-500 hover:scale-[1.02] hover:shadow-md transition duration-200 cursor-pointer">
    <div class="flex justify-between items-center">
      <div>
        <p class="text-2xl font-semibold text-gray-800">1</p>
        <p class="text-sm text-gray-500">Approved</p>
      </div>
      <i class="fas fa-user-check text-green-500 text-3xl"></i>
    </div>
  </div>

  <div class="bg-white p-5 rounded-xl shadow border-l-4 border-yellow-400 hover:scale-[1.02] hover:shadow-md transition duration-200 cursor-pointer">
    <div class="flex justify-between items-center">
      <div>
        <p class="text-2xl font-semibold text-gray-800">0</p>
        <p class="text-sm text-gray-500">Waiting</p>
      </div>
      <i class="fas fa-user-clock text-yellow-400 text-3xl"></i>
    </div>
  </div>

  <div class="bg-white p-5 rounded-xl shadow border-l-4 border-red-500 hover:scale-[1.02] hover:shadow-md transition duration-200 cursor-pointer">
    <div class="flex justify-between items-center">
      <div>
        <p class="text-2xl font-semibold text-gray-800">0</p>
        <p class="text-sm text-gray-500">Reject</p>
      </div>
      <i class="fas fa-user-times text-red-500 text-3xl"></i>
    </div>
  </div>

  <div class="bg-white p-5 rounded-xl shadow border-l-4 border-blue-500">
    <div class="flex justify-between items-center">
      <div>
        <p class="text-sm text-gray-500">User Guide</p>
        <a href="#" class="text-sm text-blue-600 font-medium hover:underline">Download</a>
      </div>
      <i class="fas fa-file-pdf text-blue-600 text-3xl"></i>
    </div>
  </div>
</div>

<!-- Search Bar -->
<div class="bg-white p-5 rounded-xl shadow">
  <input type="text" placeholder="What letter would you want to create today?"
    class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-400 bg-blue-50 placeholder-blue-500" />
</div>
@endsection
