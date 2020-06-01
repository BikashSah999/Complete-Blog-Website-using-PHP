<?php
    include("include/db.php");
    include("include/session.php");
    include("include/function.php");
    if(isset($_POST['login']))
    {
        $adminname = $_POST['adminname'];
        $adminpassword = $_POST['password'];
        $adminpassword = md5($adminpassword);
        $login = mysqli_query($con, "SELECT * FROM registration WHERE username='$adminname' AND password='$adminpassword'");
        if(mysqli_num_rows($login)==1)
        {
            $_SESSION['successmessage'] = "Welcome Admin {$adminname}";
            $data = mysqli_fetch_array($login);
            $_SESSION['Adminname'] = $data['username'];
            header("Location:dashboard.php");
            exit();
        }
        else
        {
            $_SESSION['errormessage'] = "Incorrect Username or Password";
            header("Location:login.php");
            exit();
        }
        // while($datarows = mysqli_fetch_array($login))
        // {
        //     echo $datarows['username'];
        //     echo $datarows['password'];
        // }
    }
?>
<html>
<head>
<title> Log In </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Bikash Blog</a>
        </nav>
        <div>
            <h4> <?php echo errormessage();?> </h4>
        </div>
        <div class="row">
            <div class="col-lg-4">
            </div>

            <div class="col-lg-4" style="margin-top:5%;">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="name">Admin Name</label>
                        <input type="text" class="form-control" id="name" name="adminname" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Enter Password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Log In</button><br>
                </form>    
            </div>
        </div>
    </div>
</body>
</html>