<div class="container">
     <div class="col">

     </div>
     <div class="col">

<table class="table">
     <thead class="thead-light">
          <th><?php echo "Asiakkaan ID"; ?></th>
          <th><?php echo "Etunimi"; ?></th>
          <th><?php echo "Sukunimi"; ?></th>
          <?php
          if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')
          { ?>
          <th></th>
          <th></th>
          <th></th>
          <?php    }     ?>
     </thead>

     <?php foreach ($asiakasdata as $asiakastieto): ?>
               <tr>
                  <td><?php echo $asiakastieto['idasiakas']; ?></td>
                  <td><?php echo $asiakastieto['etunimi']; ?></td>
                  <td><?php echo $asiakastieto['sukunimi']; ?></td>
                  <?php
                  if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')
                  {?>
                  <td><a  href="<?php echo site_url('tilitiedot/edit_asiakas/').$asiakastieto['idasiakas']?>"><button class="btn btn-primary" type="button" name="button">Muokkaa</button></a> </td>
                  <td><a  href="<?php echo site_url('tilitiedot/add_tili/').$asiakastieto['idasiakas']?>"><button class="btn btn-primary" type="button" name="button">Lisää tili</button></a> </td>
                  <td> <a href="<?php echo site_url('tilitiedot/verify_delete/').$asiakastieto['idasiakas']?>"><button class="btn btn-danger"  type="button" name="button">Poista</button></a></td>
             <?php    }     ?>
             <?php endforeach ?>


</table>
</div>
<div class="col">

</div>
</div>
