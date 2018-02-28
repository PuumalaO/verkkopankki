
<div class="container" style="margin-top: 150px;">
     <h2> <?php echo $title; ?> </h2>

<div class="col"></div>

<form class="" action="<?php echo site_url('tilitiedot/talleta_raha'); ?>" method="post">
  <input type="hidden" name="idtili" value="<?php echo $tili[0]['idtili'];?>">

     <div class="form-group">
          <label for="summa">Summa</label>
          <input type="number" class="form-control" name="summa"> <br><br>
     </div>
  <input class="btn btn-primary" type="submit" name="" value="Talleta">
<div style="margin-bottom: 150px;" class="col"></div>
</div>
