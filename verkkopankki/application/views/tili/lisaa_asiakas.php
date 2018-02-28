

<?php validation_errors(); ?>

<?php echo form_open('tilitiedot/add_asiakas') ?>
<div class="container" style="margin-top: 150px;">
<?php echo $message ?>
     <h2> <?php echo $title; ?> </h2>

<div class="col"></div>

     <div class="form-group">
          <label for="etunimi">Etunimi</label>
          <input type="text" class="form-control" name="etunimi"> <br><br>
     </div>

     <div class="form-group">
          <label for="sukunimi">Sukunimi</label>
          <input type="text" class="form-control" name="sukunimi"> <br><br>
     </div>

     <div class="form-group">
          <label for="verkkopankkitunnus">Verkkopankkitunnus</label>
          <input type="text" class="form-control" name="verkkopankkitunnus"> <br><br>
     </div>

     <div class="form-group">
          <label for="salasana">Salasana</label>
          <input type="password" class="form-control" name="salasana"> <br><br>
     </div>

          <button type="submit" class="btn btn-primary">Lisää asiakas</button>

<div style="margin-bottom: 150px;" class="col"></div>
</div>
