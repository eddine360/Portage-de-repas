<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portage de repas à domicile</title>
    
    <!--    Stylesheet Files    -->
    <link rel="stylesheet" href="lib/css/normalize.css" />
    <link rel="stylesheet" href="lib/css/foundation.min.css" />
    <link rel="stylesheet" href="lib/css/main.css" />
    

	
    <!--    Javascript files are placed before </body>    -->
  </head>
  
  <body>
    <!--  Start Hero Section  -->
    <section class="hero">
      <header>
        <div class="row">
          

          <nav class="top-bar" data-topbar role="navigation">
            
            <!--    Start Logo    -->
            <ul class="title-area">
              <li class="name">
                <a href="index.php" class="logo">
                  <h1>SIG<span class="tld">web</span></h1>
                </a>
              </li>
                <span class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></span>
              </li>
            </ul>  
            <!--    End Logo    -->

			
			
            <!--    Start Navigation Menu    -->
            <section class="top-bar-section">
              <ul class="right">
                <li><a href="">Actualités</a></li>
                <?php
					if(isset($_SESSION['id'])){echo '<li><a href="index.php?controller=compte&action=deconnect">Deconnection</a></li>';}
					else{echo '<li><a href="index.php?controller=compte&action=create">Connexion</a></li>';}
				
				?>
				             
              </ul>
      		</section>
			             
            <!--    End Navigation Menu    -->

          </nav>
        </div>
      </header>