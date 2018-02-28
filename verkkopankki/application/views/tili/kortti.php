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
<div style="margin-top: 100px;" class="container">

<div class="col">

</div>
<div style="text-align: center;" class="col">

<?php if(isset($message))
{
     echo $message;
} ?>
<h2 style="">Tervetuloa pankkiautomaattiin</h2>
<br><br>
<ul style="text-align: center;" class="navbar-nav mr-auto" >
     <li style="margin-bottom: 50px;" class="nav-item"> <a class="nav-link btn btn-primary" href="<?php echo  site_url('tilitiedot/nayta_korttisaldo/').$_SESSION['kortti'] ?>">Tarkista saldo</a> </li>
     <li class="nav-item"> <a class="nav-link btn btn-primary" href="<?php echo  site_url('tilitiedot/korttinosto/').$_SESSION['kortti'] ?>">Nosta rahaa</a> </li>
</ul>
</div>
<div class="col">

</div>
</div>
</body>
</html>
