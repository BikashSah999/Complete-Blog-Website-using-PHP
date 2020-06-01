<?php
    include("include/db.php");
    include("include/session.php");
    include("include/function.php");
    confirmlogin();
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
                    <a class="nav-link active admin" href="#"><span class="fas fa-th"></span>&nbsp;Dashboard</a>
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
                <h1> Admin Dashboard </h1>
                <?php echo successmessage(); ?>

                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Date and Time</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Banner</th>
                        <th scope="col">Comments</th>
                        <th scope="col">Action</th>
                        <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <?php
                        $id = 0;
                        $retrievedata = mysqli_query($con, "SELECT * FROM admin_panel ORDER BY datetime desc");
                        while($datarows = mysqli_fetch_array($retrievedata))
                        {
                            $postid = $datarows['id'];
                            $postdate = $datarows['datetime'];
                            $title = $datarows['title'];
                            $category = $datarows['categoryname'];
                            $admin = $datarows['author'];
                            $image = $datarows['image'];
                            $post = $datarows['post'];
                            $id++;
                    ?>
                    <tbody>
                        <tr>
                        <th scope="row"><?php echo $id; ?></th>
                        <td><?php
                         if(strlen($title)>20)
                         {
                             $title = substr($title,0,20)."....";
                         }
                        echo $title; ?></td>
                        <td><?php echo $postdate; ?></td>
                        <td><?php echo $admin; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><img src="upload/<?php echo $image;?>" width="100" height="50"></td>
                        <td>
                        <?php
                            $approvedcomment = mysqli_query($con, "SELECT * FROM comment WHERE status='ON' AND admin_panel_id='$postid'");
                            $numapproved = 0;
                            while($retrieveapproved = mysqli_fetch_array($approvedcomment))
                            {
                                $numapproved++;
                            }
                            $unapprovedcomment = mysqli_query($con, "SELECT * FROM comment WHERE status='OFF' AND admin_panel_id='$postid'");
                            $numunapproved = 0;
                            while($retrieveunapproved = mysqli_fetch_array($unapprovedcomment))
                            {
                                $numunapproved++;
                            }
                        ?>
                        <h4><?php echo $numapproved;?> &nbsp;&nbsp;&nbsp;<span> <?php echo $numunapproved;?></span> </h4>
                        </td>
                        <td><a href="editblogpost.php?id=<?php echo $postid; ?>"> <span class="btn btn-info"> Edit</span></a>
                        <a href="deleteblogpost.php?id=<?php echo $postid; ?>"> <span class="btn btn-danger"> Delete</span></a></td>
                        <td><a href="fullblogpost.php?id=<?php echo $postid; ?>"> <span class="btn btn-success"> Live Preview</span></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>           
                    </table>
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