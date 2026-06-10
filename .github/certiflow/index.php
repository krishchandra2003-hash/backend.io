<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CertiFlow - Smart Certificate Generator</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

:root{
    --primary:#2563eb;
    --primary-hover:#1d4ed8;
    --dark:#111827;
    --bg:#f8fafc;
    --text:#0f172a;
    --muted:#64748b;
    --border:#e2e8f0;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:var(--bg);
    color:var(--text);
    font-family:'Segoe UI',sans-serif;
}

.navbar{
    background:#fff;
    border-bottom:1px solid var(--border);
}

.logo{
    font-size:30px;
    font-weight:800;
    color:var(--primary);
}

.hero{
    padding:100px 0;
}

.hero h1{
    font-size:60px;
    font-weight:800;
    line-height:1.2;
}

.hero p{
    font-size:20px;
    color:var(--muted);
    margin-top:20px;
}

.btn-main{
    background:var(--primary);
    color:#fff;
    padding:14px 28px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
}

.btn-main:hover{
    background:var(--primary-hover);
    color:#fff;
}

.btn-outline-main{
    border:2px solid var(--primary);
    color:var(--primary);
    padding:14px 28px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
}

.btn-outline-main:hover{
    background:var(--primary);
    color:#fff;
}

.feature-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:20px;
    padding:30px;
    height:100%;
    transition:.3s;
}

.feature-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(0,0,0,.08);
}

.stats{
    background:var(--dark);
    color:#fff;
    padding:80px 0;
    margin-top:80px;
}

.stat-number{
    font-size:50px;
    font-weight:800;
}

.cta{
    padding:100px 0;
}

.cta-box{
    background:#fff;
    border:1px solid var(--border);
    border-radius:24px;
    padding:60px;
    text-align:center;
}

footer{
    background:#fff;
    border-top:1px solid var(--border);
    text-align:center;
    padding:25px;
    color:var(--muted);
}

@media(max-width:768px){

    .hero h1{
        font-size:42px;
    }

    .cta-box{
        padding:30px;
    }

}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg py-3">
    <div class="container">


    <span class="logo">CertiFlow</span>

    <div class="ms-auto">

       
    </div>

</div>


</nav>

<section class="hero">


<div class="container">

    <div class="row align-items-center">

        <div class="col-lg-6">

            <h1>
                Create Professional Certificates In Minutes
            </h1>

            <p>
                Generate, manage and verify certificates using a modern and secure platform.
            </p>

            <div class="mt-4">

                <a href="register.php" class="btn-main me-2">
                    Get Started
                </a>

                
            </div>

        </div>

        <div class="col-lg-6 text-center mt-5 mt-lg-0">

            <img
            src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=900"
            class="img-fluid rounded-4 shadow"
            alt="CertiFlow">

        </div>

    </div>

</div>
```

</section>

<section class="container py-5">

```
<h2 class="text-center mb-5">
    Powerful Features
</h2>

<div class="row g-4">

    <div class="col-md-3">
        <div class="feature-card">
            <h4>Certificate Generator</h4>
            <p>Create certificates instantly.</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="feature-card">
            <h4>Bulk Generation</h4>
            <p>Generate hundreds of certificates at once.</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="feature-card">
            <h4>QR Verification</h4>
            <p>Verify certificate authenticity securely.</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="feature-card">
            <h4>Template Library</h4>
            <p>Manage professional certificate templates.</p>
        </div>
    </div>

</div>
```

</section>

<section class="stats">

```
<div class="container">

    <div class="row text-center">

        <div class="col-md-4">
            <div class="stat-number">1000+</div>
            <p>Certificates Generated</p>
        </div>

        <div class="col-md-4">
            <div class="stat-number">100+</div>
            <p>Templates</p>
        </div>

        <div class="col-md-4">
            <div class="stat-number">24/7</div>
            <p>Verification</p>
        </div>

    </div>

</div>
```

</section>

<section class="cta">

<div class="container">

    <div class="cta-box">

        <h2>Ready To Start?</h2>

        <p class="text-muted mt-3">
            Join CertiFlow and create certificates professionally.
        </p>

        <div class="mt-4">

            <a href="register.php" class="btn-main me-2">
                Create Account
            </a>

            <button class="btn btn-dark">
                Continue With Google
            </button>

        </div>

    </div>

</div>


</section>

<footer>
    © 2026 CertiFlow. All Rights Reserved.
</footer>

</body>
</html>
