<?php
    include("include/db.php");
    include('include/session.php');
    $errormessage = array();
if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $category = $_POST['category'];
    $post = $_POST['post'];
    date_default_timezone_set("Asia/Kathmandu");
    $currenttime = time();
    $datetime = strftime("%Y-%m-%d %H-%M-%S", $currenttime);
    $adminname = "Bikash sha";
    $image = $_FILES["image"]["name"];
    $target = "upload/".basename($_FILES['image']['name']);
    if(empty($title))
    {
        $error= "*Title must be filled" ;
        array_push($errormessage, $error);
    }
    if(strlen($title)>99)
    {
        $error = "* Title Should be less than 99 characters" ;
        array_push($errormessage, $error);
    }

    if(empty($post))
    {
        $error= "*Post must be filled" ;
        array_push($errormessage, $error);
    }

    if(empty($errormessage))
    {
        $editid = $_GET['editid'];
        $update = mysqli_query($con, "UPDATE admin_panel SET datetime='$datetime', title='$title', categoryname='$category', image='$image', post='$post' WHERE id='$editid'");
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $_SESSION['successmessage'] = 'Post Updated Succesfully';
        header("location:dashboard.php");
        exit();
    }
}
?>
<html>
<head>
<title> Admin Dashboard </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="CSS/adminstyle.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Bikash Blog</a>

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
                <h1> Bikash Sah </h1>
                <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link admin active" href="#"><span class="fas fa-th"></span>&nbsp;Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="addnewpost.php"><span class="fas fa-list-alt"></span>&nbsp;Add New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="category.php"><span class="fas fa-tags"></span>&nbsp;Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="#"><span class="fas fa-users"></span>&nbsp;Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="#"><span class="fas fa-comment"></span>&nbsp;Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="#"><span class="fas fa-blog"></span>&nbsp;Live Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link admin" href="#"> <span class="fas fa-sign-out-alt"></span>&nbsp;Log Out</a>
                </li>
                </ul>
            </div>
            <div class="col-sm-10">
                <h1> Edit Post </h1>

                <?php
                if(in_array("Category Added Succesfully",$errormessage)){
                    echo 'Category Added Succesfully';
                }
                ?>

                <form action="editblogpost.php?editid=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <?php
                    $getidfromurl = $_GET['id'];
                    $getdata = mysqli_query($con, "SELECT * FROM admin_panel WHERE id='$getidfromurl'");
                    while($datarows = mysqli_fetch_array($getdata))
                    {
                
                        $titletobeupdated = $datarows['title'];
                        $categorytobeupdated = $datarows['categoryname'];
                        $imagetobeupdated = $datarows['image'];
                        $posttobeupdated = $datarows['post'];

                    }
                ?>
                    <label for="title" name='title'>Title</label>
                    <input type="text" class="form-control" id="title" value="<?php echo $titletobeupdated; ?>" name="title">
                    <?php
                        if(in_array("*Title must be filled",$errormessage))
                        {
                            echo "*Title must be filled";
                        } 
                        if(in_array("* Title Should be less than 99 characters",$errormessage))
                        {
                            echo "* Title Should be less than 99 characters";
                        } 

                    ?>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" placeholder="Category" name="category">
                    <option><?php echo $categorytobeupdated; ?></option>
                    <?php
                        $retrievedata = mysqli_query($con, "SELECT * FROM category");
                        while($datarows = mysqli_fetch_array($retrievedata))
                        {
                            $categoryname = $datarows['name'];
                    ?>
                    <option><?php echo $categoryname; ?></option>
                    <?php } 
                    
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <p>Existing Image: <span><img src="upload/<?php echo $imagetobeupdated;?>" width="100" height="50"> </span><br>
                    <label for="image">Select Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="post" >Post</label>
                    <textarea class="form-control" id="post" rows="3" name="post"> <?php echo $posttobeupdated; ?> </textarea>
                    <?php
                        if(in_array("*Post must be filled",$errormessage))
                        {
                            echo "*Post must be filled";
                        } 
                    ?>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
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