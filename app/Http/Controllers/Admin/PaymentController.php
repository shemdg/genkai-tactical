<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Jobs\SendPaymentVerifiedEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentVerified;

class PaymentController extends Controller
{
    public function index()
    {
        $pendingPayments = Order::where('payment_status', 'pending')
            ->where('payment_method', '!=', 'cod')
            ->with('orderItems')
            ->latest()
            ->paginate(20);

        return view('admin.payments.index', [
            'orders' => $pendingPayments,
        ]);
    }

    public function verify(Order $order)
    {
        $order->update([
            'payment_status' => 'verified',
            'payment_verified_at' => now(),
        ]);

        // Dispatch email job (runs in background!)
        SendPaymentVerifiedEmail::dispatch($order);

        return redirect()->back()->with('success', 'Payment verified successfully!');
    }

    public function reject(Order $order)
    {
        $order->update([
            'payment_status' => 'failed',
        ]);

        return redirect()->back()->with('success', 'Payment rejected.');
    }
}
