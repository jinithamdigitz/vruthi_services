<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Your Donation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #164A25, #00AA55); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
        .thankyou-card { background: white; padding: 25px; margin: 20px 0; border-radius: 8px; text-align: center; border: 2px solid #e8f5e8; }
        .amount { font-size: 2.5em; color: #164A25; font-weight: bold; margin: 10px 0; }
        .impact-stats { display: flex; justify-content: space-around; margin: 25px 0; }
        .stat { text-align: center; padding: 15px; }
        .stat-number { font-size: 1.5em; color: #164A25; font-weight: bold; }
        .footer { text-align: center; margin-top: 30px; padding: 20px; color: #666; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🙏 Thank You, {{ $donation->name }}!</h1>
            <p>Your generosity makes a difference</p>
        </div>
        
        <div class="content">
            <div class="thankyou-card">
                <h2>Your Donation of</h2>
                <div class="amount">₹{{ number_format($donation->amount, 2) }}</div>
                <p>has been successfully received and will be used to support our environmental sustainability initiatives.</p>
                
                <div style="background: #e8f5e8; padding: 15px; border-radius: 8px; margin: 20px 0;">
                    <h3>Donation Details</h3>
                    <p><strong>Order ID:</strong> {{ $donation->id }}</p>
                    @if($transaction)
                    <p><strong>Transaction ID:</strong> {{ $transaction->transaction_code }}</p>
                    @endif
                    <p><strong>Date:</strong> {{ $donation->created_at->format('F j, Y') }}</p>
                </div>
            </div>
            
            <div class="impact-stats">
                <div class="stat">
                    <div class="stat-number">🌱</div>
                    <div>Environmental Projects</div>
                </div>
                <div class="stat">
                    <div class="stat-number">🌳</div>
                    <div>Tree Plantation</div>
                </div>
                <div class="stat">
                    <div class="stat-number">💚</div>
                    <div>Sustainability</div>
                </div>
            </div>
            
           
            
            <div style="text-align: center; margin-top: 30px;">
                <p>We will keep you updated on the impact of your donation through our newsletter.</p>
            </div>
        </div>
        
        <div class="footer">
            <p>With heartfelt gratitude,</p>
            <p><strong>The ENVED Foundation Team</strong></p>
            <p>Email: {{ env('OFFICIAL_EMAIL', 'ngo@envedfoundation.org') }} | 
               Phone: {{ env('CONTACT_PHONE', '+91-9846066620') }}</p>
            <p>© {{ date('Y') }} ENVED Foundation. Empowering Action for Environment & Sustainability.</p>
        </div>
    </div>
</body>
</html>