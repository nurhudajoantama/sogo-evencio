<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with([
            'user',
            'product',
            'service',
            'payment',
            'status'
        ])->orderBy('updated_at', 'desc')->paginate(10);
        return view('dashboard.transactions.index', compact('transactions'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:transaction_statuses,id'
        ]);
        $transaction = Transaction::find($id);
        $transaction->update([
            'status_id' => $request->status_id
        ]);

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }
}
