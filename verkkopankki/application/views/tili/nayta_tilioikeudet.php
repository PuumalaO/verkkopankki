<div class="container">

     <div class="col">

     </div>
     <div class="col">

<h2><?php echo $title; ?></h2>

<table style="table-layout: fixed;" class="table">
     <thead class="thead-light">
     <?php     if (isset($_SESSION['user']) && $_SESSION['user'] != 'admin')
          { ?>
               <th><?php echo "Tili ID"; ?></th>
               <th></th>
               <th></th>
               <th></th>
          <?php    }     ?>
          <?php if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')
          { ?>
               <th><?php echo "Tili ID"; ?></th>
               <th><?php echo "Tilioikeus ID"; ?></th>
               <th><?php echo "Asiakas ID"; ?></th>
          <th><?php echo "Verkkopankkitunnus"; ?></th>
          <th></th>
          <?php    }     ?>
     </thead>

     <?php foreach ($tilidata as $tilitieto): ?>
               <tr>
                    <?php     if (isset($_SESSION['user']) && $_SESSION['user'] != 'admin')
                         { ?>
                                 <td><?php echo $tilitieto['idtili']; ?></td>
                                 <td><a  href="<?php echo site_url('tilitiedot/nayta_saldo/').$tilitieto['idtili']?>"><button class="btn btn-primary" type="button" name="button">Näytä saldo</button></a></td>
                                 <td><a  href="<?php echo site_url('tilitiedot/talletus/').$tilitieto['idtili']?>"><button class="btn btn-primary" type="button" name="button">Talleta rahaa</button></a></td>
                                <td><a  href="<?php echo site_url('tilitiedot/rahansiirto/').$tilitieto['idtili']?>"><button class="btn btn-primary" type="button" name="button">Tilisiirto</button></a></td>
             <?php    }     ?>
                  <?php
                  if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin')
                  {
                       ?>
                       <td><?php echo $tilitieto['idtili']; ?></td>
                       <td><?php echo $tilitieto['idtilioikeudet']; ?></td>
                       <td><?php echo $tilitieto['idasiakas']; ?></td>
                       <td><?php echo $tilitieto['verkkopankkitunnus']; ?></td>
                      <td><a class="btn btn-primary" href="<?php echo site_url('tilitiedot/edit_login/').$tilitieto['idtilioikeudet']?>">Muokkaa</a> </td>
             <?php    }     ?>
             </tr>
        <?php endforeach; ?>
</table>
</div>
<div class="col">

</div>
</div>
