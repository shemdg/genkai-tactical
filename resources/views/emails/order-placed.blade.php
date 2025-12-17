<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1f2937 0%, #374151 100%); padding: 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 32px; font-weight: bold;">GENKAI TACTICAL</h1>
                            <p style="color: #d1d5db; margin: 10px 0 0 0; font-size: 14px;">Premium Tactical Knives</p>
                        </td>
                    </tr>

                    <!-- Success Icon -->
                    <tr>
                        <td style="padding: 40px 40px 20px 40px; text-align: center;">
                            <div style="width: 80px; height: 80px; background-color: #10b981; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                                <span style="color: white; font-size: 50px;">✓</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 0 40px 40px 40px;">
                            <h2 style="color: #1f2937; margin: 0 0 20px 0; font-size: 24px; text-align: center;">Order Confirmed!</h2>
                            <p style="color: #6b7280; margin: 0 0 10px 0; text-align: center;">Hi <strong>{{ $order->customer_name }}</strong>,</p>
                            <p style="color: #6b7280; margin: 0 0 30px 0; text-align: center;">Thank you for your order! We've received it and will process it shortly.</p>

                            <!-- Order Number -->
                            <div style="background-color: #f3f4f6; border-radius: 8px; padding: 20px; margin-bottom: 30px; text-align: center;">
                                <p style="color: #6b7280; margin: 0 0 5px 0; font-size: 14px;">Order Number</p>
                                <p style="color: #1f2937; margin: 0; font-size: 24px; font-weight: bold;">{{ $order->order_number }}</p>
                            </div>

                            <!-- Payment Status -->
                            @if($order->payment_method === 'gcash')
                                <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 4px; padding: 15px; margin-bottom: 30px;">
                                    <p style="margin: 0; color: #92400e; font-weight: bold;">⏳ Payment Pending Verification</p>
                                    <p style="margin: 10px 0 0 0; color: #92400e; font-size: 14px;">
                                        Reference: <strong>{{ $order->payment_reference }}</strong><br>
                                        We'll verify your GCash payment and send you another email once confirmed.
                                    </p>
                                </div>
                            @else
                                <div style="background-color: #dbeafe; border-left: 4px solid #3b82f6; border-radius: 4px; padding: 15px; margin-bottom: 30px;">
                                    <p style="margin: 0; color: #1e40af; font-weight: bold;">💵 Cash on Delivery</p>
                                    <p style="margin: 10px 0 0 0; color: #1e40af; font-size: 14px;">
                                        Please prepare <strong>₱{{ number_format($order->total, 2) }}</strong> when your order arrives.
                                    </p>
                                </div>
                            @endif

                            <!-- Order Items -->
                            <h3 style="color: #1f2937; margin: 0 0 15px 0; font-size: 18px;">Order Items</h3>
                            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse; margin-bottom: 20px;">
                                @foreach($order->orderItems as $item)
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="color: #374151; padding: 15px 0;">
                                            <strong>{{ $item->product_name }}</strong><br>
                                            <span style="color: #6b7280; font-size: 14px;">Qty: {{ $item->quantity }} × ₱{{ number_format($item->price, 2) }}</span>
                                        </td>
                                        <td style="text-align: right; color: #374151; font-weight: bold; padding: 15px 0;">
                                            ₱{{ number_format($item->price * $item->quantity, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="padding: 15px 0; color: #1f2937; font-weight: bold; font-size: 18px;">Total</td>
                                    <td style="text-align: right; padding: 15px 0; color: #ef4444; font-weight: bold; font-size: 18px;">
                                        ₱{{ number_format($order->total, 2) }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Delivery Info -->
                            <h3 style="color: #1f2937; margin: 0 0 15px 0; font-size: 18px;">Delivery Address</h3>
                            <p style="color: #6b7280; margin: 0; background-color: #f9fafb; padding: 15px; border-radius: 6px;">
                                {{ $order->customer_address }}
                            </p>

                            @if($order->notes)
                                <h3 style="color: #1f2937; margin: 30px 0 15px 0; font-size: 18px;">Order Notes</h3>
                                <p style="color: #6b7280; margin: 0; background-color: #f9fafb; padding: 15px; border-radius: 6px;">
                                    {{ $order->notes }}
                                </p>
                            @endif
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="color: #6b7280; margin: 0 0 10px 0; font-size: 14px;">Need help? Contact us at {{ $order->customer_email }}</p>
                            <p style="color: #9ca3af; margin: 0; font-size: 12px;">© {{ date('Y') }} Genkai Tactical. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>