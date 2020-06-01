<?php
    include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>21M</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=B612+Mono|Cabin:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    
    <div class="header-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-lg-6 d-flex">
            <a href="#" class="site-logo">
              21M
            </a>

            <a href="#" class="ml-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>

          </div>
          <div class="col-12 col-lg-6 ml-auto d-flex">
            <div class="ml-md-auto top-social d-none d-lg-inline-block">
              <a href="#" class="d-inline-block p-3"><span class="icon-facebook"></span></a>
                <a href="#" class="d-inline-block p-3"><span class="icon-twitter"></span></a>
                <a href="#" class="d-inline-block p-3"><span class="icon-instagram"></span></a>
            </div>
            <form action="#" class="search-form d-inline-block">

              <div class="d-flex">
                <input type="text" class="form-control" placeholder="Search..." name="search">
                <button type="submit" class="btn btn-secondary" name="submit"><span class="icon-search"></span></button>
              </div>
            </form>

            
          </div>
          <div class="col-6 d-block d-lg-none text-right">
            
          </div>
        </div>
      </div>
      


      
      <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          
          <div class="mr-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
                <li class="active">
                  <a href="index.php" class="nav-link text-left">Home</a>
                </li>
                <li>
                  <a href="categories.php" class="nav-link text-left">Categories</a>
                </li>
                <li>
                  <a href="competition.php" class="nav-link text-left">Competitions</a>
                </li>
                <li>
                  <a href="sponsor.php" class="nav-link text-left">Wants to Sponsor?</a>
                </li>
                <li><a href="contact.php" class="nav-link text-left">Contact</a></li>
              </ul>                                                                                                                                                                                                                                                                                         
            </nav>

          </div>
         
        </div>
      </div>

    </div>
    
    </div>

    <div class="site-section py-0">
      
        <div class="site-section">
          <div class="container">
            <div class="half-post-entry d-block d-lg-flex bg-light">
            <?php
                    $maxview = mysqli_query($con, "SELECT MAX(views) FROM admin_panel");
                    while($maxviewpostretrieve = mysqli_fetch_array($maxview))
                    {
                        $maxviews = $maxviewpostretrieve[0];
                    }
                    $mostviewedpost = mysqli_query($con, "SELECT * FROM admin_panel WHERE views='$maxviews'");
                    while($retrievemaxviewpost = mysqli_fetch_array($mostviewedpost))
                    {
                        $mostviewedposttitle = $retrievemaxviewpost['title'];
                        $mostviewedpostimage = $retrievemaxviewpost['image'];
                        $mostviewedpostpost = $retrievemaxviewpost['post'];
                        $mostviewedpostauthor = $retrievemaxviewpost['author'];
                        $mostviewedpostdatetime = $retrievemaxviewpost['datetime'];
                        $mostviewedpostviews = $retrievemaxviewpost['views'];
                        $mostviewedpostid = $retrievemaxviewpost['id'];
                    } 
            ?>
              <div class="img-bg" style="background-image: url('upload/<?php echo $mostviewedpostimage; ?>');"></div>
              <div class="contents">
                <span class="caption">Most Viewed Blog</span>
                <h2><?php echo $mostviewedposttitle; ?></h2>
                <p class="mb-3"><h5> <?php
                if (strlen($mostviewedpostpost)>200){
                    $mostviewedpostpost = substr($mostviewedpostpost,0,300)."..........";
                }  
                echo $mostviewedpostpost; 
                ?></h5></p>
                <div class="post-meta">
                  <h6 style="color:black;"><?php echo "Author: {$mostviewedpostauthor}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Published: {$mostviewedpostdatetime}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Views: {$mostviewedpostviews}";  ?></h6>
                  <span><a href="fullblogpost.php?id=<?php echo $mostviewedpostid; ?>"> <span class="btn btn-info" style="float:right;"> Read More &rsaquo;&rsaquo; </span></a></span>
                </div>

            </div>
        </div>
    </div>

    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="section-title">
              <h2>Recent Blogs</h2>
            </div>
            <?php
                 if(isset($_GET['submit']))
                 {
                     $search = $_GET['search'];
                     $latestpost = mysqli_query($con, "SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR categoryname LIKE '%$search%'
                     OR title LIKE '%$search%' OR author LIKE '%$search%' OR post LIKE '%$search%'");
                     $pageid = null;
                 }
                elseif(isset($_GET['pageid']))
                {
                    $pageid = $_GET['pageid'];
                    if($pageid<1)
                    {
                        $pageid=1;
                    }
                    $startinglatestpost = ($pageid*5)-5;
                    $endinglatestpost = $startinglatestpost+5;
                    $latestpost = mysqli_query($con, "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $startinglatestpost,$endinglatestpost");    
                }
                else
                {
                    $pageid=1;
                    $latestpost = mysqli_query($con, "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5");
                }
                while($retrievelatestpost = mysqli_fetch_array($latestpost))
                {
                    $latestposttitle = $retrievelatestpost['title'];
                    $latestpostid = $retrievelatestpost['id'];
                    $latestpostdatetime = $retrievelatestpost['datetime'];
                    $latestpostimage = $retrievelatestpost['image'];
                    $latestpostauthor = $retrievelatestpost['author'];
                    $latestpostviews = $retrievelatestpost['views'];
                    $latestpostpost = $retrievelatestpost['post'];
                
            ?>
            <div class="thumbnail order-md-2" style="background-image: url('images/img_h_4.jpg')"></div>
            <div class="post-entry-2 d-flex">
              <div class="contents order-md-1 pl-0">
                <h2 style="font-size:30px; text-align:center; color:black;"><?php echo $latestposttitle; ?></h2>
                <img src="upload/<?php echo $latestpostimage; ?>" class="img-responsive img-fluid img-rounded" alt="Not Available Yet">
                <p class="mb-3"><h5><?php
                if (strlen($latestpostpost)>200){
                    $latestpostpost = substr($latestpostpost,0,300)."..........";
                }
                echo $latestpostpost; 
                ?></h5></p>
                <div class="post-meta">
                  <h6 style="color:black;"><?php echo "Author: {$latestpostauthor}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Published: {$latestpostdatetime}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Views: {$latestpostviews}";  ?></h6>
                  <span><a href="fullblogpost.php?id=<?php echo $latestpostid; ?>"> <span class="btn btn-info" style="float:right;"> Read More &rsaquo;&rsaquo; </span></a></span>
                </div>
              </div>
            </div>
            <hr>
            <?php
                }
            ?>
         </div>
            
          <div class="col-lg-3">
            <div class="section-title">
              <h2>Popular Posts</h2>
            </div>
            
            <?php
                $popularpost = mysqli_query($con, "SELECT * FROM admin_panel ORDER BY views desc LIMIT 0,5");
                $i=0;
                while($retrievepopularpost = mysqli_fetch_array($popularpost))
                {
                    $popularposttitle = $retrievepopularpost['title'];
                    $popularpostid = $retrievepopularpost['id'];
                    $popularpostdatetime = $retrievepopularpost['datetime'];
                    $popularpostimage = $retrievepopularpost['image'];
                    $popularpostauthor = $retrievepopularpost['author'];
                    $popularpostviews = $retrievepopularpost['views'];
                    $popularpostpost = $retrievepopularpost['post'];
                    $i++;
            ?>
            <div class="trend-entry d-flex">
              <div class="number align-self-start"><?php echo $i; ?></div>
              <div class="trend-contents">
                <h2><a href="fullblogpost.php?id=<?php echo $popularpostid; ?>"><?php echo $popularposttitle; ?> </a></h2>
                <div class="post-meta">
                  <h6 style="color:black;"><?php echo "Author: {$popularpostauthor}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Published: {$popularpostdatetime}"; ?></h6>
                </div>
              </div>
            </div>
            <?php
                }
            ?>
            
            <p>
              <a href="#" class="more">See All Popular <span class="icon-keyboard_arrow_right"></span></a>
            </p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                            if($pageid==1)
                            {
                        ?>
                        <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <?php
                            }
                            else
                            {
                        ?>
                        <li class="page-item">
                        <a class="page-link" href="index.php?pageid=<?php echo ($pageid-1); ?>" tabindex="-1">Previous</a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            $numofpostquery = mysqli_query($con, "SELECT * FROM admin_panel");
                            $numofpost = mysqli_num_rows($numofpostquery);
                            $numofpage = ceil($numofpost/5);
                            for ($j=1; $j<=$numofpage; $j++)
                            {
                            if($pageid==$j)
                            {
                        ?>
                        <li class="page-item active"><a class="page-link" href="index.php?pageid=<?php echo $pageid; ?>"><?php echo $j; ?></a></li>
                        <?php
                            }
                            else
                            {
                        ?>
                        <li class="page-itemss"><a class="page-link" href="index.php?pageid=<?php echo $j; ?>"><?php echo $j; ?></a></li>
                        <?php
                            }
                          }
                        ?>
                        <?php
                            if($pageid==$numofpage)
                            {
                        ?>
                        <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                        </li>
                        <?php
                            }
                            else
                            {
                        ?>
                        <li class="page-item">
                        <a class="page-link" href="index.php?pageid=<?php echo ($pageid+1); ?>">Next</a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </nav>
          </div>
        </div>

      </div>
    </div>

   
    <!-- END section -->


    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="section-title">
              <h2>Sports</h2>
            </div>
            <?php
              $categorypost = mysqli_query($con, "SELECT * FROM admin_panel WHERE categoryname='Sports'");
              while($retrievecategorypost = mysqli_fetch_array($categorypost))
              {
                    $categoryposttitle = $retrievecategorypost['title'];
                    $categorypostid = $retrievecategorypost['id'];
                    $categorypostdatetime = $retrievecategorypost['datetime'];
                    $categorypostimage = $retrievecategorypost['image'];
                    $categorypostauthor = $retrievecategorypost['author'];
                    $categorypostviews = $retrievecategorypost['views'];
                    $categorypostpost = $retrievecategorypost['post'];
            ?>
            <div class="post-entry-2 d-flex">
              <div class="thumbnail"><img src="upload/<?php echo $categorypostimage; ?>" class="img-responsive img-fluid img-rounded" alt="Not Available Yet"></div>
              <div class="contents">
                <h2><a href="blog-single.html"><?php echo $categoryposttitle; ?></a></h2>
                <p class="mb-3"><h5><?php 
                if (strlen($categorypostpost)>200){
                  $categorypostpost = substr($categorypostpost,0,300)."..........";
                }
                echo $categorypostpost; 
                ?></h5></p>
                <div class="post-meta">
                  <h6 style="color:black;"><?php echo "Author: {$categorypostauthor}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Published: {$categorypostdatetime}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Views: {$categorypostviews}";  ?></h6>
                </div>
              </div>
            </div>
            <hr>
            <?php
              }
            ?>
          </div>

          <div class="col-lg-6">
            <div class="section-title">
              <h2>Technology</h2>
            </div>
            <?php
              $categorypost = mysqli_query($con, "SELECT * FROM admin_panel WHERE categoryname='Technology'");
              while($retrievecategorypost = mysqli_fetch_array($categorypost))
              {
                    $categoryposttitle = $retrievecategorypost['title'];
                    $categorypostid = $retrievecategorypost['id'];
                    $categorypostdatetime = $retrievecategorypost['datetime'];
                    $categorypostimage = $retrievecategorypost['image'];
                    $categorypostauthor = $retrievecategorypost['author'];
                    $categorypostviews = $retrievecategorypost['views'];
                    $categorypostpost = $retrievecategorypost['post'];
            ?>
            <div class="post-entry-2 d-flex">
              <div class="thumbnail"><img src="upload/<?php echo $categorypostimage; ?>" class="img-responsive img-fluid img-rounded" alt="Not Available Yet"></div>
              <div class="contents">
                <h2><a href="blog-single.html"><?php echo $categoryposttitle; ?></a></h2>
                <p class="mb-3"><h5><?php 
                if (strlen($categorypostpost)>100){
                  $categorypostpost = substr($categorypostpost,0,300)."..........";
                }
                echo $categorypostpost; 
                ?></h5></p>
                <div class="post-meta">
                  <h6 style="color:black;"><?php echo "Author: {$categorypostauthor}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Published: {$categorypostdatetime}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Views: {$categorypostviews}";  ?></h6>
                </div>
              </div>
            </div>
            <hr>
            <?php
              }
            ?>
          </div>
      </div>
    </div>


    <div class="site-section subscribe bg-light">
      <div class="container">
      <div class="row">
          <div class="col-md-6">
            <h2>About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis aspernatur ut at quae omnis pariatur obcaecati possimus nisi ea iste!</p>
          <hr>
          </div>
          <div class="col-md-2">
          </div>
          <div class="col-md-4">
              
                  <h4><span class="fas fa-map-marker"></span> &nbsp; &nbsp;Balkumari</h4><hr>
                  <h4><span class="fas fa-mobile-alt"></span>&nbsp; &nbsp;+9779823457285</h4><hr>
                  <h4><span class="fas fa-envelope"></span>&nbsp; &nbsp;sahbikash999@gmail.com</h4><hr>
              
          </div>
          </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="copyright">
                <p style="text-align:center;">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="bikashsah.com.np"> @ 21M </a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    

  </div>
  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>