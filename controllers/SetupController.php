<?php

class SetupController extends Controller {
  
    public function __construct() {
        parent::__construct();
        $this->view = new view();
    }
    public function index() {
        if(!file_exists(ROOT.DS.'configuration'.DS.'conf.ini')){
       // echo ("test");
         $this->view->render('setup' . DS . 'index',false,false,true);
        
        }else{
            $this->redirect("error/error404");
        }
    }
     public function install() {
        if(!file_exists(ROOT.DS.'configuration'.DS.'conf.ini')){
        
          $this->view->render('setup' . DS . 'install',false,false,true);
        
        }else{
            $this->redirect("error/error404");
        }
    }
    public function installAction() {
        if(!file_exists(ROOT.DS.'configuration'.DS.'conf.ini')){
            
        if(empty($_POST["base"])){
            $error=true;
        }
         if(empty($_POST["user"])){
             $error=true;
        }
         if(empty($_POST["host"])){
             $error=true;
        }
        if(empty($_POST["adminPass"])){
             $error=true;
        }
         if(empty($_POST["adminUser"])){
             $error=true;
        }
            
        if(isset($error)){
           $this->session->setNotification("Veuillez remplir tous les champs","warning");
            $this->redirect("setup/install");
        }
          
        try {
            $pdo = new PDO(
                'mysql:host='.$_POST['host'].';dbname='.$_POST['base'].';',
                $_POST['user'],
                $_POST['pass'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
$database = array(
                'database' => array(
                    'host' => $_POST['host'],
                    'user' => $_POST['user'],
                    'password' => $_POST['pass'],
                    'base' => $_POST['base'],
                  
                ));
               

$s = $this->write_ini_file($database, ROOT.DS.'configuration'.DS.'conf.ini', true,true);
            //$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$this->createTables($pdo,true);
  Model::$connection=$pdo;
$userModel = $this->loadModel("user");


/*populating the table*/
//creating admin
$sql='INSERT INTO `users` (`id`, `role`, `pseudo`, `password`, `nom`, `prenom`, `mail`, `tel`, `photo`) VALUES(1,0,"admin","'.md5($_POST['adminPass']).'","admin","admin","'.$_POST['adminUser'].'","","")';

$userModel->query($sql);
 
   $this->session->setNotification("L'installation a été effectuée avec succès<br>Veuillez vous connecter à votre compte","success");
         $this->redirect("index");  
            
        } catch (PDOException $e) {
            $this->session->setNotification("Impossible de se connecter à la base de données.<br>Veuillez vérifier que la base existe et que les informations saisie sont valide","warning");
               $this->redirect("setup/install");     
            }
      
        
        }else{
            $this->redirect("error/error404");
        }
        
    }
   private function write_ini_file($assoc_arr, $path, $has_sections=FALSE,$innerCall=false) { 
       if($innerCall){
    $content = ""; 
    if ($has_sections) { 
        foreach ($assoc_arr as $key=>$elem) { 
            $content .= "[".$key."]\n"; 
            foreach ($elem as $key2=>$elem2) { 
                if(is_array($elem2)) 
                { 
                    for($i=0;$i<count($elem2);$i++) 
                    { 
                        $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                    } 
                } 
                else if($elem2=="") $content .= $key2." = \n"; 
                else $content .= $key2." = \"".$elem2."\"\n"; 
            } 
        } 
    } 
    else { 
        foreach ($assoc_arr as $key=>$elem) { 
            if(is_array($elem)) 
            { 
                for($i=0;$i<count($elem);$i++) 
                { 
                    $content .= $key."[] = \"".$elem[$i]."\"\n"; 
                } 
            } 
            else if($elem=="") $content .= $key." = \n"; 
            else $content .= $key." = \"".$elem."\"\n"; 
        } 
    } 

    if (!$handle = fopen($path, 'w')) { 
        return false; 
    }

    $success = fwrite($handle, $content);
    fclose($handle); 

    return $success; 
       }else{
            $this->redirect("error/error404");
       }
}

private function createTables($pdo,$innerCall=false){
    if($innerCall){
    $sql='

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategorie` int(11) NOT NULL,
  `idprof` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` varchar(256) NOT NULL,
  `doc` varchar(200) NOT NULL,
  `video` varchar(200) NOT NULL,
  `lvl` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idprof` (`idprof`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcourse` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcourse` (`idcourse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `followers` (
  `iduser` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idevaluation` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idevaluation` (`idevaluation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

CREATE TABLE IF NOT EXISTS `reports` (
  `iduser` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idquestion` int(11) NOT NULL,
  `response` varchar(200) NOT NULL,
  `response_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `idquestion` (`idquestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

CREATE TABLE IF NOT EXISTS `studentevaluations` (
  `iduser` int(11) NOT NULL,
  `idevaluation` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `photo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`idprof`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`idcourse`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`idevaluation`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE;

ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`idquestion`) REFERENCES `questions` (`id`) ON DELETE CASCADE;
';
 
    try {
        $pdo->exec($sql);
       return true;
    }catch (PDOException $e) {
            return false;
 }
 
    }else{
         $this->redirect("error/error404");
    }
}





}
