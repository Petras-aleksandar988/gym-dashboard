<?php if (!isset($_SESSION['admin_id'])) {
   echo '<script type="text/javascript">window.location = "index.php"</script>';
    exit();
  }

  ?>