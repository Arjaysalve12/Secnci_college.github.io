<!-- PHP Starts Here -->
<?php 
session_start();
    require_once "../connection/connection.php"; 
    $message="Email Or Password Does Not Match";
    if(isset($_POST["btnlogin"]))
    {
        $username=$_POST["email"];
        $password=$_POST["password"];

        $query="select * from login where user_id='$username' and Password='$password' ";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_array($result)) {
                if ($row["Role"]=="Admin")
                {
                    $_SESSION['LoginAdmin']=$row["user_id"];
                    header('Location: ../admin/admin-index.php');
                }
                else if ($row["Role"]=="Teacher" and $row["account"]=="Activate")
                {
                    $_SESSION['LoginTeacher']=$row["user_id"];
                    header('Location: ../teacher/teacher-index.php');
                }
                else if ($row["Role"]=="Student" and $row["account"]=="Activate")
                {
                    $_SESSION['LoginStudent']=$row['user_id'];
                    header('Location: ../student/student-index.php');
                }
            }
        }
        else
        { 
            header("Location: login.php");
        }
    }
?>

<!doctype html>
<<html lang="en">
	<head>
		<title>Login - SECNCI</title>
	</head>
	<body class="login-background">
		<!doctype html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="$baseUrl/../Images/login_logo" type="image/x-icon">
    
    <!-- css style goes here -->

      <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../css/footer.css">
      <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- css style go to end here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
 

    <nav class="navbar navbar-expand-lg navbar-dark header-back sticky-top header-navbar-fonts">
      <a class="navbar-brand d-flex align-items-center" href="../index.php">
        <img src="../images/SECNCI_logo_logo.png" class="logo-image" width="50" height="50">
        <h3 class="text-light text-uppercase ml-2">Secnci</h3>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> 
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../index.php">HOME<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../academics.php">ACADEMICS<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../admission.php">ADMISSION<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../login/logout.php"><i class="fa fa-sign-out text-white fa-lg" aria-hidden="true"></i><span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>        <div class="login-div mt-3 rounded">
            <div class="logo-div text-center">
                <img src="../Images/SECNCI_logo_logo.png" alt="" class="align-items-center" width="100" height="100">
            </div>
            <div class="login-padding">
                <h2 class="text-center text-white">LOGIN</h2>
                <form class="p-1" action="login.php" method="POST">
                    <div class="form-group">
                        <label><h6>Enter Your ID/Email:</h6></label>
                        <input type="text" name="email" placeholder="Enter User ID" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><h6>Enter Password:</h6></label>
                        <input type="Password" name="password" placeholder="Enter Password" class="form-control border-bottom" required>
                        <!-- Email Or Password Does Not Match -->
                    </div>
                    <div class="form-group text-center mb-3 mt-4">
                        <input type="submit" name="btnlogin" value="LOGIN" class="btn btn-white pl-5 pr-5 ">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>



