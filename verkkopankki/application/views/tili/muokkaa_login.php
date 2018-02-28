<div class="container">


<div class="col">

</div>
<div style="text-align: center;"class="col">

<h2>Muokkaa asiakkaan kirjautumistiedot</h2>
<form class="" action="<?php echo site_url('tilitiedot/update_login'); ?>" method="post">
  <input type="hidden" name="idtilioikeudet" value="<?php echo $asiakas[0]['idtilioikeudet'];?>">

  <input type="hidden" name="idasiakas" value="<?php echo $asiakas[0]['idasiakas'];?>">

  <input type="hidden" name="idtili" value="<?php echo $asiakas[0]['idtili'];?>">

  <label for="">Tunnus</label><br>
  <input type="text" name="verkkopankkitunnus" value="<?php echo $asiakas[0]['verkkopankkitunnus'];?>"><br>

  <label for="">Salasana</label><br>
  <input type="text" name="salasana"><br>
<div style="margin-top: 15px;" class="">

  <input class="btn btn-primary" type="submit" name="" value="Tallenna">
  <a class="btn btn-danger" href="<?php echo site_url('tilitiedot/lataa_etusivu'); ?>">Peruuta</a>
</div>
</form>
</div>
<div class="col">

</div>
</div>
