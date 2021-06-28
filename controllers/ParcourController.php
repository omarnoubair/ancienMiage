
<?php

class ParcourController extends Controller {
   
     public function __construct()
        {
        parent::__construct();
        //$this->view = new view();
       }
       
       
    public function Addparcour($id) {
        $this->view->render('user/Addparcour', true, true);
    }

    public function AddparcourAction($id) {
        $ste = $_POST['ste'];
        $pays = $_POST['pays'];
        $db = $_POST['db'];
        $df = $_POST['df'];
        $type = $_POST['type'];
        $ville = $_POST['ville'];
        $salaire = $_POST['salaire'];
        
        if(!isset($_POST['masquer'])){
            $var = 0;
        }else{
            $var=1;
        }
        
        $ParcourModel = $this->loadModel("parcour");
        $req = 'INSERT INTO `parcours` (id, id_user, debut, fin, salaire, entreprise, pays, ville, type, masque) VALUES ( NULL, ' . $id . ' ,"' . stripslashes($_POST['db']) . '","' . stripslashes($_POST['df']) . '",' . $salaire . ', "' . $ste . '" ,"' . $pays . '","' . $ville . '",' . $type . ',' . $var . ')';
        echo $req;
        $ParcourModel->query2($req);
        $this->EditParcours();
    }
    
    public function EditParcours() {
        if ($this->session->checkLogin()) {
            $eventModel = $this->loadModel('parcour');
            $sql= "SELECT * FROM `parcours`,labels WHERE labels.id_label = parcours.type AND id_user = " . $this->session->read('user')->id ;
            $parcours = $eventModel->query($sql);
            $this->view->set("parcours", $parcours);
            $this->view->render('user' . DS . 'editParcours', true, true);
        } else {
            $this->session->setNotification("Vous devez vous connecter pour accéder à cette page", "info");
            $this->redirect('user/login');
        }
    }
    
    public function ModifParcours($id) {
        if ($this->session->checkLogin()) {
            $eventModel = $this->loadModel('parcour');
            $sql= "SELECT * FROM `parcours` WHERE parcours.id = " . $id ;
            $parcours = $eventModel->query($sql);
            $this->view->set("parcours", $parcours);
            $this->view->render('user' . DS . 'ModifParcours', true, true);
        } else {
            $this->session->setNotification("Vous devez vous connecter pour accéder à cette page", "info");
            $this->redirect('user/login');
        }
    }
    
    public function DeleteParcours($id) {
        if ($this->session->checkLogin()) {
            $eventModel = $this->loadModel("parcour");
            $req = "DELETE FROM `parcours` WHERE `parcours`.`id` =" . $id;
            $event = $eventModel->query2($req);
            $this->EditParcours();
        } else {
            $this->redirect("error/error403");
        }
    }
    
    public function EditparcourAction($id) {
        if ($this->session->checkLogin()) {
            $eventModel = $this->loadModel('evenement');
            if(isset($_POST['masquer'])){$flag=1;}else{$flag=0;}
            $sql= "UPDATE `parcours` SET `entreprise`= '".$_POST['ste']."',`pays`='".$_POST['pays']."',`ville`='".$_POST['ville']."',`debut`='".$_POST['db']."',`fin`='".$_POST['df']."',`type`='".$_POST['type']."',`masque`='".$flag."' WHERE id = " . $id ;
            $event = $eventModel->query2($sql);
            $this->view->set("event", $event);
            $this->EditParcours();
        } else {
            $this->session->setNotification("Vous devez vous connecter pour accéder à cette page", "info");
            $this->redirect('user/login');
        }
    }
       
}
?>