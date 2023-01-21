<?php
function createHeader()
{
  return <<<END
      <!DOCTYPE html>
      <html lang="en">
      
        <head>
      
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
          <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      
          <title>Cyborg - Awesome HTML5 Template</title>
      
          <!-- Bootstrap core CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
      
      
          <!-- Additional CSS Files -->
          <link rel="stylesheet" href="assets/css/fontawesome.css">
          <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
          <link rel="stylesheet" href="assets/css/owl.css">
          <link rel="stylesheet" href="assets/css/animate.css">
          <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
      
        </head>
      
      <body>
      
        <!-- ***** Preloader Start ***** -->
        <div id="js-preloader" class="js-preloader">
          <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
        <!-- ***** Preloader End ***** -->
      
        <!-- ***** Header Area Start ***** -->
        <header class="header-area header-sticky">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <nav class="main-nav">
                          <!-- ***** Logo Start ***** -->
                          <a href="index.html" class="logo">
                              <img src="assets/images/logo.png" alt="">
                          </a>
                          <!-- ***** Logo End ***** -->
                          <!-- ***** Search End ***** -->
                          <div class="search-input">
                            <form id="search" action="#">
                              <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                              <i class="fa fa-search"></i>
                            </form>
                          </div>
                          <!-- ***** Search End ***** -->
                          <!-- ***** Menu Start ***** -->
                          <ul class="nav">
                              <li><a href="index.html" class="active">Home</a></li>
                              <li><a href="browse.html">Browse</a></li>
                              <li><a href="details.html">Details</a></li>
                              <li><a href="streams.html">Streams</a></li>
                              <li><a href="profile.html">Profile <img src="assets/images/profile-header.jpg" alt=""></a></li>
                          </ul>   
                          <a class='menu-trigger'>
                              <span>Menu</span>
                          </a>
                          <!-- ***** Menu End ***** -->
                      </nav>
                  </div>
              </div>
          </div>
        </header>
        <main class="container">
      END;
}

function createNotLoggedHeader()
{
  return <<<END
        <!DOCTYPE html>
        <html lang="es">
          <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
              crossorigin="anonymous"
            />
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="../styles/style.css">
            <title>VideoGames</title>
          </head>
          <body>
            <main class="d-flex flex-column overflow-hidden">
        END;
}

function createFooter()
{
  return <<<END
        </main>
        <footer>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <p>Copyright © 2036 <a href="#">Cyborg Gaming</a> Company. All rights reserved. 
              
              <br>Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a>  Distributed By <a href="https://themewagon.com" target="_blank" >ThemeWagon</a></p>
            </div>
          </div>
        </div>
      </footer>
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
      <script src="assets/js/isotope.min.js"></script>
      <script src="assets/js/owl-carousel.js"></script>
      <script src="assets/js/tabs.js"></script>
      <script src="assets/js/popup.js"></script>
      <script src="assets/js/custom.js"></script>
    </body>
    
    </html>
  
  END;
}
?>