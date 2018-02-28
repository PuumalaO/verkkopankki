<?php validation_errors(); ?>

<?php echo form_open('tilitiedot/add_kortti/'.$id) ?>
<div class="container" style="margin-top: 150px;">
     <h2> <?php echo $title; ?> </h2>

<div class="col"></div>

     <div class="form-group">
          <label for="salasana">Salasana</label>
          <input type="password" class="form-control" name="salasana"> <br><br>
     </div>

          <button type="submit" class="btn btn-primary">Lisää kortti</button>

<div style="margin-bottom: 150px;" class="col"></div>
</div>
