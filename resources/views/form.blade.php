@extends('layouts.main')

@section('content')

<section class="page-banner">
    <div class="image-layer" style="background-image:url(images/background/banner-image-2.jpg);"></div>
    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Common Donation</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li class="active">Common Donation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="default-form booking-form">
    <section class="donation-form py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">
                            <h3 class="text-center mb-4 fw-semibold text-success">Support Our Causes</h3>
                            
                            <div class="text-center mb-4">
                                <div class="impact-stats">
                                    <div class="stat-item">
                                        <i class="fa fa-heart text-success me-2"></i>
                                        <span>Every ₹100 helps plant 1 tree</span>
                                    </div>
                                </div>
                            </div>

                            <div id="responseMessage"></div>

                            <form method="POST" id="donationForm">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Name *</label>
                                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter your name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Email Address *</label>
                                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address *</label>
                                    <input type="text" name="address" class="form-control form-control-lg" placeholder="Enter your complete address" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Donation Amount (₹) *</label>
                                    <div class="amount-presets mb-3">
                                        <div class="btn-group w-100" role="group">
                                            <button type="button" class="btn btn-outline-success amount-btn" data-amount="100">₹100</button>
                                            <button type="button" class="btn btn-outline-success amount-btn" data-amount="500">₹500</button>
                                            <button type="button" class="btn btn-outline-success amount-btn" data-amount="1000">₹1000</button>
                                            <button type="button" class="btn btn-outline-success amount-btn" data-amount="2000">₹2000</button>
                                        </div>
                                    </div>
                                    <input type="number" name="amount" class="form-control form-control-lg" placeholder="Or enter custom amount" min="1" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Phone Number *</label>
                                    <input type="text" name="phone" class="form-control form-control-lg" placeholder="Enter your phone number" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Your Comments</label>
                                    <textarea name="message" class="form-control form-control-lg" rows="3" placeholder="Share why you're supporting us..."></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm donation-btn">
                                        <i class="fa fa-heart me-2"></i> 
                                        <span class="btn-text">Donate Now</span>
                                        <div class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Razorpay Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complete Your Donation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="payment-details mb-4">
                    <h4 class="amount-display text-success"></h4>
                    <p class="donor-name mb-1"></p>
                    <p class="donor-email text-muted"></p>
                </div>
                <div id="razorpay-container"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
.impact-stats {
    background: linear-gradient(135deg, #164A25, #00AA55);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.stat-item {
    font-weight: 600;
    font-size: 1.1em;
}

.amount-presets .btn {
    border-color: #164A25;
    color: #164A25;
    transition: all 0.3s ease;
}

.amount-presets .btn:hover,
.amount-presets .btn.active {
    background-color: #164A25;
    border-color: #164A25;
    color: white;
}

.donation-btn {
    background: linear-gradient(135deg, #164A25, #00AA55);
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.donation-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(22, 74, 37, 0.3);
}

.payment-details {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #00AA55;
}

.amount-display {
    font-size: 2em;
    font-weight: bold;
}

.donor-name {
    font-size: 1.2em;
    font-weight: 600;
    color: #164A25;
}

.razorpay-payment-button {
    background: linear-gradient(135deg, #164A25, #00AA55) !important;
    color: white !important;
    border: none !important;
    padding: 12px 30px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
}

.alert {
    border-radius: 10px;
    border: none;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-left: 4px solid #00AA55;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.card {
    border: none;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$(document).ready(function() {
    // Amount preset buttons
    $('.amount-btn').click(function() {
        $('.amount-btn').removeClass('active');
        $(this).addClass('active');
        $('input[name="amount"]').val($(this).data('amount'));
    });

    // Custom amount input
    $('input[name="amount"]').on('input', function() {
        $('.amount-btn').removeClass('active');
    });

    $('#donationForm').on('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = $('.donation-btn');
        const btnText = $('.btn-text');
        const spinner = $('.spinner-border');
        
        // Show loading state
        btnText.text('Processing...');
        spinner.removeClass('d-none');
        submitBtn.prop('disabled', true);

        $.ajax({
            url: "{{ route('donate.create-order') }}",
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    openRazorpayPayment(response);
                } else {
                    showMessage(response.message, 'danger');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                if (errors) {
                    let errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('#responseMessage').html(errorHtml);
                } else {
                    showMessage('An error occurred. Please try again.', 'danger');
                }
            },
            complete: function() {
                // Reset button state
                btnText.text('Donate Now');
                spinner.addClass('d-none');
                submitBtn.prop('disabled', false);
            }
        });
    });

    function openRazorpayPayment(orderData) {
        // Update modal content
        $('.amount-display').text('₹' + orderData.amount);
        $('.donor-name').text('Donor: ' + orderData.name);
        $('.donor-email').text(orderData.email);

        const options = {
            "key": orderData.key,
            "amount": orderData.amount * 100,
            "currency": "INR",
            "name": "ENVED Foundation",
            "description": "Donation for Environmental Sustainability",
            "image": "{{ asset('images/logo.png') }}",
            "order_id": orderData.order_id,
            "handler": function(response) {
                verifyPayment(response, orderData);
            },
            "prefill": {
                "name": orderData.name,
                "email": orderData.email,
                "contact": orderData.phone
            },
            "notes": {
                "address": "Donation for Environmental Causes"
            },
            "theme": {
                "color": "#164A25"
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();
    }

    function verifyPayment(paymentData, orderData) {
        $.ajax({
            url: "{{ route('donation.verify') }}",
            type: 'POST',
            data: {
                order_id: paymentData.razorpay_order_id,
                payment_id: paymentData.razorpay_payment_id,
                signature: paymentData.razorpay_signature,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    showMessage(response.message, 'success');
                    $('#donationForm')[0].reset();
                    $('.amount-btn').removeClass('active');
                    
                    // Show success details
                    const successHtml = `
                        <div class="alert alert-success">
                            <h5>Thank You for Your Donation!</h5>
                            <p><strong>Amount:</strong> ₹${orderData.amount}</p>
                            <p><strong>Transaction ID:</strong> ${response.payment_id}</p>
                            <p>You will receive a confirmation email shortly.</p>
                        </div>
                    `;
                    $('#responseMessage').html(successHtml);
                } else {
                    showMessage(response.message, 'danger');
                }
            },
            error: function(xhr) {
                showMessage('Payment verification failed. Please contact support.', 'danger');
            }
        });
    }

    function showMessage(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        $('#responseMessage').html(`<div class="alert ${alertClass}">${message}</div>`);
        
        // Scroll to message
        $('html, body').animate({
            scrollTop: $('#responseMessage').offset().top - 100
        }, 500);
    }
});
</script>
@endsection