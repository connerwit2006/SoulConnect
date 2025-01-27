<x-app-layout>
    <div class="container">
        <h2>Make a Payment</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('payment.process') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Amount (EUR)</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="1" value="10" readonly required>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select id="payment_method" name="payment_method" class="form-select" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
</x-app-layout>
