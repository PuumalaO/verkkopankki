<div class="container" style="margin-top: 150px;">

<div class="col">
     <p></p>
</div>
<div class="col">

<h2 style=" border-radius: 25px; text-align: center; margin-bottom: 20px;" class="bg-danger text-white">Varmista poisto</h2>
<p class="text-danger" style="font-weight: bold; margin-bottom: 50px; text-align: center;">Halutako varmasti poistaa tämän tilin?</p>
<div style="text-align: center;">
     <form class="" action="index.html" method="post">

<button type="submit" formaction="<?php echo site_url('tilitiedot/lataa_etusivu'); ?>" style=" margin-right: 100px;" class="btn btn-primary" type="button" name="button">Peruuta</button>
<button type="submit" formaction="<?php echo site_url('tilitiedot/delete_thistili/').$id; ?>" style="" class="btn btn-danger" type="button" name="button">Poista</button>
</form>
</div>
</div>
<div class="col">

</div>
</div>
