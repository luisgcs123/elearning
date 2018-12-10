<form action="{{ route('subscriptions.process_subscription') }}" method="POST" id="payment-form">
    @csrf
    <input
        class="form-control"
        name="coupon"
        id="coupon"
        placeholder="{{ __("¿Tienes cupón?") }}"
        />
    <input type="hidden" name="type" value="monthly" />
    <input type="hidden" name="plan" value="prod_E6hryoMpFIgd0j"/>
    <hr/>
    <stripe-form
        stripe_key="{{ env('STRIPE_KEY') }}"
        name="{{ $product['name'] }}"
        amount="{{ $product['amount'] }}"
        description="{{ $product['description'] }}"
        ></stripe-form>
</form>
