<?php
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Check Template ID */
if(!isset($_GET['template_id']))
{
    die("No template selected.");
}

$template_id = (int)$_GET['template_id'];

/* Get Template */
$sql = "SELECT * FROM templates WHERE id = $template_id";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0)
{
    die("Template not found.");
}

$template = mysqli_fetch_assoc($result);

/* Generate Certificate */
if(isset($_POST['generate']))
{
    $recipient_name   = mysqli_real_escape_string($conn,$_POST['recipient_name']);
    $certificate_title= mysqli_real_escape_string($conn,$_POST['certificate_title']);
    $issued_by        = mysqli_real_escape_string($conn,$_POST['issued_by']);
    $issue_date       = $_POST['issue_date'];

    $verification_code =
        "CF" . strtoupper(substr(md5(uniqid()),0,8));

    $insert = "INSERT INTO certificates
    (
        template_id,
        recipient_name,
        certificate_title,
        issued_by,
        issue_date,
        verification_code
    )
    VALUES
    (
        '$template_id',
        '$recipient_name',
        '$certificate_title',
        '$issued_by',
        '$issue_date',
        '$verification_code'
    )";

    if(mysqli_query($conn,$insert))
    {
        $success = true;
    }
    else
    {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>

<html>
<head>

<title>Generate Certificate</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#f4f6f9;
}

.container{
    width:90%;
    margin:30px auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

img{
    width:100%;
    max-width:800px;
    border-radius:10px;
}

input{
    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:15px;
    border:1px solid #ccc;
}

button{
    background:#16a34a;
    color:white;
    border:none;
    padding:12px 20px;
    cursor:pointer;
}

button:hover{
    background:#15803d;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:15px;
    margin-bottom:20px;
    border-radius:5px;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<?php if(isset($success)){ ?>

<div class="success">
Certificate Generated Successfully!
<br>
Verification Code:
<b><?php echo $verification_code; ?></b>
</div>

<?php } ?>

<h2><?php echo $template['title']; ?></h2>

<p>
Category:
<b><?php echo $template['category']; ?></b>
</p>

<img src="<?php echo $template['preview_image']; ?>">

<hr><br>

<form method="POST">

<label>Recipient Name</label> <input
type="text"
name="recipient_name"
required>

<label>Certificate Title</label> <input
type="text"
name="certificate_title"
required>

<label>Issued By</label> <input
type="text"
name="issued_by"
required>

<label>Issue Date</label> <input
type="date"
name="issue_date"
required>

<button
type="submit"
name="generate">
Generate Certificate </button>

</form>

</div>

</div>

</body>
</html>
