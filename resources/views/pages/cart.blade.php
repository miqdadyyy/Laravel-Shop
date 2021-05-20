@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Your Cart</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Here is your cart items</h2>

            <div class="row">
                <div class="col-8">
                    <livewire:cart-item/>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment Method</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aut consequatur dolorem
                                magnam natus neque praesentium quod, sequi tenetur! Alias deserunt dolore error facilis
                                fugiat, maiores quas quisquam repellat voluptatum!
                            </p>

                        </div>
                        <div class="card-footer">
                            @if(Auth::guest())
                                <p>Please login first before checkout</p>
                                <a class="btn btn-primary w-100" href="{{ route('login') }}">Login</a>
                            @else
                                <form action="{{ route('cart.checkout') }}" method="post">
                                    @csrf
                                    <input type="hidden" id="payment-id" name="payment_id">
                                    <div class="form-group">
                                        <label>Select Payment</label>
                                        <select class="form-control" name="payment" id="payment-method">
                                            <option value="stripe">Stripe</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="stripe-method">
                                        <label for="card-holder-name">Card Holder Name</label>
                                        <input id="card-holder-name" type="text" class="form-control mb-4">

                                        <!-- Stripe Elements Placeholder -->
                                        <div id="card-element"></div>

                                        <button id="card-button" class="btn btn-success w-100 mt-3" type="button">
                                            Process Payment
                                        </button>
                                    </div>
                                    <button type="submit" id="checkout-btn" class="btn w-100 btn-success">Checkout</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function(){
            $('#payment-method').change(function(){
                $('#stripe-method').hide();
                $('#checkout-btn').hide();
                if($(this).val() === 'stripe') {
                    $('#stripe-method').show();
                } else if($(this).val() === 'paypal') {
                    $('#checkout-btn').show();
                }
            }).change();
        })
    </script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: { name: cardHolderName.value }
                }
            );

            if (error) {
                iziToast.error({
                    title: 'Payment Error',
                    message: error.message,
                    position: 'topCenter'
                });
            } else {
                $('#payment-id').val(paymentMethod.id);
                $('#checkout-btn').click();
                // The card has been verified successfully...
            }
        });
    </script>
@endpush
