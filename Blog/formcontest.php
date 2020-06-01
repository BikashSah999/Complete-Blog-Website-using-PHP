<?php
    include("include/db.php");
    include("include/session.php");
    $messagearray = array();
    if(isset($_POST['send']))
    {
        $idfromurl = $_GET['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $post = $_POST['comment'];
        date_default_timezone_set("Asia/Kathmandu");
        $currenttime = time();
        $datetime = strftime("%Y-%m-%d , %H-%M-%S", $currenttime);
        $number = $_POST['number'];
        if(empty($post) || strlen($post)<50)
        {
            $_SESSION['errormessage'] = "*Post should contain minimum 50 characters";
        }
        else
        {
            $query = mysqli_query($con, "INSERT INTO contestform(datetime, name, email, number, post, contest_id, approved, views, likes)
                    VALUES('$datetime','$name','$email','$number','$post','$idfromurl','OFF','0','0')");
            if($query)
            {
                $_SESSION['successmessage'] = "Submitted Successfully. It will be shown after being approved by admin. Thank you for Participating!!";
                header("Location: formcontest.php?id={$idfromurl}");
                exit();
            }
            else
            {
                $_SESSION['errormessage'] = "*Something Went Wrong";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php
        $idfromurl = $_GET['id'];
        $competitionpost = mysqli_query($con, "SELECT * FROM contest WHERE id='$idfromurl'");
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
                }
                echo $competitiontitle; 
        ?></title>
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

    

    <div class="site-section">
      <div class="container">
        <div class="row">
       
          <div class="col-lg-8 single-content">
          <h4 style="color:red;"><?php echo errormessage();
            echo successmessage();
            ?>
        </h4>
            <p class="mb-5">
              <img src="competition/<?php echo $competitionimage; ?>" alt="Image" class="img-fluid">
            </p>  
            <h1 class="mb-4">
              <?php echo $competitiontitle; ?>
            </h1>
            <div class="post-meta d-flex mb-5">
              <div class="vcard">
                <p><h5>
                    <?php echo "Description: {$competitiondescription}"; ?>
                </h5></p>
                <h6 style="color:black;"><?php echo "Prize: {$competitionprize}"; ?></h6>
                <h6 style="color:black;"><?php echo "Published Date: {$competitiondatetime}"; ?></h6>
                <h6 style="color:black;"><?php echo "Opening Date: {$competitionopen}"; ?></h6>
                <h6 style="color:black;"><?php echo "Closing Date: {$competitionend}"; ?></h6>
              </div>
            </div>

            
      
                    <div class="comment-form-wrap pt-5">
                      <div class="section-title">
                        <h2 class="mb-5">Submit your most funny moment</h2>
                      </div>
                      <form action="formcontest.php?id=<?php echo $idfromurl; ?>" method="POST" class="p-5 bg-light">
                        <div class="form-group">
                          <label for="name">Name *</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                          <label for="email">Email *</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                          <label for="Number">Number *</label>
                          <input type="number" class="form-control" id="number" name="number" required>
                        </div>
                        <div class="form-group">
                        <label for="comment" >Funny Moment</label>
                          <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Post Comment" class="btn btn-primary py-3" name="send">
                        </div>
      
                      </form>
                    </div>
                  </div>
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