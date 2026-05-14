<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Scrap Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow mt-5">
                    
                    <!-- Header -->
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h1 class="h3 mb-0">New Scrap Request</h1>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">
                        
                        <!-- Full Name -->
                        <div class="mb-4 pb-3 border-bottom">
                            <small class="text-uppercase text-muted fw-bold">Full Name</small>
                            <p class="mb-0 fs-5">{{ $scrapRequest->full_name }}</p>
                        </div>

                        <!-- Phone -->
                        <div class="mb-4 pb-3 border-bottom">
                            <small class="text-uppercase text-muted fw-bold">Phone Number</small>
                            <p class="mb-0 fs-5">{{ $scrapRequest->phone }}</p>
                        </div>

                        <!-- Email -->
                        @if($scrapRequest->email)
                        <div class="mb-4 pb-3 border-bottom">
                            <small class="text-uppercase text-muted fw-bold">Email</small>
                            <p class="mb-0 fs-5">{{ $scrapRequest->email }}</p>
                        </div>
                        @endif

                        <!-- Location -->
                        <div class="mb-4 pb-3 border-bottom">
                            <small class="text-uppercase text-muted fw-bold">Location</small>
                            <p class="mb-0 fs-5">{{ $scrapRequest->location }}</p>
                        </div>

                        <!-- Scrap Types -->
                        <div class="mb-4 pb-3 border-bottom">
                            <small class="text-uppercase text-muted fw-bold">Scrap Types</small>
                            <div class="mt-2">
                                @foreach(json_decode($scrapRequest->scrap_type) as $scrap)
                                    <span class="badge bg-primary me-1 mb-1 p-2">{{ $scrap }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Details -->
                        @if($scrapRequest->details)
                        <div class="mb-4 pb-3 border-bottom">
                            <small class="text-uppercase text-muted fw-bold">Additional Details</small>
                            <p class="mb-0 fs-5">{{ $scrapRequest->details }}</p>
                        </div>
                        @endif

                        <!-- Submitted On -->
                        <div class="mb-4 pb-3 border-bottom">
                            <small class="text-uppercase text-muted fw-bold">Submitted On</small>
                            <p class="mb-0 fs-5">{{ $scrapRequest->created_at->format('F j, Y, g:i a') }}</p>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-center py-3 text-muted bg-light">
                        <p class="mb-1 small">This is an automated message from Vanguard Scrap Management System.</p>
                        <p class="mb-0 small">© {{ date('Y') }} Vanguard. All rights reserved.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>