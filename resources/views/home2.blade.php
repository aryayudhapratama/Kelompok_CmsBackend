@extends('layouts.home')

@section('content')

<!-- Hero Section -->
@include('partials.hero')

@include('partials.informasi')

<!-- Layanan Informasi -->
@include('partials.layanan')

<!-- Galeri Berita -->
@include('partials.galeri')

@include('partials.kabar')

<!-- Background Footer Gambar -->
<section class="bg-building-pic d-table w-100" style="background: url('https://ppid-demo.jatimprov.go.id/assets/images/building.png') bottom no-repeat;"></section>

@endsection
