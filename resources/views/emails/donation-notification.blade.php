<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Donation Received</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #164A25, #00AA55); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
        .donation-card { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 4px solid #00AA55; }
        .amount { font-size: 2em; color: #164A25; font-weight: bold; }
        .label { font-weight: bold; color: #164A25; }
        .footer { text-align: center; margin-top: 20px; padding: 20px; color: #666; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 New Donation Received!</h1>
            <p>ENVED Foundation</p>
        </div>
        
        <div class="content">
            <div class="donation-card">
                <div class="amount">₹{{ number_format($donation->amount, 2) }}</div>
                <p>We have received a new donation from a generous supporter.</p>
                
                <h3>Donor Information:</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="label" style="padding: 8px 0;">Name:</td>
                        <td style="padding: 8px 0;">{{ $donation->name }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="padding: 8px 0;">Email:</td>
                        <td style="padding: 8px 0;">{{ $donation->email_id }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="padding: 8px 0;">Phone:</td>
                        <td style="padding: 8px 0;">{{ $donation->phonenumber }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="padding: 8px 0;">Address:</td>
                        <td style="padding: 8px 0;">{{ $donation->address }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="padding: 8px 0;">Order ID:</td>
                        <td style="padding: 8px 0;">{{ $donation->id }}</td>
                    </tr>
                    @if($transaction)
                    <tr>
                        <td class="label" style="padding: 8px 0;">Transaction ID:</td>
                        <td style="padding: 8px 0;">{{ $transaction->transaction_code }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="label" style="padding: 8px 0;">Date & Time:</td>
                        <td style="padding: 8px 0;">{{ $donation->created_at->format('F j, Y \a\t g:i A') }}</td>
                    </tr>
                </table>
                
                @if($donation->message)
                <h3>Donor's Message:</h3>
                <p style="background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 3px solid #164A25;">
                    "{{ $donation->message }}"
                </p>
                @endif
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ url('/admin/donations') }}" style="background: #164A25; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    View in Admin Panel
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>This is an automated notification from ENVED Foundation Donation System.</p>
            <p>© {{ date('Y') }} ENVED Foundation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>