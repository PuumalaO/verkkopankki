<!DOCTYPE html>
<html style="height: 100%">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300" rel="stylesheet">
<?php
if (isset($_SESSION['user']))
{  ?>
     <div class="alert alert-primary" style="margin: 15px 0 15px 0;">
<?php       echo "Tervetuloa ".$_SESSION['user'].""; ?>
<a style="float: right;" href="<?php echo site_url('todennus/kirjaudu_ulos')?>">Kirjaudu ulos</a></div>
     </div>
<?php    }

else {    ?>
     <div class="alert alert-primary" style="margin: 15px 0 15px 0;">
          Et ole kirjautunut
<a style="float: right;" href="<?php echo site_url('todennus/index')?>">Kirjaudu sisään</a></div>

<?php     }
?>

  <head>

       <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Puumalan pankki</title>
  </head>
  <body style="padding-bottom: 100px; position: relative;margin: 0; min-height: 100%;">
       <div class="">

       </div>
       <nav style="font-size: 40px; background-color: #b5b5b5; border-radius:30px; margin-bottom: 15px;" style="background-color: #FF0000"class="navbar navbar-expand-sm">
           <div>
                <ul class="navbar-nav mr-auto">
                     <li class="nav-item">
                          <a class="nav-link" href=" <?php echo site_url('tilitiedot/lataa_etusivu') ?> ">Etusivu</a>
                     </li>
                     <?php
                     if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')
                     {
                     echo "<div>";
                     echo "<li class='nav-item'><a class='nav-link' href=".site_url('tilitiedot/add_asiakas').">Lisää asiakas</a></li>";
                     echo "</div>";

                     echo "<div>";
                     echo "<li class='nav-item'><a class='nav-link' href=".site_url('tilitiedot/asiakastieto').">Näytä asiakastiedot</a></li>";
                     echo "</div>";

                     echo "<div>";
                     echo "<li class='nav-item'><a class='nav-link' href=".site_url('tilitiedot/tilitieto').">Näytä tilitiedot</a></li>";
                     echo "</div>";

                     echo "<div>";
                     echo "<li class='nav-item'><a class='nav-link' href=".site_url('tilitiedot/korttitieto').">Näytä korttitiedot</a></li>";
                     echo "</div>";

                     echo "<div>";
                     echo "<li class='nav-item'><a class='nav-link' href=".site_url('tilitiedot/tilioikeustieto').">Näytä tilioikeustiedot</a></li>";
                     echo "</div>";

               }
               elseif (isset($_SESSION['user']))
               {
                    echo "<div>";
                    echo "<li class='nav-item'><a class='nav-link' href=".site_url('tilitiedot/user_asiakastieto').">Näytä asiakastiedot</a></li>";
                    echo "</div>";

                    echo "<div>";
                    echo "<li class='nav-item'><a class='nav-link' href=".site_url('tilitiedot/user_tilioikeustieto').">Näytä tilitiedot</a></li>";
                    echo "</div>";

                    echo "<div>";
                    echo "<li class='nav-item'><a class='nav-link' href=".site_url('todennus/kortti').">Pankkiautomaatti</a></li>";
                    echo "</div>";
               }?>


                </ul>
           </div>

       </nav>
