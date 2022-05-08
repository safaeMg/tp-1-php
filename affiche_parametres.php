<?php

require "db.php";

// Check if submit button is clicked
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $jobs = $_POST['jobs'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $language = $_POST['language'];
    $hobbies = $_POST['hobbies'];

    // Name of the uploaded file
    $resume = $_FILES["resume"]["name"];

    // Destination of the file on the server
    $folder_name = "upload/";
    $destination = $folder_name . $resume;

    // Get the file extension
    $extension = pathinfo($resume, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $tmpfname = $_FILES["resume"]["tmp_name"];
    $size = $_FILES["resume"]["size"];

    if ($extension == "application/pdf") {
        echo "<script>alert('You only have to upload a pdf file.');</script>";
    } elseif ($_FILES["resume"]["size"] > 1000000) {
        // The uploaded file should not be larger than 1MB
        echo "<script>alert('The file is too large!');</script>";
    } else {
        // Move the uploaded (temporary) file to the specified destination
        move_uploaded_file($_FILES['resume']['tmp_name'], $destination);
    }

    // Convert an Array to String
    $arr1 = implode(",", $jobs);
    $arr2 = implode(",", $hobbies);

    // Attempt insert query execution
    $sql = "INSERT INTO my_table (name, password, jobs, country, gender, language, hobbies, resume)
    VALUES ('$name', '$password', '$country', '$gender', '$language', '$arr1', '$arr2', '$resume')";
    $query = mysqli_query($con, $sql);

    $select = "SELECT * FROM my_table";
    $result = $con->query($select);

    if ($query) {
        echo "<script>alert('Records were inserted successfully.')</script>";
    } else {
        echo "ERROR: Could not able to execute " . $sql . "<br>" . mysqli_error($con);
    }

    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Project Description" />
        <meta name="author" content="Project Author" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Project Title</title>
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" />
    </head>
    <body class="bg-light">
        <div class="container col-md-6 my-5">
            <table class="table table-responsive table-bordered table-hover mb-4">
                <tbody>
                <?php echo "
							<tr>
								<th scope='row'>
									<i class='fas fa-user-circle me-1'></i> Votre nom d'utilisateur:
								</th>
								<td>" .
                    $name .
                    "</td>
							</tr>
							<tr>
								<th scope='row'>
									<i class='fas fa-lock me-1'></i> Votre mot de passe:
								</th>
								<td>" .
                    $password .
                    "</td>
							</tr>
							<tr>
								<th scope='row'>
									<i class='fas fa-suitcase me-1'></i> Votre Profession:
								</th>
								<td>" .
                    $arr1 .
                    "</td>
							</tr>
							<tr>
								<th scope='row'>
									<i class='fas fa-flag me-1'></i> Votre Pays:
								</th>
								<td>" .
                    $country .
                    "</td>
							</tr>
							<tr>
								<th scope='row'>
									<i class='fas fa-venus-mars me-1'></i> Votre Sexe:
								</th>
								<td><span class='badge bg-primary'>" .
                    $gender .
                    "</span></td>
							</tr>
							<tr>
								<th scope='row'>
									<i class='fas fa-language me-1'></i> Votre Langue:
								</th>
								<td>" .
                    $language .
                    "</td>
							</tr>
							<tr>
								<th scope='row'>
									<i class='fas fa-futbol me-1'></i> Votre Loisir:
								</th>
								<td><span class='badge bg-info'>" .
                    $arr2 .
                    "</span></td>
							</tr>
							<tr>
								<th scope='row'>
									<i class='fas fa-file-alt me-1'></i> Votre CV:
								</th>
								<td>
									<span class='badge bg-dark'><i class='fas fa-eye me-1'></i> " .
                    $resume .
                    "</span>
								    <span class='badge bg-warning'>1 MB</span>
									<span class='badge bg-success'>has been sent</span>
								</td>
							</tr>
							"; ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="form.html" class="btn btn-lg btn-danger text-center"><i class="fas fa-arrow-alt-circle-left me-1"></i> Back to the form</a>
            </div>
        </div>

        <!-- JS Libraries -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>