<?php
session_start();
require_once 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$message = "";
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);

    if(empty($title) || empty($category)){
        $error = "All fields are required.";
    }
    else{

        if(isset($_FILES['preview_image']) && $_FILES['preview_image']['error'] == 0){

            $allowed = ['jpg','jpeg','png','webp'];

            $fileName = $_FILES['preview_image']['name'];
            $tmpName  = $_FILES['preview_image']['tmp_name'];

            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if(!in_array($extension, $allowed)){

                $error = "Only JPG, JPEG, PNG and WEBP allowed.";

            }else{

                $newName = time() . "_" . uniqid() . "." . $extension;

                $uploadPath = "uploads/templates/" . $newName;

                if(move_uploaded_file($tmpName, $uploadPath)){

                    $stmt = $conn->prepare("
                        INSERT INTO templates
                        (title, category, preview_image)
                        VALUES (?, ?, ?)
                    ");

                    $stmt->bind_param(
                        "sss",
                        $title,
                        $category,
                        $uploadPath
                    );

                    if($stmt->execute()){

                        $message = "Template uploaded successfully.";

                    }else{

                        $error = "Database error.";
                    }

                }else{

                    $error = "Image upload failed.";
                }
            }

        }else{

            $error = "Please select an image.";
        }
    }
}
?>

<!DOCTYPE html>

<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Add Template</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f8fafc;
}

.card-box{
    max-width:700px;
    margin:auto;
    margin-top:50px;

    background:#fff;

    border-radius:20px;

    padding:30px;

    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

</style>

</head>
<body>

<div class="container">

```
<div class="card-box">

    <h2 class="mb-4">
        Add New Template
    </h2>

    <?php if($message): ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if($error): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">

            <label class="form-label">
                Template Name
            </label>

            <input
                type="text"
                name="title"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Category
            </label>

            <select
                name="category"
                class="form-select"
                required
            >
                <option value="">
                    Select Category
                </option>

                <option>
                    Achievement
                </option>

                <option>
                    Participation
                </option>

                <option>
                    Internship
                </option>

                <option>
                    Workshop
                </option>

            </select>

        </div>

        <div class="mb-4">

            <label class="form-label">
                Preview Image
            </label>

            <input
                type="file"
                name="preview_image"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp"
                required
            >

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Upload Template
        </button>

        <a
            href="dashboard.php"
            class="btn btn-secondary"
        >
            Dashboard
        </a>

    </form>

</div>
```

</div>

</body>
</html>
