<?php
    if(isset($_SESSION['message'])) :
?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p style="text-align:center;"><strong >Hey!</strong> <?= $_SESSION['message']; ?></p>
     </div>

<?php 
    unset($_SESSION['message']);
    endif;
?>