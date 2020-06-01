<?php
    include("include/db.php");
    $postid = $_GET['id'];
    $messagearray = array();
    $getviews = mysqli_query($con, "SELECT views FROM admin_panel where id='$postid'");
    while($viewretrive = mysqli_fetch_array($getviews))
    {
        $views = $viewretrive['views'];
        $views = $views+1;
    }
    $increaseview = mysqli_query($con, "UPDATE admin_panel SET views='$views' where id='$postid'");
    if(isset($_POST['send']))
    {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $comment = $_POST['comment'];
     
      date_default_timezone_set("Asia/Kathmandu");
      $currenttime = time();
      $currentdatetime = strftime("%Y-%m-%d %H-%M-%S", $currenttime);
      if(strlen($comment)>500)
      {
        array_push($messagearray, "Comment can't have more than 500 cahracters");
      }
      if(empty($messagearray))
      {
        $addcomment = mysqli_query($con, "INSERT INTO comment(datetime, name, email, comment, approvedby, status, admin_panel_id)
                                   VALUES('$currentdatetime','$name','$email','$comment','Pending','OFF','$postid')");
        array_push($messagearray, "Comment Submitted Successfully");
      }
    }
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php
    $postid = $_GET['id'];
    $fullpost = mysqli_query($con, "SELECT * FROM admin_panel WHERE id='$postid'");
    while($retrievefullpost = mysqli_fetch_array($fullpost))
    {
        $fullposttitle = $retrievefullpost['title'];
        $fullpostdatetime = $retrievefullpost['datetime'];
        $fullpostauthor = $retrievefullpost['author'];
        $fullpostimage = $retrievefullpost['image'];
        $fullpostviews = $retrievefullpost['views'];
        $fullpostpost = $retrievefullpost['post'];
        $fullpostcategory = $retrievefullpost['categoryname'];
    }
    echo $fullposttitle;
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

    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 single-content">
            <p class="mb-5">
              <img src="upload/<?php echo $fullpostimage; ?>" alt="Image" class="img-fluid">
            </p>  
            <h1 class="mb-4">
              <?php echo $fullposttitle; ?>
            </h1>
            <div class="post-meta d-flex mb-5">
              <div class="bio-pic mr-3">
                <img src="img/comment.png" alt="Image" class="img-fluidid">
              </div>
              <div class="vcard">
                <span class="d-block"><?php echo $fullpostauthor; ?></span>
                <span class="date-read"><?php echo $fullpostdatetime; ?></span>
              </div>
            </div>

            <p><h5>
                <?php echo $fullpostpost; ?>
                </h5>
            </p>


            <div class="pt-5">
                    <p>Categories:  <?php echo $fullpostcategory; ?></p>
                  </div>
      
      
                  <div class="pt-5">
                    <div class="section-title">
                      <h2 class="mb-5">
                          <?php
                            $numcomment = mysqli_query($con, "SELECT * FROM comment WHERE admin_panel_id='$postid'");
                            $numofcomment = mysqli_num_rows($numcomment);
                            echo "$numofcomment Comments";
                          ?>
                      </h2>
                    </div>
                    <ul class="comment-list">
                    <?php
                      $commentsquery = mysqli_query($con, "SELECT * FROM comment WHERE admin_panel_id='$postid' AND status='ON'");
                      while($retrievecomments = mysqli_fetch_array($commentsquery))
                      {
                          $commentdatetime = $retrievecomments['datetime'];
                          $commentcomment = $retrievecomments['comment'];
                          $commentname = $retrievecomments['name'];
                    ?>
                      <li class="comment">
                        <div class="vcard bio">
                          <img src="img/comment.png" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                          <h3><?php echo $commentname; ?></h3>
                          <div class="meta"><?php echo $commentdatetime; ?></div>
                          <p><?php echo $commentcomment; ?></p>
                        </div>
                      </li>
                      <?php
                      }
                      ?>
                    </ul>
                    <!-- END comment-list -->
                    
                    <div class="comment-form-wrap pt-5">
                      <div class="section-title">
                        <h2 class="mb-5">Leave a comment</h2>
                      </div>
                      <form action="fullblogpost.php?id=<?php echo $postid; ?>" method="POST" class="p-5 bg-light">
                        <div class="form-group">
                          <label for="name">Name *</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                          <label for="email">Email *</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                        <label for="comment" >Comment</label>
                          <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                          <?php
                              if(in_array("Comment can't be empty",$messagearray))
                              {
                                  echo "Email can't be empty";
                              }
                              elseif(in_array("Comment Shouldn't contain more than 500 characters",$messagearray))
                              {
                                  echo "Comment Shouldn't contain more than 500 characters";
                              }
                          ?>
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Post Comment" class="btn btn-primary py-3" name="send">
                        </div>
      
                      </form>
                    </div>
                  </div>
          </div>


          <div class="col-lg-3 ml-auto">
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
                  <span class="d-block"><?php echo $popularpostauthor; ?></span>
                  <span class="date-read"><?php echo $popularpostdatetime; ?></span></span>
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