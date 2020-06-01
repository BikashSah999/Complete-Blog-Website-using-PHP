<?php
include('include/db.php');
include('include/session.php');
include('include/function.php');
confirmlogin();

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    date_default_timezone_set("Asia/Kathmandu");
    $currenttime = time();
    $datetime = strftime("%Y-%m-%d %H-%M-%S", $currenttime);
    $creatorname = $_SESSION['Adminname'];
    if(empty($name))
    {
        $_SESSION['errormessage'] = "*All the fields must be filled" ;
        header("Location:category.php");
        exit();
    }
    elseif(strlen($name)>99)
    {
        $_SESSION['errormessage'] = "*Should be less than 99 characters" ;
        header("Location:category.php");
        exit();   
    }
    else
    {
        $insert = mysqli_query($con, "INSERT INTO category(datetime, name, creatorname) VALUES ('$datetime','$name','$creatorname')");
        $_SESSION['successmessage'] = 'Category Added Succesfully';
        header("Location:category.php");
        exit();
    }
}
?>
<html>
<head>
<title> Manage Category</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="CSS/adminstyle.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">21M</a>

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
                <h1>CMS </h1>
                <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link admin" href="dashboard.php"><span class="fas fa-th"></span>&nbsp;Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="addnewpost.php"><span class="fas fa-list-alt"></span>&nbsp;Add New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active admin" href="#"><span class="fas fa-tags"></span>&nbsp;Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="admins.php"><span class="fas fa-users"></span>&nbsp;Manage Admins</a>
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
                <h1> Manage Category</h1>
                <?php
                    echo errormessage();
                    echo successmessage();
                ?>
                <form action="category.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name"  placeholder="Category Name" name="name">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>

                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Date and Time</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Creator Name</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
<?php
    $retrievedata = mysqli_query($con, "SELECT * FROM category");
    while($datarows = mysqli_fetch_array($retrievedata))
    {
        $id = $datarows['id'];
        $datetime = $datarows['datetime'];
        $categoryname = $datarows['name'];
        $creatorname = $datarows['creatorname'];
?>
                    <tbody>
                        <tr>
                        <th scope="row"><?php echo $id; ?></th>
                        <td><?php echo $datetime; ?></td>
                        <td><?php echo $categoryname; ?></td>
                        <td><?php echo $creatorname; ?></td>
                        <td><a href="deletecategory.php?id=<?php echo $id; ?>"> <span class="btn btn-danger"> Delete</span></a></td>
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