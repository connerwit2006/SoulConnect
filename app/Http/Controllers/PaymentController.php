<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Show the payment page.
     */
    public function showPaymentPage()
    {
        return view('pages.payment'); // Payment form
    }

    /**
     * Handle the transaction.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $user = Auth::user();

        $latestTransaction = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Check if there is a previous transaction and if it's expired
        if ($latestTransaction && Carbon::parse($latestTransaction->expiration_date)->isFuture()) {
            return redirect()->back()->with('error', 'You can only make a new payment after the previous one has expired.');
        }


        // Set fixed payment amount of 10 euros
        $amount = 10;

        // Calculate the expiration date (current day, increment the month by 1)
        $expirationDate = Carbon::now()->addMonth(); // Adds 1 month to the current date

        // Simulate a transaction ID (in a real app, use a payment gateway)
        $transactionId = 'TXN-' . strtoupper(uniqid());

        // Save transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'expiration_date' => $expirationDate,
        ]);

        // Process the payment here (e.g., integrate with a payment gateway)

        // Simulate payment success
        $transaction->update([
            'status' => 'completed',
            'processed_at' => now(),
        ]);

        // Redirect the user to the transactions page after successful payment
        return redirect()->route('transactions.index')->with('success', 'Payment successful!');
    }
}
