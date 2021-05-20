@extends('layouts.app')

@section('title', 'Invoice Detail')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ $user->profile_photo_url }}" class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total Transaction</div>
                                    <div class="profile-widget-item-value">{{ $user->orders->count() }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Success Transaction</div>
                                    <div class="profile-widget-item-value">{{ $user->orders->where('paid_at', '<>', null)->count() }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total $</div>
                                    <div class="profile-widget-item-value">{{ $user->orders->map(function($order) { return $order->total; })->sum() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ $user->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div>
                                {{ $user->email }}</div></div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A est expedita laboriosam, libero minus molestiae necessitatibus nisi non perspiciatis porro quam, rem tempore voluptas. Aliquid assumenda earum laboriosam soluta tenetur!
                        </div>
                        <x-transaction-table :user="$user"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
