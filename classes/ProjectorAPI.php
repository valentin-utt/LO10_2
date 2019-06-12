<?php



include('./Interface/IProjectorAPI.php');
include 'RDSHandler.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author val-r
 */
class ProjectorAPI implements IProjectorAPI {
    
    
    public function __construct() {
        
    }
    
    public function xml_encode($mixed, $domElement = null, $DOMDocument = null) {
        if (is_null($DOMDocument)) {
            $DOMDocument = new DOMDocument;
            $DOMDocument->formatOutput = true;
            $this->xml_encode($mixed, $DOMDocument, $DOMDocument);
            echo $DOMDocument->saveXML();
        } else {
            if (is_array($mixed)) {
                foreach ($mixed as $index => $mixedElement) {
                    if (is_int($index)) {
                        if ($index === 0) {
                            $node = $domElement;
                        } else {
                            
                            $node = $DOMDocument->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    } else {
                        $plural = $DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node = $plural;
                        //if (!(rtrim($index, 's') === $index)) {
                        //    $singular = $DOMDocument->createElement(rtrim($index, 's'));
                        //    $plural->appendChild($singular);
                        //    $node = $singular;
                        //}
                    }

                    $this->xml_encode($mixedElement, $node, $DOMDocument);
                }
            } else {
                $mixed = is_bool($mixed) ? ($mixed ? 'true' : 'false') : $mixed;
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }
    }
    
    function GET(int $projectid, string $format) {
        $RDSHandler= new RDSHandler();
        $response=$RDSHandler->getProjectById($RDSHandler->getBase(), $projectid);
        var_dump(count($response));
        if(count($response)==0){
                $result["succes"]=false;
                $result["message"]="Projet introuvable";
                $result["results"]["nb"] = count($response);
                $result["results"]["project"] = $response; 
                $RDSHandler->setResult($result);
            }else{
                $result["succes"]=true;
                $result["message"]="Voici le projet demandé";
                $result["results"]["nb"] = count($response);
                $result["results"]["project"] = $response;
                $RDSHandler->setResult($result);
        }
        
        if ($format=='application/json'){
            return json_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
        elseif ($format=='application/xml') {
            return $this->xml_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
    }
    
    function GET_ALL(string $format) {
        $RDSHandler= new RDSHandler();
        $response=$RDSHandler->listProject($RDSHandler->getBase());
        //var_dump(count($response));
        if(count($response)==0){
                $result["succes"]=true;
                $result["message"]="Pas de Projets trouvés";
                $result["results"]["nb"] = count($response);
                $result["results"]["project"] = $response; 
                $RDSHandler->setResult($result);
            }else{
                $result["succes"]=true;
                $result["message"]="Voici les projet demandé";
                $result["results"]["nb"] = count($response);
                $result["results"]["project"] = $response;
                $RDSHandler->setResult($result);
        }
        
        if ($format=='application/json'){
            return json_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
        elseif ($format=='application/xml') {
            return $this->xml_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
    }
    
    function PUT($project, string $format) {
        

        
    }
    
    function POST( $project, string $format) {
       $RDSHandler= new RDSHandler(); 
       $RDSHandler->addProject($RDSHandler->getBase(), $project->getOwner(), $project->getName(),  $project->getCat(),  $project->getDes(),  $project->getPlace(),  $project->getImg(),  $project->getVid(),  $project->getMode(),  $project->getGoal(),  $project->getlon(),  $project->getLat(), $project->getFund() );
       $RDSHandler->setResult($result);
       $result["succes"] = true;
       $result["message"] = "Projet ajouté";
       $RDSHandler->setResult($result);
        if ($format=='application/json'){
            return json_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
        elseif ($format=='application/xml') {
            return $this->xml_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
        
    }
    
    function DELETE(int $Projectid, string $format){
        $RDSHandler= new RDSHandler(); 
       $response=$RDSHandler->deleteProject($RDSHandler->getBase(),$Projectid  );
      // $RDSHandler->setResult($result);
               //var_dump($response);
        if(is_null($response)){
                $result["succes"]=false;
                $result["message"]="Projet introuvable";
                $RDSHandler->setResult($result);
            }else{
       $result["succes"] = true;
       $result["message"] = "Projet Supprimé";
                $RDSHandler->setResult($result);
        }

       $RDSHandler->setResult($result);
        if ($format=='application/json'){
            return json_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
        elseif ($format=='application/xml') {
            return $this->xml_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
        
    }
    
}
