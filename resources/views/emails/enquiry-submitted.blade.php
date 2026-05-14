<!DOCTYPE html>
<html>

<head>
    <title>New Enquiry - Solar Master</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
        }

        /* Main container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header with Blue Theme */
        .email-header {
            background: linear-gradient(135deg, #1a439c 0%, #1957ba 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .email-header p {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }

        /* Logo area */
        .logo {
            margin-bottom: 15px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        /* Content area */
        .email-content {
            padding: 30px;
            background-color: #ffffff;
        }

        /* Greeting */
        .greeting {
            margin-bottom: 25px;
        }

        .greeting h2 {
            color: #2563eb;
            margin: 0 0 10px 0;
            font-size: 22px;
        }

        /* Info cards */
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .info-row {
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 700;
            color: #2563eb;
            display: inline-block;
            min-width: 120px;
            font-size: 14px;
        }

        .info-value {
            color: #333;
            display: inline-block;
            font-size: 14px;
        }

        /* Message box */
        .message-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid #e0e0e0;
        }

        .message-box h3 {
            color: #2563eb;
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: 600;
        }

        .message-content {
            color: #555;
            line-height: 1.6;
            font-size: 14px;
        }

        /* Status badges */
        .badge {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }

        /* Divider */
        .divider {
            height: 2px;
            background: linear-gradient(to right, #3b82f6, #e0e0e0, #3b82f6);
            margin: 25px 0;
        }

        /* Button */
        .button {
            display: inline-block;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 25px;
            margin: 20px 0;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .button:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        /* Footer */
        .email-footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #e0e0e0;
        }

        .social-links {
            margin: 15px 0;
        }

        .social-links a {
            color: #3b82f6;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }

        /* Responsive */
        @media only screen and (max-width: 480px) {
            .email-content {
                padding: 20px;
            }

            .info-label {
                display: block;
                margin-bottom: 5px;
            }

            .info-value {
                display: block;
            }
        }

        hr {
            border: none;
            border-top: 2px solid #e0e0e0;
            margin: 20px 0;
        }
    </style>
</head>

<body
    style="margin: 0; padding: 20px; background-color: #f5f5f5; font-family: 'Segoe UI', Arial, Helvetica, sans-serif;">
    <div class="email-container">

        <!-- Header with Blue Theme -->
        <div class="email-header">
            <div class="logo">
                <h1 style="margin: 0; font-size: 32px;">Solar Master</h1>
            </div>
            <h1>New Enquiry Received</h1>
            <p>Someone has submitted a contact form on your website</p>
        </div>

        <!-- Main Content -->
        <div class="email-content">
            <div class="greeting">
                <h2>Dear Admin,</h2>
                <p style="color: #666;">A new enquiry has been submitted. Here are the details:</p>
            </div>

            <!-- Enquiry Details Card -->
            <!-- Enquiry Details Card - ONLY DISPLAY FIELDS THAT HAVE VALUES -->
            <div class="info-card">
                <!-- Name - Always show (required) -->
                <div class="info-row">
                    <span class="info-label">👤 Name:</span>
                    <span class="info-value">{{ $enquiry->name }}</span>
                </div>

                <!-- Contact Number - Always show (required) -->
                <div class="info-row">
                    <span class="info-label">📞 Contact Number:</span>
                    <span class="info-value">{{ $enquiry->contact_number }}</span>
                </div>

                <!-- Email - Only show if exists and not empty -->
                @if (!empty($enquiry->email))
                    <div class="info-row">
                        <span class="info-label">✉️ Email:</span>
                        <span class="info-value">
                            <a href="mailto:{{ $enquiry->email }}" style="color: #3b82f6; text-decoration: none;">
                                {{ $enquiry->email }}
                            </a>
                        </span>
                    </div>
                @endif

                <!-- Location - Only show if exists and not empty -->
                @if (!empty($enquiry->location))
                    <div class="info-row">
                        <span class="info-label">📍 Location:</span>
                        <span class="info-value">{{ $enquiry->location }}</span>
                    </div>
                @endif

                <!-- Submitted At - Always show -->
                <div class="info-row">
                    <span class="info-label">🕐 Submitted At:</span>
                    <span class="info-value">{{ $enquiry->created_at->format('F j, Y, g:i a') }}</span>
                </div>
            </div>

            <!-- Message Box -->
            @if ($enquiry->message)
                <div class="message-box">
                    <h3>💬 Message from {{ $enquiry->name }}:</h3>
                    <div class="message-content">
                        {{ nl2br(e($enquiry->message)) }}
                    </div>
                </div>
            @endif

            <!-- Status Badge -->
            <div style="text-align: center;">
                <span class="badge">✓ New Enquiry - Action Required</span>
            </div>

            <div class="divider"></div>


            <hr>

            <!-- Quick Info -->
            <div style="background: rgba(30, 58, 138, 0.7); padding: 15px; border-radius: 8px; margin-top: 20px;">
                <p style="margin: 0; font-size: 13px; color: 1e3a8a; text-align: center;">
                    <strong>📌 Quick Actions</strong><br>
                    Reply to this enquiry: <a href="mailto:{{ $enquiry->email }}"
                        style="color: 1e3a8a;">{{ $enquiry->email }}</a><br>
                    Call the customer: {{ $enquiry->contact_number }}
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="margin: 0 0 10px 0;">
                <strong>Solar Master</strong><br>
                Your Trusted Solar Energy Partner
            </p>



            <p style="margin: 10px 0 0 0;">
                This is an automated notification. Please do not reply to this email.<br>
                &copy; {{ date('Y') }} Solar Master. All rights reserved.
            </p>
        </div>

    </div>
</body>

</html>
