<div class="container">
     <div class="col">

     </div>
<div class="col">
     <h2><?php echo $title; ?></h2>

<table style="table-layout: fixed;" class="table">
     <thead class="thead-light">
          <th><?php echo "Tilin ID"; ?></th>
          <th><?php echo "Tilin saldo"; ?></th>
     <?php     if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')
          {
              ?> <th></th>
              <th></th>
<?php    }     ?>
     </thead>

     <?php foreach ($tilidata as $tilitieto): ?>
               <tr>
                  <td><?php echo $tilitieto['idtili']; ?></td>
                  <td><?php echo $tilitieto['saldo']."€"; ?></td>
                  <?php
                  if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')
                  {
                       ?>
                       <td> <a href="<?php echo site_url('tilitiedot/add_kortti/').$tilitieto['idtili']?>"><button class="btn btn-primary"  type="button" name="button">Lisää kortti</button></a></td>
                       <td> <a href="<?php echo site_url('tilitiedot/verify_tilidelete/').$tilitieto['idtili']?>"><button class="btn btn-danger"  type="button" name="button">Poista tili</button></a></td>
     <?php    }     ?>
             </tr>
        <?php endforeach; ?>
</table>
</div>
<div class="col">

</div>
</div>
