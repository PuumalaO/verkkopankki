<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <head>
          <meta charset="utf-8">
          <title></title>
     </head>
     <body>

          <ul style="margin: 50px 0px 0px 50px;" class="navbar-nav mr-auto" style="text-decoration: none;">
               <li style="width: 200px;" class="nav-item"> <a class="nav-link btn btn-primary" href="<?php echo  site_url('todennus/kortti_logout')?>">Palaa verkkopankkiin</a> </li>
               <li style="margin-top: 15px; width: 200px;" class="nav-item"> <a class="nav-link btn btn-primary" href="<?php echo  site_url('todennus/lataa_pankkiautomaatti')?>">Palaa pankkiautomaattiin</a> </li>

          </ul>

          <div class="container">
               <div class="col">
               </div>
                    <div style="margin-top: 100px; text-align: center;" class="col">

                              <h2><?php echo"Tilisi saldo on ".$tilitieto."€"; ?></h2>

                    </div>
               <div class="col">
               </div>

          </div>
     </body>
</html>
