<div class="container">
     <div class="col">

     </div>

<div class="col" style="text-align: center">
     <h2>Muokkaa asiakkaan tiedot</h2>

<form class="" action="<?php echo site_url('tilitiedot/update_asiakas'); ?>" method="post">
  <input type="hidden" name="idasiakas" value="<?php echo $asiakas[0]['idasiakas'];?>">

  <label for="">Etunimi</label><br>
  <input type="text" name="etunimi" value="<?php echo $asiakas[0]['etunimi'];?>"><br>

  <label for="">Sukunimi</label><br>
  <input style="margin-bottom: 15px;" type="text" name="sukunimi" value="<?php echo $asiakas[0]['sukunimi'];?>"><br>

  <input class="btn btn-primary" type="submit" name="" value="Tallenna">
  <a class="btn btn-danger" href="<?php echo site_url('tilitiedot/asiakastieto'); ?>">Peruuta</a>
</form>

</div>
<div class="col">

</div>
</div>
