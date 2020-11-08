<?php if(count($errors)>0) : ?>
    <div class="errors alert alert-danger alert-dismissible fade show" role="alert">
            <p><?php echo $errors[0] ?></p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php  endif ?>