<x-app-layout>
    <div class="container">
        <h2>Your Transactions</h2>

        @if($transactions->isEmpty())
            <p>You have no transactions yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Expiration Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_id }}</td>
                            <td>{{ $transaction->amount }} EUR</td>
                            <td>{{ $transaction->payment_method }}</td>
                            <td>{{ ucfirst($transaction->status) }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->expiration_date)->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
