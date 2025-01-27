<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Show all transactions for the logged-in user.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch transactions for the logged-in user
        $transactions = Transaction::where('user_id', $user->id)->get();

        return view('pages.transactions', compact('transactions'));
    }
}
