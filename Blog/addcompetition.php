<?php
    include("include/db.php");
    include("include/session.php");
    include("include/function.php");
    confirmlogin();
    $messagearray=array();
    if(isset($_POST['register']))
    {
        $title = $_POST['title'];
        $prize = $_POST['prize'];
        $description = $_POST['description'];
        date_default_timezone_set("Asia/Kathmandu");
        $currenttime = time();
        $datetime = strftime("%Y-%m-%d , %H-%M-%S", $currenttime);
        $open = strftime("%Y-%m-%d  , %H-%M-%S", ($currenttime+21600));
        $end = strftime("%Y-%m-%d  ,  %H-%M-%S", ($currenttime+196000));
        $image = $_FILES['image']['name'];
        $target = "competition/".basename($_FILES['image']['name']);
        $adminname = $_SESSION['Adminname'];
        if(strlen($description)>500)
        {
            array_push($messagearray,"Description should contain less than 500 characters");
        }
        else
        {
            $insert = mysqli_query($con, "INSERT INTO contest(title, prize, description, image, open, end, datetime, addedby) VALUES
                        ('$title','$prize','$description','$image','$open','$end','$datetime','$adminname')");
            if($insert)
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $_SESSION['successmessage'] = "Competition added successfully";
                header("Location: addcompetition.php");
                exit();
            }
            else
            {
                $_SESSION['errormessage'] = "Something Went Wrong";
            }
        }
    }
?>
<html>
<head>
<title> Add Competition </title>
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
                <h1> CMS </h1>
                <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link  admin" href="dashboard.php"><span class="fas fa-th"></span>&nbsp;Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="addnewpost.php"><span class="fas fa-list-alt"></span>&nbsp;Add New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="category.php"><span class="fas fa-tags"></span>&nbsp;Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="admins.php"><span class="fas fa-users"></span>&nbsp;Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active admin" href="addcompetition.php"><span class="fas fa-users"></span>&nbsp;Add Competition</a>
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
                <h1> Add Competition</h1>
                <?php
                    echo errormessage();
                    echo successmessage();
                ?>
                <form action="addcompetition.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title"  placeholder="Title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description"  placeholder="Description" name="description" required>
                </div>
                <div class="form-group">
                    <label for="image">Select Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="prize">Prize:</label>
                    <input type="text" class="form-control" id="prize"  placeholder="Prize" name="prize" required>
                </div>           
                <button type="submit" class="btn btn-primary" name="register">Submit</button>
                </form>

                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Date and Time</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prize</th>
                        <th scope="col">Open</th>
                        <th scope="col">Close</th>
                        <th scope="col">Image</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php
                        $retrievedata = mysqli_query($con, "SELECT * FROM contest ORDER BY id desc");
                        while($datarows = mysqli_fetch_array($retrievedata))
                        {
                            $competitionid = $datarows['id'];
                            $competitiondatetime= $datarows['datetime'];
                            $competitiontitle = $datarows['title'];
                            $competitionprize = $datarows['prize'];
                            $competitiondescription= $datarows['description'];
                            $competitionopen = $datarows['open'];
                            $competitionend = $datarows['end'];
                            $competitionimage= $datarows['image'];
                            $competitionadded = $datarows['addedby'];
                    ?>
                    <tbody>
                        <tr>
                        <th scope="row"><?php echo $competitionid; ?></th>
                        <td><?php echo $competitiondatetime; ?></td>
                        <td><?php echo $competitiontitle; ?></td>
                        <td><?php echo $competitiondescription; ?></td>
                        <td><?php echo $competitionprize; ?></td>
                        <td><?php echo $competitionopen; ?></td>
                        <td><?php echo $competitionend; ?></td>
                        <td><img src="competition/<?php echo $competitionimage;?>" width="100" height="50"></td>
                        <td><?php echo $competitionadded; ?></td>
                        <td><a href="deletecompetition.php?id=<?php echo $competitionid; ?>"> <span class="btn btn-danger"> Delete</span></a></td>
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