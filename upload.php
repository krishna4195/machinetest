<?php
  if(is_array($_FILES)) {
    if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
      $sourcePath = $_FILES['userImage']['tmp_name'];
      $targetPath = "images/".$_FILES['userImage']['name'];
      if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img class="img-fluid" width="100%" height="100" src="<?php echo $targetPath; ?>" />
<?php
  }
    }
      }
?>