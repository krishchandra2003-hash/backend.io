<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['user_name'] ?? 'User';
$userEmail = $_SESSION['user_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CertiFlow Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

:root{
    --primary:#2563eb;
    --primary-hover:#1d4ed8;

    --bg:#f1f5f9;
    --surface:#ffffff;

    --dark-card:#111827;
    --dark-card-hover:#1f2937;

    --border:#334155;

    --text:#0f172a;
    --text-light:#64748b;

    --success:#10b981;
    --danger:#ef4444;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:var(--bg);
    font-family:'Segoe UI',sans-serif;
    color:var(--text);
}

/* Sidebar */

.sidebar{
    width:270px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;

    background:#ffffff;
    border-right:1px solid #e2e8f0;

    padding:25px;
}

.logo{
    font-size:30px;
    font-weight:800;
    color:var(--primary);
    margin-bottom:35px;
}

.menu a{
    display:flex;
    align-items:center;

    text-decoration:none;

    padding:14px 16px;
    margin-bottom:10px;

    border-radius:14px;

    color:#334155;

    transition:all .3s ease;
}

.menu a:hover{
    background:#eff6ff;
    color:var(--primary);
}

.menu a.active{
    background:var(--primary);
    color:white;
}

/* Main */

.main{
    margin-left:270px;
    padding:35px;
}

/* Welcome */

.topbar{
    background:white;

    padding:28px;

    border-radius:24px;

    border:1px solid #e2e8f0;

    margin-bottom:30px;
}

.topbar h2{
    font-size:32px;
    font-weight:700;
}

.topbar p{
    margin-top:8px;
    color:var(--text-light);
}

/* Dark Premium Cards */

.card-box{
    background: #8b80eb ;

    color:black;

    border:1px solid #3f3f46;

    border-radius:24px;

    padding:25px;

    transition:all .35s ease;

    overflow:hidden;
}

.card-box:hover{
    transform:translateY(-8px);

    background: #a5a5ea;

    box-shadow:
        0 25px 50px rgba(0,0,0,.15);
}

/* Stats */

.label{
    color:#cbd5e1;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:1px;
}

.stat-number{
    font-size:42px;
    font-weight:800;

    margin-top:12px;
}

.stat-growth{
    margin-top:12px;

    color:#4ade80;

    font-size:14px;
}

/* User Card */

.user-box{
    margin-top:40px;

    padding:18px;

    border-radius:18px;

    background:#f8fafc;

    border:1px solid #e2e8f0;
}

.user-box strong{
    display:block;
    margin-bottom:4px;
}

/* Activity */

.activity-item{
    padding:16px 0;

    border-bottom:1px solid rgba(255,255,255,.08);
}

.activity-item:last-child{
    border:none;
}

/* Badge */

.badge-custom{
    background:#22c55e;

    color:white;

    padding:8px 14px;

    border-radius:999px;

    font-size:13px;

    font-weight:600;
}

/* List */

.card-box ul{
    margin-top:20px;
    padding-left:20px;
}

.card-box ul li{
    margin-bottom:10px;
}

/* Buttons */

.btn-primary{
    background:var(--primary);
    border:none;
    border-radius:12px;
}

.btn-primary:hover{
    background:var(--primary-hover);
}

/* Scrollbar */

::-webkit-scrollbar{
    width:8px;
}

::-webkit-scrollbar-thumb{
    background:#94a3b8;
    border-radius:50px;
}

/* Responsive */

@media(max-width:992px){

    .sidebar{
        width:100%;
        height:auto;
        position:relative;
    }

    .main{
        margin-left:0;
    }
}
</style>
</head>
<body>

<div class="sidebar">

    <div class="logo">
        CertiFlow
    </div>

    <div class="menu">
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="templates.php">Templates</a>
        <a href="#">Certificates</a>
        <a href="#">Bulk Generator</a>
        <a href="#">Verification</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="user-box">
        <strong><?php echo htmlspecialchars($userName); ?></strong>
        <br>
        <small><?php echo htmlspecialchars($userEmail); ?></small>
    </div>

</div>

<div class="main">

    <div class="topbar">
        <h2>Welcome back, <?php echo htmlspecialchars($userName); ?> 👋</h2>
        <p class="text-muted mb-0">
            Manage certificate templates, generate certificates and verify authenticity.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-box">
                <div class="label">Total Certificates</div>
                <div class="stat-number">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box">
                <div class="label">Templates</div>
                <div class="stat-number">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box">
                <div class="label">Verified</div>
                <div class="stat-number">0</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box">
                <div class="label">Users</div>
                <div class="stat-number">1</div>
            </div>
        </div>

    </div>

    <div class="row mt-4 g-4">

        <div class="col-lg-8">

            <div class="card-box">
                <h4>Recent Activity</h4>

                <div class="activity-item">
                    Authentication system completed.
                </div>

                <div class="activity-item">
                    Dashboard initialized.
                </div>

                <div class="activity-item">
                    Ready for template management module.
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card-box">
                <h4>Project Status</h4>

                <div class="mt-3">
                    <span class="badge-custom">
                        Day 1 Completed
                    </span>
                </div>

                <ul class="mt-4">
                    <li>Authentication</li>
                    <li>Session Security</li>
                    <li>Dashboard Access Control</li>
                    <li>Bootstrap UI</li>
                </ul>
            </div>

        </div>

    </div>

</div>

</body>
</html>