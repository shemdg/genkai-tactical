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
                        <td style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 32px; font-weight: bold;">PAYMENT VERIFIED!</h1>
                            <p style="color: #d1fae5; margin: 10px 0 0 0; font-size: 16px;">✓ Your order is confirmed</p>
                        </td>
                    </tr>

                    <!-- Success Banner -->
                    <tr>
                        <td style="background-color: #d1fae5; padding: 30px; text-align: center;">
                            <div style="font-size: 60px; margin-bottom: 10px;">🎉</div>
                            <h2 style="color: #065f46; margin: 0; font-size: 28px;">Great News!</h2>
                            <p style="color: #047857; margin: 10px 0 0 0; font-size: 16px;">Your GCash payment has been successfully verified.</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #6b7280; margin: 0 0 20px 0; font-size: 16px;">Hi <strong>{{ $order->customer_name }}</strong>,</p>
                            <p style="color: #6b7280; margin: 0 0 30px 0; font-size: 16px;">
                                We've successfully verified your GCash payment for Order #<strong>{{ $order->order_number }}</strong>. Your order is now being prepared for shipment!
                            </p>

                            <!-- Payment Details -->
                            <div style="background-color: #f9fafb; border-radius: 8px; padding: 25px; margin-bottom: 30px; border: 2px solid #10b981;">
                                <table width="100%" cellpadding="8" cellspacing="0">
                                    <tr>
                                        <td style="color: #6b7280; font-size: 14px;">Order Number:</td>
                                        <td style="text-align: right; color: #1f2937; font-weight: bold;">{{ $order->order_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #6b7280; font-size: 14px;">Payment Method:</td>
                                        <td style="text-align: right; color: #1f2937; font-weight: bold;">GCash</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #6b7280; font-size: 14px;">Reference Number:</td>
                                        <td style="text-align: right; color: #1f2937; font-weight: bold; font-family: 'Courier New', monospace;">{{ $order->payment_reference }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #6b7280; font-size: 14px;">Amount Paid:</td>
                                        <td style="text-align: right; color: #ef4444; font-weight: bold; font-size: 18px;">₱{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #6b7280; font-size: 14px;">Verified At:</td>
                                        <td style="text-align: right; color: #1f2937; font-weight: bold;">{{ $order->payment_verified_at->format('F d, Y h:i A') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- What's Next -->
                            <div style="background-color: #eff6ff; border-left: 4px solid #3b82f6; border-radius: 4px; padding: 20px; margin-bottom: 30px;">
                                <h3 style="color: #1e40af; margin: 0 0 10px 0; font-size: 18px;">📦 What's Next?</h3>
                                <ol style="color: #1e40af; margin: 10px 0 0 20px; padding: 0;">
                                    <li style="margin-bottom: 8px;">Your order is now being prepared for shipment</li>
                                    <li style="margin-bottom: 8px;">We'll notify you once it's on the way</li>
                                    <li>Track your order status via email updates</li>
                                </ol>
                            </div>

                            <p style="color: #6b7280; margin: 0; font-size: 16px; text-align: center;">
                                Thank you for shopping with <strong>Genkai Tactical</strong>! 🔪
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="color: #6b7280; margin: 0 0 10px 0; font-size: 14px;">Questions? Contact us at {{ $order->customer_email }}</p>
                            <p style="color: #9ca3af; margin: 0; font-size: 12px;">© {{ date('Y') }} Genkai Tactical. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>