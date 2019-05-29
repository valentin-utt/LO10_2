<?php
//include 'PDOConnect.php';

function generateProjectView($name,$pseudo,$cat,$place,$description,$img,$vid,$mode,$goal,$chef){
    
    
  
parse_str( parse_url( $vid, PHP_URL_QUERY ), $array );
$ytcode=$array['v'];

switch ($cat){
    case 'art':
        $categorie='art';
        break;
    case 'design_tech':
        $categorie='design et Technologie';
        break;
    case 'cinema':
        $categorie='cinema';
        break;
    case 'food':
        $categorie='gastronomie';
        break;
    case 'game':
        $categorie='jeux';
        break;
    case 'music':
        $categorie='musique';
        break;
    case 'edition':
        $categorie='edition';
        break;
    default :
        $categorie='';
        break;
}



echo "<div class='content_container'>";
echo "<div class='col-md-8'>"; 
echo "<table>\n";
echo "  <tr>\n";
echo "      <th   style='width: 800px;' colspan=\"2\">\n";
echo "          <h1>".$name."</h1>\n";
echo "          <h2>Un projet ".$categorie." </h2>\n";
echo "          \n";
echo "      </th>\n";
echo "      <th>\n";
//echo "          <h3>Objectif : ".$goal." €</h3>\n";
echo "      </th>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "      <td colspan=\"3\" style=\"text-align: center\">\n";
echo "          <br>\n";
echo "                <div style=\"width: 500px; height:500px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('".$img."');-moz-border-radius: 125px;webkit-border-radius: 250px;border-radius: 125px;\">\n";

echo "                </div>\n";
//echo "          <img src=\"".$img."\" width=\"500\" height=\"500\" alt=\"Image Projet\" style=\"display: inline-block\"/>\n";
echo "          <br>\n";
echo "          <h3>".$description."\n";
echo "                    </h3>\n";
echo "          <br>\n";
echo "                    <iframe width=\"720\" height=\"480\" src=\"https://www.youtube.com/embed/".$ytcode."\">\n";
echo "                    </iframe> \n";
echo "      </td>\n";
echo "  </tr>\n";
echo "</table> ";
echo "</div>";  


echo "<div class='col-md-4 jumbotron'>";
echo " <h3> ".$pseudo." </h3> ";
echo " <h4> Chef de projet </h4> ";
echo "<img src='".$chef['img_url']."'  ";


echo "</div>";  
echo "</div>"; 

  }
  
  
function generateProjectListViewItem2($project,$pseudo){
echo "<a  style='text-decoration:none; color:inherit;' href=./view?p=".$project['id'].">";
echo "<div class=\"row well\" style=\"margin: 20px;position: relative;\">\n";
echo "    <div class=\"col-sm-4\" >";
echo "          <div style=\"width: 200px; height:200px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('".$project['img']."');-moz-border-radius: 100px;webkit-border-radius: 50px;border-radius: 100px;\">\n";

echo "          </div>\n";
echo "    </div>\n";
echo "    <div class=\"col-sm-5\" >";

echo "                    <h2>".$project['name']."</h2>\n";
echo "                    <h3>Par ".$pseudo."</h3>\n";
echo "                    <p>".$project['place']."</p>\n";
echo "                    <p>".$project['mode']." : ".$project['goal']." €</p>\n";

echo "</div>\n";
echo "    <div class=\"col-sm-3\" style=\"position: absolute;bottom: 0;right: 0;\">";

echo "               <div class='progress' style='width:150px;height:20px;background-color: #c9dbbe;'>";
echo "                  <div class='progress-bar' role='progressbar' aria-valuenow='".$project['fund']."'  aria-valuemin='0' aria-valuemax='".$project['goal']."' style='width:".((100 * $project['fund']) / $project['goal'])."%'>";
echo "                      ".((100 * $project['fund']) / $project['goal'])."%";
echo "                  </div>";
echo "                      </div> ";
echo "              <p>".$project['fund']." € sur ".$project['goal']." €</p> ";


echo "</div>\n";

echo "  </div>";
echo "</a>";
}  
  
