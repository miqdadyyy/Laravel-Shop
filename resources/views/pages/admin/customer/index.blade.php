@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Customer</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">This is Example Page</h2>
            <p class="section-lead">This page is just an example for you to create your own page.</p>
            <x-customer-table/>
        </div>
    </section>
@endsection
