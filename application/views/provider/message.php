<?php if(isset($success)&& $success){?>
<div  id="success" class="alert alert-success"><?php echo $success?></div>
<?php }?>
<?php if(isset($error) && $error){?>
<div class="alert alert-danger"><?php echo $error?></div>
<?php }?>