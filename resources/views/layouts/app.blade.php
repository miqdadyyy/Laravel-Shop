@extends('layouts.skeleton')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/iziToast.min.css') }}">
@endpush

@section('app')
    <div class="main-wrapper container">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('partials.top-nav')
        </nav>
        <nav class="navbar navbar-secondary navbar-expand-lg">
            @include('partials.secondary-nav')
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('partials.footer')
        </footer>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/modules/iziToast.min.js') }}"></script>
    <script>
        Livewire.on('show-error', (msg) => {
            iziToast.error({
                title: 'Error!',
                message: msg,
                position: 'topCenter'
            });
        });

        Livewire.on('show-success', (msg) => {
            iziToast.success({
                title: 'Success!',
                message: msg,
                position: 'topCenter'
            });
        });

        Livewire.on('show-warning', (msg) => {
            iziToast.warning({
                title: 'Warning!',
                message: msg,
                position: 'topCenter'
            });
        });

        Livewire.on('show-info', (msg) => {
            iziToast.info({
                title: 'Info!',
                message: msg,
                position: 'topCenter'
            });
        });
    </script>
@endpush
