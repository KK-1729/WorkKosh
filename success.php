<?php 
    if($success != ""){ ?>
        <div class="errors alert alert-success alert-dismissible fade show" role="alert">
                <p><?php echo $success ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <?php } ?>
?>