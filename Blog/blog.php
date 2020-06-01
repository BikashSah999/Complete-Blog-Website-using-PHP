<?php
    include("include/db.php");
?>
<html>
<head>
<title> Blog </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link type="text/css" rel="stylesheet" href="CSS/blogstyle.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">21M</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"> Blog <span class="sr-only">(current)</span> </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Category</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="blog.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
                </form>
            </div>
        </nav>
        <div>
            <br>
        </div>
        <div class="row">
        <div class="col-lg-8">
            <h1 class="text-center"> Latest Blogs</h1>
            <?php
            if(isset($_GET['submit']))
            {
                $search = $_GET['search'];
                $query = mysqli_query($con, "SELECT * FROM admin_panel WHERE datetime LIKE '%$search' OR categoryname LIKE '%$search'
                OR title LIKE '%$search' OR author LIKE '%$search' OR post LIKE '%$search'");
            }
            elseif(isset($_GET['Page']))
            {
                $pageid = $_GET['Page'];
                if($pageid<1)
                {
                    $pageid = 1;
                }
                $startingpost = ($pageid * 5)-5;
                $endingpost = $startingpost+5;
                $query = mysqli_query($con, "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $startingpost,$endingpost");
            }
            else
            {
                $pageid = 1;
                $query = mysqli_query($con, "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5");
            }

            while($datarows=mysqli_fetch_array($query))
                {
                    $postid = $datarows['id'];
                    $postdate = $datarows['datetime'];
                    $title = $datarows['title'];
                    $category = $datarows['categoryname'];
                    $admin = $datarows['author'];
                    $image = $datarows['image'];
                    $post = $datarows['post'];
            ?>
            <div class="thumbnil">
                    <img src="upload/<?php echo $image; ?>" class="img-responsive img-fluid img-rounded" alt="Not Available Yet">
                    <div class="caption">
                        <h1 id="heading"> <?php echo $title; ?> </h1>
                        <p> Author:<?php echo $admin; ?> &nbsp; &nbsp; Published Date:<?php echo $postdate; ?> </p>
                        <p> <?php
                            if (strlen($post)>200){
                                $post = substr($post,0,200)."..........";
                            } 
                            echo $post; 
                            ?> 
                        </p>
                    </div>
                    <a href="fullblogpost.php?id=<?php echo $postid; ?>"> <span class="btn btn-info"> Read More &rsaquo;&rsaquo; </span></a>
            </div> 
            <?php       
                }
            ?>
        
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    if($pageid==1){ ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    <?php }
                    else{ ?>
                        <li class="page-item">
                            <a class="page-link" href="blog.php?Page=<?php echo ($pageid-1); ?>" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    <?php } ?>
                    <?php
                    $getnumofpost = mysqli_query($con, "SELECT * FROM admin_panel");
                    $numofpost = mysqli_num_rows($getnumofpost);
                    $postperpage = ceil($numofpost/5);
                    for($i=1;$i<=$postperpage;$i++)
                    {
                        if($i == $pageid){?>
                    <li class="page-item active"><a class="page-link" href="blog.php?Page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                    <?php } 
                        else{?>
                    <li class="page-item"><a class="page-link" href="blog.php?Page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php }}    ?>
                    <?php
                    if($pageid==$postperpage)
                    { ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    <?php 
                    }
                    else{ ?>
                        <li class="page-item">
                            <a class="page-link" href="blog.php?Page=<?php echo ($pageid+1); ?>">Next</a>
                        </li>    
                    <?php } ?>

                </ul>
            </nav>
            
        </div>

        <div class="col-lg-4">
            <h1> Machine Learning </h1>
        </div>
        </div>
    </div>    
</body>
</html>