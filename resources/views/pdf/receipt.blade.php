<!DOCTYPE html>
<html>

<body>
    <h2>Donation Receipt</h2>
    <p><strong>Name:</strong> {{ $donation->name }}</p>
    <p><strong>Amount:</strong> ₹{{ $donation->amount }}</p>
    <p><strong>Date:</strong> {{ $donation->created_at->format('d M Y') }}</p>
    <p>Thank you for supporting our mission!</p>
</body>

</html>