function generatePojectListViewItem($project,$pseudo){
    echo "<a  style='text-decoration:none; color:inherit;' href=./view?p=".$project['id'].">";
    echo "<div class=\"jumbotron\" style=\"padding: 10px;font-size: 15px;font-height: 1px;\">\n";
echo "            <table>\n";
echo "                <tr>\n";
echo "                <th>\n";
echo "                <div style=\"width: 200px; height:200px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('".$project['img']."');-moz-border-radius: 100px;webkit-border-radius: 50px;border-radius: 100px;\">\n";
//echo "                    <img src=\"". addslashes(($project['img']))."\"  style=\"width: 100%;height: 100%; object-fit: contain;\" alt=\"Project image\"/>\n";
echo "                </div>\n";
echo "                </th>\n";
echo "                <th>\n";
echo "                    <h2>".$project['name']."</h2>\n";
echo "                    <h3>Par ".$pseudo."</h3>\n";
echo "                    <p>".$project['place']."</p>\n";
echo "                    <p>".$project['mode']." : ".$project['goal']." €</p>\n";
echo "                </th>\n";
echo "                <th style=\"text-align: center;vertical-align: bottom; display: table-cell;\">\n";
//echo "          <progress value=".$project['fund']." max=".$project['goal']."></progress>\n";
echo "               <div class='progress' style='width:150px;height:20px;background-color: #c9dbbe;'>";
echo "                  <div class='progress-bar' role='progressbar' aria-valuenow='".$project['fund']."'  aria-valuemin='0' aria-valuemax='".$project['goal']."' style='width:".((100 * $project['fund']) / $project['goal'])."%'>";
echo "                      ".((100 * $project['fund']) / $project['goal'])."%";
echo "                  </div>";
echo "                      </div> ";
echo "              <p>".$project['fund']." € sur ".$project['goal']." €</p> ";


echo "                </th>\n";
echo "                </tr>\n";
echo "            </table>\n";
echo "        </div>";
echo "</a>";

} 

function generateProjectTable($projectArray){
    echo " <ol>";
    foreach ($projectArray as $project) {
            echo "<a href='./view?p=".$project['id']."'><li>".$project['name']."</li></a>";
        
    }
    echo " </ol>";
}


function generateUeTable($ueArray){
    echo " <ul>";
    foreach ($ueArray as $ues) {
            echo "<a href='https://etu.utt.fr/uvs/search?q=".$ues['ue_sigle']."'><li>".$ues['ue_sigle']."</li></a>";
        
    }
    echo " </ul>";
}

function generateProfileView($pictureUrl, $fullname, $branch, $level, $speciality, $projectArray, $ueArray){
    
    echo "            <div style=\"overflow: hidden;\">\n";
echo "            <img style=\"float: left\" src=\" ".$pictureUrl. " \" alt=\"".$fullname."\">\n";
echo "            <h3>".$fullname."</h3>\n";
echo "             <br>";
echo "            <h3>".$branch.$level." ".$speciality."</h3>\n";
echo "            <input style=\"float: right\"  class=\"btn btn-default\" type=\"submit\" value=\"contacter\">\n";
echo "         </div>\n";
echo "        \n";
echo "       \n";
echo "        <div class=\"catbox-container\">\n";
echo "            \n";
echo "            <div class=\"jumbotron catbox\">\n";
echo "                <h3>Dirige</h3>\n";
generateProjectTable($projectArray);
echo "                <hr>\n";
echo "          \n";
echo "            </div>\n";
echo "        \n";
echo "            <div class=\"jumbotron catbox\">\n";
echo "                <h3>Supporte</h3>\n";
echo "          \n";
echo "            </div>\n";
echo "                \n";
echo "        \n";
echo "            <div class=\"jumbotron catbox\">\n";
echo "                    <h3>Aime</h3>\n";
echo "            </div>\n";
echo "               \n";
echo "            \n";
echo "            <div class=\"jumbotron catbox\">\n";
echo "                   <h3>UE suivies</h3>\n";
generateUeTable($ueArray);
echo "            </div>\n";
echo "            \n";
echo "        </div> ";


  
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

