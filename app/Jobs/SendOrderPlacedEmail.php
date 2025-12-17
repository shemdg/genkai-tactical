<?php

namespace App\Jobs;

use App\Mail\OrderPlaced;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderPlacedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->order->customer_email)->send(new OrderPlaced($this->order));
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        // Log the error
        logger()->error('Failed to send order placed email for Order #' . $this->order->order_number, [
            'error' => $exception->getMessage(),
            'order_id' => $this->order->id,
        ]);
    }
}
