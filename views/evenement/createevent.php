
<div class="col-sm-9 col-md-8">
    <div class="well">
    <?php echo ( $this->session->getNotification()); ?>
    <h1 class="section-title"> Créer Un événement</h1> 
    <form id="question-form"class="question form-horizontal" method="post" action="<?php echo BASE_URL . "/evenement/createEventAction/".$this->session->read('user')->id ?>" enctype="multipart/form-data">
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="titre">Titre</label>
            <div class="col-md-4 control-label">
                <input id="titre" name="titre" type="text" placeholder="Titre" class="form-control input-md" >  
            </div>
        </div>

        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Description</label>
            <div class="col-md-0">
                <textarea placeholder="Description..." rows="0" name="description" id="description" class="form-control required "></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="selectbasic">Date</label>
            <div class="col-md-5">
                <input id="date" name="date" type="date" placeholder="Titre" class="form-control input-md" >  
            </div>
        </div>

        <!-- File Button --> 
        <div class="form-group">
            <label class="col-md-4 control-label" for="document">Image</label>
            <div class="col-md-4">
<!--                <input id="document" name="document" class="input-file" type="file">-->
                <input type="file" name="document" id="document" class="input-file">
            </div>
        </div> 
        <div class="form-group">
            <div class="form-group col-md-11">
                <input id="evaluationTitleSubmit"type="submit" value="valider" class="btn btn-primary  pull-right">
            </div>
        </div>
    </form>



</div>
</div>
</div>

</div>
</div>

</div>
</div>
