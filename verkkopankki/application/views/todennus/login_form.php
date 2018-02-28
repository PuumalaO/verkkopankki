<?php
if(isset($logout_message))
{
     echo "<div>";
     echo $logout_message;
     echo "</div>";
}
 ?>

 <?php
if(isset($message_display))
{
     echo "<div>";
     echo $message_display;
     echo "</div>";
}
  ?>
<div class="container">
     <div class="col">

     </div>

     <div class="col">
          <h2>Kirjaudu sisään</h2>
          <hr>
          <?php echo form_open('todennus/kirjaudu'); ?>
          <?php
          echo "<div>";
          if(isset($error_message))
          {
               echo $error_message;
          }
          echo validation_errors();
          echo "</div>";
           ?>
           <form class="" action="<?php echo site_url('todennus/kirjaudu') ?> " method="post">

               <div class="form-group">
                   <label>Verkkopankkitunnus</label>
                  <input class="form-control" type="text" name="verkkopankkitunnus" placeholder="Verkkopankkitunnus"><br><br>
               </div>

                <div class="form-group">
                     <label>Salasana</label>
                     <input class="form-control" type="password" name="salasana" placeholder="************"><br><br>
                </div>
                <div class="form-group">
                     <input class="form-control" type="submit" name="submit" value="Kirjaudu">
                </div>
                <?php echo form_close(); ?>
           </form>
          </div>
          <div class="col">

          </div>
      </div>
