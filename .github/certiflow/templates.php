<?php
include 'db.php';

$category = '';

if(isset($_GET['category']))
{
    $category = $_GET['category'];
}

if($category == '')
{
    $sql = "SELECT * FROM templates ORDER BY id DESC";
}
else
{
    $sql = "SELECT * FROM templates
            WHERE category='$category'
            ORDER BY id DESC";
}

$result = mysqli_query($conn,$sql);
$totalTemplates = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>CertiFlow Templates</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f4f6f9;
}

/* TOPBAR */

.topbar{
    background:#1e293b;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    font-size:30px;
    font-weight:bold;
}

.menu a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    padding:8px 15px;
    border-radius:5px;
}

.menu a:hover{
    background:#334155;
}

/* CONTENT */

.container{
    width:95%;
    margin:auto;
    padding:20px;
}

.count-box{
    background:white;
    padding:20px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

/* CATEGORY FILTERS */

.filters{
    margin-bottom:25px;
}

.filters a{
    display:inline-block;
    padding:10px 15px;
    margin:5px;
    text-decoration:none;
    color:white;
    background:#2563eb;
    border-radius:5px;
}

.filters a:hover{
    background:#1d4ed8;
}

/* TEMPLATE GRID */

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
    gap:20px;
}

.card{
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.content{
    padding:15px;
}

.content h3{
    margin-bottom:10px;
}

.badge{
    background:#16a34a;
    color:white;
    padding:5px 10px;
    border-radius:5px;
    font-size:12px;
}

.description{
    margin-top:10px;
    color:#555;
}

.btn{
    display:inline-block;
    margin-top:15px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:10px 15px;
    border-radius:5px;
}

.btn:hover{
    background:#1d4ed8;
}

.no-data{
    background:white;
    padding:30px;
    text-align:center;
    border-radius:10px;
}

</style>

</head>

<body>

<!-- TOPBAR -->

<div class="topbar">

    <div class="logo">
        CertiFlow
    </div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="templates.php">Templates</a>
        <a href="add-template.php">Add Template</a>
        <a href="certificates.php">Certificates</a>
        <a href="logout.php">Logout</a>
    </div>

</div>

<div class="container">

    <div class="count-box">
        <h2>Total Templates Found: <?php echo $totalTemplates; ?></h2>
    </div>

    <!-- CATEGORY FILTERS -->

    <div class="filters">

        <a href="templates.php">All</a>

        <a href="templates.php?category=Professional">Professional</a>

        <a href="templates.php?category=Kids">Kids</a>

        <a href="templates.php?category=School">School</a>

        <a href="templates.php?category=Events">Events</a>

        <a href="templates.php?category=Internship">Internship</a>

        <a href="templates.php?category=Workshop">Workshop</a>

        <a href="templates.php?category=Hackathon">Hackathon</a>

        <a href="templates.php?category=Sports">Sports</a>

        <a href="templates.php?category=Creative">Creative</a>

        <a href="templates.php?category=Birthday">Birthday</a>

    </div>

    <!-- TEMPLATE LIST -->

    <div class="grid">

    <?php

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
    ?>

        <div class="card">

            <img
            src="<?php echo $row['preview_image']; ?>"
            alt="<?php echo $row['title']; ?>"
            onerror="this.src='uploads/no-image.jpg';">

            <div class="content">

                <h3>
                    <?php echo $row['title']; ?>
                </h3>

                <span class="badge">
                    <?php echo $row['category']; ?>
                </span>

                <p class="description">
                    <?php echo $row['description']; ?>
                </p>

                <a
                class="btn"
                href="generate_certificate.php?template_id=<?php echo $row['id']; ?>">
                    Use Template
                </a>

            </div>

        </div>

    <?php
        }
    }
    else
    {
        echo "<div class='no-data'>
                <h2>No Templates Found</h2>
              </div>";
    }

    ?>

    </div>

</div>

</body>
</html>