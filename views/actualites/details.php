<?php
foreach ($actu as $e) {
    $id = $e->id;
    $titre = $e->titre;
    $desc = $e->desc;
    $image = $e->image;
}
?>

<div class="col-sm-9 col-md-8">
    <div class="well">

        <h1 class="section-title"> <?php echo $titre  ?></h1> 
            <img src="<?php echo BASE_URL . DS . 'docs' . DS. $image ?>" alt="<?php echo $image ; ?>" width="800" height="500" >
        
<br/>
<br/>
<br/>
<br/>
        <?php
        echo $desc ;
        ?>
</div>
    </div>
