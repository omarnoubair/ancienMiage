<html>
    <script type="text/css">
    html {
color:black;
background-color:white;
background-image:url(<?php echo IMG . "/Paint.jpg"; ?>);
}    
    </script>

    <head>

    </head>

    <?php
    $i = 1;
    $page = 0;
    $max = -1;
    foreach ($allactu2 as $c) {
        $page = $page + 1;
    }
    for ($j = 0; $j < $page / 4; $j++) {
        $max = $max + 1;
    }
    ?>

    <div class="col-sm-9 col-md-8" >
        <div class="well" style="width:150%;text-align: center;">
            <div class="row" style="margin:0 auto;">

                <legend class="section-title" style="color: #204d74; text-align: left;">Actualités</legend>
                <?php
                foreach ($allactu as $a) {
                    if (!empty($a)) {
                        if ($i % 2 == 1) {
                            ?>
                            <div class="row">
                                <div class="col-md-4 text-center" style="width:50%;text-align: left;">
                                    <div class="box">
                                        <div class="box-content">
                                            <h1 class="tag-title"><?php echo $a->titre; ?></h1>
                                            <hr />
                                            <p><?php echo $a->desc; ?></p>
                                            <br />
                                            <a style="width:110px;margin-right: 0em" href="<?php echo BASE_URL . '/actualites/detail/' . $a->id ?>" class="btn btn-block btn-primary">Lire la suite ...</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-4 text-center" style="width:50%;text-align: left;">
                                    <div class="box">
                                        <div class="box-content">
                                            <h1 class="tag-title"><?php echo $a->titre; ?></h1>
                                            <hr />
                                            <p><?php echo $a->desc; ?></p>
                                            <br />
                                            <a style="width:110px;margin-left: 0em" href="<?php echo BASE_URL . '/actualites/detail/' . $a->id ?>" class="btn btn-block btn-primary">Lire la suite ...</a>
                                        </div>
                                    </div>
                                </div>


                            </div>          

                            <?php
                        }
                        $i++;
                    }
                }
                ?> 
            </div>
            <div class="container" style="margin:0 auto;display: inline-block; width: 50%">
                <ul class="pagination">
                    <li><a href="<?php echo BASE_URL . '/user/index/0' ?>">«</a></li>
                    <?php
                    $j = 0;
                    for ($j = 0; $j < $page / 4; $j++) {
                        ?>
                        <li><a href="<?php echo BASE_URL . '/user/index/' . $j ?>"><?php echo $j + 1; ?></a></li>
                    <?php } ?>
                    <li><a href="<?php echo BASE_URL . '/user/index/' . $max ?>">»</a></li>
                </ul>
            </div>

        </div>



    </div>
</div>
</html>