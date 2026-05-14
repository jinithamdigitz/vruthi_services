@extends('layouts.main')

@section('content')

@section('hero_title')
Solar Calculator
@endsection

@section('hero_text')
Estimate your solar savings and system size
@endsection

@section('content')
<div class="container">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success" style="margin: 20px 0; padding: 12px; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger" style="margin: 20px 0; padding: 12px; border-radius: 8px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Calculator Section -->
    <section class="calculator-section">
        <h2 class="section-title">Solar Savings Calculator</h2>

        <form action="{{ route('calculator.store') }}" method="POST" id="calculatorForm">
            @csrf

            <div class="calculator-wrapper">
                <!-- Left Form Side -->
                <div class="form-side">
                    <div class="form-grid">
                        <div class="input-box">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" id="name" required />
                        </div>

                        <div class="input-box">
                            <i class="fa-solid fa-location-dot"></i>
                            <input type="text" name="location" placeholder="Location" value="{{ old('location') }}" id="location" required />
                        </div>

                        <div class="input-box">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="contact_number" placeholder="Contact Number" value="{{ old('contact_number') }}" id="contact_number" required />
                        </div>

                        <div class="input-box">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" id="email" required />
                        </div>
                    </div>

                    <!-- Daily Consumption -->
                    <div class="range-group">
                        <div class="range-head">
                            <label>Average Daily Consumption (KWh)</label>
                            <div class="value-box">
                                <span id="consumptionValue">{{ old('daily_consumption', 16) }}</span>
                                <button type="button" onclick="increaseConsumption()">+</button>
                            </div>
                        </div>
                        <input
                            type="range"
                            id="consumptionRange"
                            name="daily_consumption"
                            min="1"
                            max="50"
                            value="{{ old('daily_consumption', 16) }}"
                            required
                        />
                    </div>

                    <!-- Monthly Bill -->
                    <div class="range-group">
                        <div class="range-head">
                            <label>Monthly Electricity Bill (₹)</label>
                            <div class="value-box">
                                <span id="billValue">{{ old('monthly_bill', 799) }}</span>
                                <button type="button" onclick="increaseBill()">+</button>
                            </div>
                        </div>
                        <input
                            type="range"
                            id="billRange"
                            name="monthly_bill"
                            min="100"
                            max="10000"
                            step="50"
                            value="{{ old('monthly_bill', 799) }}"
                            required
                        />
                    </div>

                    <!-- System Type -->
                    <div class="system-type">
                        <div class="system-left">
                            <i class="fa-solid fa-solar-panel"></i>
                            <span>System Type:</span>
                        </div>

                        <div class="system-options">
                            <label class="radio-option">
                                <input type="radio" name="system_type" value="on_grid" id="system_on_grid"
                                    {{ old('system_type', 'on_grid') == 'on_grid' ? 'checked' : '' }} required />
                                <span>
                                    <i class="fa-solid fa-briefcase" style="color: #1f7aff"></i>
                                    On-Grid
                                </span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="system_type" value="off_grid" id="system_off_grid"
                                    {{ old('system_type') == 'off_grid' ? 'checked' : '' }} />
                                <span>Off-Grid</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="system_type" value="hybrid" id="system_hybrid"
                                    {{ old('system_type') == 'hybrid' ? 'checked' : '' }} />
                                <span>
                                    <i class="fa-solid fa-cube" style="color: #29b54a"></i>
                                    Hybrid
                                </span>
                            </label>
                        </div>

                        
                    </div>
                </div>

                <!-- Right Savings Card -->
                <div class="savings-card">
                    <div class="savings-content">
                        <h4>Estimated Savings</h4>
                        <div class="amount">
                            ₹ <span id="savingsAmount">0</span>
                        </div>
                        <div class="year">/ Year</div>
                    </div>

                    <button type="button" id="calculateBtn" class="calc-btn">
                        Calculate Savings
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>


<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

