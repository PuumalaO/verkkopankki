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
          </ul>

<div style="margin-top: 150px;" class="container">

<div class="col">
     <h2>Kirjaudu pankkiautomaattiin</h2>
     <hr>
     <?php echo form_open('todennus/kortti_kirjaudu'); ?>
     <?php
     echo "<div>";
     if(isset($message))
     {
          echo $message;
     }
     echo validation_errors();
     echo "</div>";
      ?>
      <form class="" action="<?php echo site_url('todennus/kortti_kirjaudu') ?> " method="post">

           <div class="form-group">
                <label>Kortin ID</label>
                <input class="form-control" type="number" name="idkortti"><br><br>
           </div>

           <div class="form-group">
                <label>Kortin salasana</label>
                <input class="form-control" type="password" name="salasana" placeholder="*****"><br><br>
           </div>

           <div class="form-group">
                <input class="form-control" type="submit" name="submit" value="Kirjaudu">
           </div>
           <?php echo form_close(); ?>
      </form>
     </div>
     <div class="col">

     </div>
</div>
</div>
</body>
</html>
