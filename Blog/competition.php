<?php
    include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Competitions</title>
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
            <a href="index.php" class="site-logo">
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
                <li>
                  <a href="index.php" class="nav-link text-left">Home</a>
                </li>
                <li>
                  <a href="categories.php" class="nav-link text-left">Categories</a>
                </li>
                <li class="active">
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

    

    
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="section-title">
              <h2>Recent Competitions</h2>
            </div>
            <?php
                $competitionpost = mysqli_query($con, "SELECT * FROM contest ORDER BY id desc");
                while($datarows = mysqli_fetch_array($competitionpost))
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
            <div class="thumbnail order-md-12" style="background-image: url('images/img_h_4.jpg')"></div>
            <div class="post-entry-2 d-flex">
              <div class="contents order-md-12 pl-0">
                <h2 style="font-size:30px; text-align:center; color:black;"><?php echo $competitiontitle; ?></h2>
                <img src="competition/<?php echo $competitionimage; ?>" class="img-responsive img-fluid img-rounded" alt="Not Available Yet">
                <p class="mb-3"><h5><?php
                  echo ("Description: {$competitiondescription}");
                ?></h5></p>
                <div class="post-meta">
                  <h6 style="color:black;"><?php echo "Prize: {$competitionprize}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Published Date: {$competitiondatetime}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Opening Date: {$competitionopen}"; ?></h6>
                  <h6 style="color:black;"><?php echo "Closing Date: {$competitionend}"; ?></h6>
                  <span><a href="formcontest.php?id=<?php echo $competitionid; ?>"> <span class="btn btn-info" style="float:right;"> Participate &rsaquo;&rsaquo; </span></a></span><br>
                  <span><a href="formcontest.php?id=<?php echo $competitionid; ?>"> <span class="btn btn-info" style="float:right;"> Participate &rsaquo;&rsaquo; </span></a></span>
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

       

    </div>

   
    <!-- END section -->



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