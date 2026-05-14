{{-- resources/views/emails/contact-submitted.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    
    <p><strong>Name:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Phone:</strong> {{ $contact->phone ?? 'Not provided' }}</p>
    <p><strong>Subject:</strong> {{ $contact->subject }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contact->message }}</p>
    
    <hr>
    <p>Submitted on: {{ $contact->created_at->format('F j, Y \a\t g:i A') }}</p>
</body>
</html>