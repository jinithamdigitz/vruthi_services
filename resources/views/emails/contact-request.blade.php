<!DOCTYPE html>
<html>
<head>
    <title>New Contact Request</title>
</head>
<body>
    <h2>New Contact Request Received</h2>
    
    <p><strong>Name:</strong> {{ $contactRequest->name }}</p>
    <p><strong>Email:</strong> {{ $contactRequest->email }}</p>
    <p><strong>Subject:</strong> {{ $contactRequest->subject }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactRequest->message }}</p>
    <p><strong>Received:</strong> {{ $contactRequest->created_at->timezone('Asia/Kolkata')->format('F j, Y, g:i a') }} (IST)</p>
</body>
</html>