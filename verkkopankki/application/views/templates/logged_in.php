<?php if (isset($_SESSION['user']))
{
     echo "<div>";
     echo "<p class='.bg-success'>Olet kirjautunut onnistuneesti sisään tunnuksella ".$_SESSION['user']."</p>";
     echo "</div>";
}

else
{

}
?>
