<?php
include('include/db.php');
include('include/session.php');
include("include/function.php");
confirmlogin();

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];
    $confirmuserpassword = $_POST['confirmuserpassword'];
    date_default_timezone_set("Asia/Kathmandu");
    $currenttime = time();
    $datetime = strftime("%Y-%m-%d %H-%M-%S", $currenttime);
    $adminname = $_SESSION['Adminname'];
    if(strlen($username)<3)
    {
        $_SESSION['errormessage'] = "Username must be of atleast 3 characters" ;
        header("Location:admins.php");
        exit();
    }
    elseif(strlen($userpassword)<5)
    {
        $_SESSION['errormessage'] = "Password Should be of atleast 5 characters" ;
        header("Location:admins.php");
        exit();   
    }
    elseif($userpassword != $confirmuserpassword)
    {
        $_SESSION['errormessage'] = "Password and Comfirm Password doesn't match";
        header("Location;admins.php");
        exit();
    }
    else
    {
        $userpassword = md5($userpassword);
        $insert = mysqli_query($con, "INSERT INTO registration(datetime, username, password, addedby) VALUES ('$datetime','$username','$userpassword','$adminname')");
        $_SESSION['successmessage'] = 'Admin Added Succesfully';
        header("Location:admins.php");
        exit();
    }
}
?>
<html>
<head>
<title> Manage Admin </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="CSS/adminstyle.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">CMS</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="blog.php">Blog<span class="sr-only">(current)</span></a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="blog.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
                </form>
            </div>
        </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <h1> CMS </h1>
                <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link admin" href="dashboard.php"><span class="fas fa-th"></span>&nbsp;Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="addnewpost.php"><span class="fas fa-list-alt"></span>&nbsp;Add New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="category.php"><span class="fas fa-tags"></span>&nbsp;Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active admin" href="#"><span class="fas fa-users"></span>&nbsp;Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="addcompetition.php"><span class="fas fa-users"></span>&nbsp;Add Competition</a>
                </li>
                <li class="nav-item">
                <a class="nav-link admin" href="comment.php"><span class="fas fa-comment"></span>&nbsp;Comments &nbsp;
                    <?php
                        $unapprovedcomment = mysqli_query($con, "SELECT * FROM comment WHERE status='OFF'");
                        $noofunapproved = 0;
                        while($retrieveunapproved = mysqli_fetch_array($unapprovedcomment))
                        {
                            $noofunapproved++;
                        }
                    ?>
                    <span><sup style="background-color:red; color:yellow;";">&nbsp;<?php echo $noofunapproved;?>&nbsp;</sup></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="#"><span class="fas fa-blog"></span>&nbsp;Live Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="logout.php"> <span class="fas fa-sign-out-alt"></span>&nbsp;Log Out</a>
                </li>
                </ul>
            </div>
            <div class="col-sm-10">
                <h1> Manage Admins</h1>
                <?php
                    echo errormessage();
                    echo successmessage();
                ?>
                <form action="admins.php" method="post">
                <div class="form-group">
                    <label for="name">Admin Name:</label>
                    <input type="text" class="form-control" id="name"  placeholder="Admin Name" name="username" required>
                </div>
                <div class="form-group">
                    <label for="name">Password:</label>
                    <input type="password" class="form-control" id="name"  placeholder="Password" name="userpassword" required>
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password:</label>
                    <input type="password" class="form-control" id="name"  placeholder="Confirm Password" name="confirmuserpassword" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Add New Admin</button>
                </form>

                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Date and Time</th>
                        <th scope="col">Admin Name</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
<?php
    $retrievedata = mysqli_query($con, "SELECT * FROM registration");
    while($datarows = mysqli_fetch_array($retrievedata))
    {
        $adminid = $datarows['id'];
        $admindatetime = $datarows['datetime'];
        $adminname = $datarows['username'];
        $addedby = $datarows['addedby'];
?>
                    <tbody>
                        <tr>
                        <th scope="row"><?php echo $adminid; ?></th>
                        <td><?php echo $admindatetime; ?></td>
                        <td><?php echo $adminname; ?></td>
                        <td><?php echo $addedby; ?></td>
                        <td><a href="deleteadmin.php?id=<?php echo $adminid; ?>"> <span class="btn btn-danger"> Delete</span></a></td>
                        </tr>
<?php
    }
?>
                    </tbody>           
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-sm-12">
                <hr>
                <h6> Theme Developed by Bikash Sah</h6>
            </div>
        </div> -->
    </div>
</body>
</html>