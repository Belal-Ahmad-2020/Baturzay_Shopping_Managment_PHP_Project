<?php
if (isset($_SESSION['msg'])) {
?>
<p style="font-size:16px;" class="text-center <?php echo  $_SESSION['type'] ?>">
    <?php
    echo $_SESSION['msg'];
    ?>
</p>
<?php
  unset($_SESSION['msg']);
  unset($_SESSION['type ']);
   ?>
<?php   
}
?>