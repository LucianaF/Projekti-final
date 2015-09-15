<!DOCTYPE html>
<html>
    <head>
        <meta  charset="UTF-8">
         <link rel="shortcut icon" href="favicon.ico" >
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/StylesSheet.css"/>
    
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">             
            </div>
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Kryefaqe</a></li>
                    <li><a href="Coffee.php">Projektet</a></li>
                    <li><a href="Management.php">Manaxhimi</a></li>
                    <li><a href="#">Perreth</a></li>
                    <li><a href="#">Kontakt</a></li>
                    
                </ul>
            </nav>
            
            <div id="content_area">
                <?php echo $content; ?>
            </div>
            
            <div id="sidebar">
                
            </div>
            
            <footer>
              <p>Made BY Luciana Fani</p>
          </footer>
      </div>>
    </body>
</html>
