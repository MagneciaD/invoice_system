<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amahle Invoicing System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Set body background color to white */
        }

        .hero {
            padding: 80px 0;
            background-color: #ffffff; /* Change hero background color to white */
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
        }

        .hero h1 .highlight {
            color: #60BF61;
        }

        .hero p {
            font-size: 1.2rem;
            color: #777;
        }

        .btn-primary-custom {
            background-color: #e83e8c;
            border: none;
            padding: 10px 20px;
        }

        .btn-outline-custom {
            border-color: #e83e8c;
            color: #e83e8c;
            padding: 10px 20px;
        }

        .feature-icons {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .feature-icons .icon-box {
            text-align: center;
            margin: 0 15px;
        }

        .feature-icons .icon-box i {
            font-size: 2rem;
            color: #e83e8c;
        }

        .feature-icons .icon-box p {
            margin-top: 10px;
            font-size: 1.1rem;
            color: #555;
        }

        .hero-img {
            max-width: 100%;
            height: auto;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem; /* Adjust for smaller screens */
            }

            .hero p {
                font-size: 1rem; /* Adjust for smaller screens */
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Amahle Invoicing Solution</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                    <nav class="d-flex flex-row">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                        @endauth
                    </nav>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left: Text & Buttons -->
                <div class="col-lg-6 hero-content text-lg-start">
                    <h1>Master <span class="highlight">Professional Invoicing</span> Quickly & Easy</h1>
                    <p class="mt-3">Welcome to our receipt and invoice system. Streamline your operations with ease and efficiency by amahle holdings pty ltd.</p>
                    
                    <div class="feature-icons mt-5">
                        <div class="icon-box">
                            <i class="bi bi-lock"></i>
                            <p>Secure Storage</p>
                        </div>
                        <div class="icon-box">
                            <i class="bi bi-search"></i>
                            <p>Fast Search and Retrieval</p>
                        </div>
                        <div class="icon-box">
                            <i class="bi bi-file-earmark-text"></i>
                            <p>Professional Receipts and Invoices</p>
                        </div>
                    </div>
                </div>
                <!-- Right: Image -->
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('img/tax.jpg') }}" alt="Invoicing Illustration" class="img-fluid hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
