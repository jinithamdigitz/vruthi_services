<!DOCTYPE html>
<html>

<body>
    <h2>Thank You, {{ $donation->name }}!</h2>
    <p>We truly appreciate your donation of ₹{{ $donation->amount }}.</p>
    <p>A PDF receipt is attached with this email.</p>
    <p>Warm regards,<br>ENVED Team</p>
</body>

</html>