<script>
    const consumptionRange = document.getElementById("consumptionRange");
    const billRange = document.getElementById("billRange");
    const consumptionValue = document.getElementById("consumptionValue");
    const billValue = document.getElementById("billValue");
    const savingsAmount = document.getElementById("savingsAmount");
    const calculateBtn = document.getElementById("calculateBtn");
    const calculatorForm = document.getElementById("calculatorForm");
    
    let clearTimer = null;
    let countdownInterval = null;
    let currentYearlySavings = 0;

    function updateValues() {
        consumptionValue.innerText = consumptionRange.value;
        billValue.innerText = billRange.value;
    }

    window.increaseConsumption = function() {
        let current = parseInt(consumptionRange.value);
        if (current < parseInt(consumptionRange.max)) {
            consumptionRange.value = current + 1;
            updateValues();
        }
    }

    window.increaseBill = function() {
        let current = parseInt(billRange.value);
        if (current < parseInt(billRange.max)) {
            current += parseInt(billRange.step);
            if (current > parseInt(billRange.max)) {
                current = parseInt(billRange.max);
            }
            billRange.value = current;
            updateValues();
        }
    }

    function calculateSavings() {
        let monthlyBill = parseInt(billRange.value);
        let systemType = document.querySelector('input[name="system_type"]:checked').value;

        let savingPercent = 0.70;

        if (systemType === 'off_grid') {
            savingPercent = 0.50;
        } else if (systemType === 'hybrid') {
            savingPercent = 0.80;
        }

        let yearlySavings = Math.round((monthlyBill * 12) * savingPercent);
        return yearlySavings;
    }

    function displayResult(savings) {
        savingsAmount.innerText = savings.toLocaleString('en-IN');
        savingsAmount.classList.add('result-highlight');
        setTimeout(() => {
            savingsAmount.classList.remove('result-highlight');
        }, 1500);
    }

    function showToast(message, isError = false) {
        const toast = document.createElement('div');
        toast.className = 'toast-message';
        toast.style.background = isError ? '#dc3545' : '#28a745';
        toast.innerHTML = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }

    function clearFormData() {
        // Clear all form fields
        document.getElementById('name').value = '';
        document.getElementById('location').value = '';
        document.getElementById('contact_number').value = '';
        document.getElementById('email').value = '';
        
        // Reset ranges to default values
        consumptionRange.value = '16';
        billRange.value = '799';
        
        // Reset radio to default (on_grid)
        document.getElementById('system_on_grid').checked = true;
        
        // Update displayed values
        updateValues();
        
        // Reset savings display to 0
        savingsAmount.innerText = '0';
        
        // Hide timer indicator
        const timerIndicator = document.getElementById('timerIndicator');
        if (timerIndicator) {
            timerIndicator.classList.remove('show');
        }
        
        // Clear countdown interval
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }
        
        // Show success message
        showToast('✨ Form has been reset! You can calculate again.');
        
        // Reset button style
        calculateBtn.style.background = "";
        calculateBtn.textContent = "Calculate Savings";
    }
    
    function startClearTimer() {
        // Clear any existing timer and interval
        if (clearTimer) {
            clearTimeout(clearTimer);
        }
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
        
        // Create or get timer indicator
        let timerIndicator = document.getElementById('timerIndicator');
        if (!timerIndicator) {
            timerIndicator = document.createElement('div');
            timerIndicator.id = 'timerIndicator';
            timerIndicator.className = 'clear-timer';
            document.querySelector('.savings-card').appendChild(timerIndicator);
        }
        
        // Show timer with countdown (60 seconds)
        let timeLeft = 60;
        timerIndicator.innerHTML = `⏱️ Form will be automatically cleared in ${timeLeft} seconds...`;
        timerIndicator.classList.add('show');
        
        countdownInterval = setInterval(() => {
            timeLeft--;
            
            if (timeLeft > 0) {
                timerIndicator.innerHTML = `⏱️ Form will be automatically cleared in ${timeLeft} seconds...`;
                
                if (timeLeft <= 10) {
                    timerIndicator.style.background = '#ff6b6b';
                    timerIndicator.style.color = 'white';
                    timerIndicator.style.borderColor = '#ff4757';
                } else {
                    timerIndicator.style.background = '#fff3cd';
                    timerIndicator.style.color = '#856404';
                    timerIndicator.style.borderColor = '#ffeeba';
                }
            } else {
                clearInterval(countdownInterval);
                countdownInterval = null;
            }
        }, 1000);
        
        // Set timer to clear data after 60 seconds
        clearTimer = setTimeout(() => {
            clearFormData();
            if (timerIndicator) {
                timerIndicator.classList.remove('show');
            }
            clearTimer = null;
        }, 60000);
    }

    // Handle Calculate button click with AJAX - NO PAGE RELOAD
    function handleCalculate() {
        // Validate required fields
        const name = document.getElementById('name').value;
        const location = document.getElementById('location').value;
        const contact = document.getElementById('contact_number').value;
        const email = document.getElementById('email').value;
        
        if (!name || !location || !contact || !email) {
            showToast('⚠️ Please fill all fields before calculating!', true);
            return;
        }
        
        // Calculate savings immediately
        const yearlySavings = calculateSavings();
        currentYearlySavings = yearlySavings;
        
        // Display result immediately
        displayResult(yearlySavings);
        
        // Visual feedback on button
        calculateBtn.style.background = "#28a745";
        calculateBtn.textContent = "✓ Calculated!";
        setTimeout(() => {
            calculateBtn.style.background = "";
            calculateBtn.textContent = "Calculate Savings";
        }, 2000);
        
        // Prepare form data for AJAX
        const formData = new FormData(calculatorForm);
        formData.append('estimated_savings', yearlySavings);
        
        // Show loading overlay
        document.getElementById('loadingOverlay').style.display = 'flex';
        
        // Send AJAX request
        fetch('{{ route("calculator.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loadingOverlay').style.display = 'none';
            if (data.success) {
                showToast('✅ Calculation saved successfully! Form will clear in 1 minute.');
                startClearTimer();
            } else {
                showToast('❌ Error saving data. Please try again.', true);
            }
        })
        .catch(error => {
            document.getElementById('loadingOverlay').style.display = 'none';
            console.error('Error:', error);
            showToast('✅ Calculation completed! Form will clear in 1 minute.');
            startClearTimer();
        });
    }

    // Event listeners - Only update values, NOT the savings display
    consumptionRange.addEventListener("input", updateValues);
    billRange.addEventListener("input", updateValues);
    
    // Calculate button click
    calculateBtn.addEventListener("click", handleCalculate);
    
    // Initialize values - Set savings to 0 and don't auto-calculate
    updateValues();
    savingsAmount.innerText = '0';
</script>
@endsection