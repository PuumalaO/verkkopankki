<div class="container">
     <div class="col">

     </div>
<div class="col">
     <h2><?php echo $title; ?></h2>

<table style="table-layout: fixed;" class="table">
     <thead class="thead-light">
          <th><?php echo "Kortin ID"; ?></th>
          <th><?php echo "Tilin ID"; ?></th>
          <th><?php echo "Kortin salasana"; ?></th>
              <th></th>
              <th></th>
     </thead>

     <?php foreach ($korttidata as $korttitieto): ?>
               <tr>
                  <td><?php echo $korttitieto['idkortti']; ?></td>
                  <td><?php echo $korttitieto['idtili']; ?></td>
                  <td><?php echo $korttitieto['salasana']; ?></td>
                  <td> <a href="<?php echo site_url('tilitiedot/edit_kortti/').$korttitieto['idkortti']?>"><button class="btn btn-primary"  type="button" name="button">Muokkaa</button></a></td>
                  <td> <a href="<?php echo site_url('tilitiedot/verify_korttidelete/').$korttitieto['idkortti']?>"><button class="btn btn-danger"  type="button" name="button">Poista kortti</button></a></td>
             </tr>
        <?php endforeach; ?>
</table>
</div>
<div class="col">

</div>
</div>
