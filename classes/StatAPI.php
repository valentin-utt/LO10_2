<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatAPI
 *
 * @author val-r
 * 
 * 
 */
include('./Interface/IStatAPI.php');

class StatAPI implements IStatAPI {
    
     public function xml_encode($mixed, $domElement = null, $DOMDocument = null) {
        if (is_null($DOMDocument)) {
            $DOMDocument = new DOMDocument;
            $DOMDocument->formatOutput = true;
            $this->xml_encode($mixed, $DOMDocument, $DOMDocument);
            echo $DOMDocument->saveXML();
        } else {
            if (is_array($mixed)) {
                foreach ($mixed as $index => $mixedElement) {
                    //var_dump($index);
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

    function GET(string $format, string $cat, float $range, float $long, float $lat) {
        $RDSHandler = new RDSHandler();
        $response = $RDSHandler->listProject($RDSHandler->getBase());
        if ($cat == "") {
            $response = $RDSHandler->listProject($RDSHandler->getBase());
            $totalFund = $RDSHandler->totalFundProject($RDSHandler->getBase());
            $avgFundByProject = $RDSHandler->avgFundProject($RDSHandler->getBase());
            $avgFundByUser = $RDSHandler->avgFundUser($RDSHandler->getBase());
            $maxFundByUser = $RDSHandler->maxFundUser($RDSHandler->getBase());
            $minFundByUser = $RDSHandler->minFundUser($RDSHandler->getBase());
            $minFundByProject = $RDSHandler->minFundProject($RDSHandler->getBase());
            $maxFundByProject = $RDSHandler->avgFundProject($RDSHandler->getBase());
        } else {
            $response = $RDSHandler->listProjectByCat($RDSHandler->getBase(), $cat);
            $totalFund = $RDSHandler->totalFundProjectbyCat($RDSHandler->getBase(), $cat);
            $avgFundByProject = $RDSHandler->avgFundProjectbyCat($RDSHandler->getBase(), $cat);
            $maxFundByUser = $RDSHandler->maxFundUserbycat($RDSHandler->getBase(), $cat);
            $minFundByUser = $RDSHandler->minFundUserbyCat($RDSHandler->getBase(), $cat);
            $avgFundByUser = $RDSHandler->avgFundUserbyCat($RDSHandler->getBase(), $cat);
            $minFundByProject = $RDSHandler->minFundProjectbyCat($RDSHandler->getBase(), $cat);
            $maxFundByProject = $RDSHandler->maxFundProjectbyCat($RDSHandler->getBase(), $cat);
        }

        //var_dump($totalFund);
        //var_dump($avgFundByProject);
        //var_dump($avgFundByUser);

        if (count($response) == 0) {
            $result["succes"] = true;
            $result["message"] = "Pas de Projets trouvés dans la base de donnée";
            $result["results"]["nb"] = count($response);
            $result["services_list"] = "etu.utt.fr;LO10/api/project;LO10/api/stats;";
            $RDSHandler->setResult($result);
        } else {
            if ($cat == "") {
                $result["succes"] = true;
                $result["message"] = "Voici les statistiques";
                $result["categorie"] = "toutes";
                $result["results"]["nb"] = count($response);
                $result["results"]["total_dons"] = $totalFund[0][0];
                $result["results"]["moyenne_financement_par_projets"] = $avgFundByProject[0][0];
                $result["results"]["minimum_financement_par_projets"] = $minFundByProject[0][0];
                $result["results"]["maximum_financement_par_projets"] = $maxFundByProject[0][0];
                $result["results"]["moyenne_dons_par_utilisateur"] = $avgFundByUser[0][0];
                $result["results"]["maximum_dons_par_utilisateurs"] = $minFundByUser[0][0];
                $result["results"]["minimum_dons_par_utilisateurs"] = $maxFundByUser[0][0];
                $result["services_list"] = "etu.utt.fr;LO10/api/project;LO10/api/stats;";
                $RDSHandler->setResult($result);
            } else {
                $result["succes"] = true;
                $result["message"] = "Voici les statistiques";
                $result["categorie"] = $cat;
                $result["results"]["nb"] = count($response);
                $result["results"]["total_dons"] = $totalFund[0][0];
                $result["results"]["moyenne_financement_par_projets"] = $avgFundByProject[0][0];
                $result["results"]["minimum_financement_par_projets"] = $minFundByProject[0][0];
                $result["results"]["maximum_financement_par_projets"] = $maxFundByProject[0][0];
                $result["results"]["moyenne_dons_par_utilisateur"] = $avgFundByUser[0][0];
                $result["results"]["minimum_dons_par_utilisateurs"] = $minFundByUser[0][0];
                $result["results"]["maximum_dons_par_utilisateurs"] = $maxFundByUser[0][0];
                $result["services_list"] = "etu.utt.fr;LO10/api/project;LO10/api/stats;";
                $RDSHandler->setResult($result);
            }
        }

        if ($format == 'application/json') {
            return json_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        } elseif ($format == 'application/xml') {
            return $this->xml_encode(mb_convert_encoding($RDSHandler->getResult(), 'UTF-8', 'UTF-8'));
        }
    }

}
