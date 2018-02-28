<div class="container">
     <div class="col">

     </div>

<div class="col" style="text-align: center">
     <h2>Vaihda kortin salasana</h2>

<form class="" action="<?php echo site_url('tilitiedot/update_kortti'); ?>" method="post">
  <input type="hidden" name="idkortti" value="<?php echo $kortti[0]['idkortti'];?>">

  <label for="">Salasana</label><br>
  <input style="margin-bottom: 15px;" type="text" name="salasana" value="<?php echo $kortti[0]['salasana'];?>"><br>

  <input class="btn btn-primary" type="submit" name="" value="Tallenna">
  <a class="btn btn-danger" href="<?php echo site_url('tilitiedot/korttitieto'); ?>">Peruuta</a>
</form>

</div>
<div class="col">

</div>
</div>
