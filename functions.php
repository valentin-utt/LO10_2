<?php

//include 'PDOConnect.php';

function generateProjectView($id, $name, $pseudo, $cat, $place, $description, $img, $vid, $mode, $goal, $chef, $liked, $user_id, $fund) {



    parse_str(parse_url($vid, PHP_URL_QUERY), $array);
    $ytcode = $array['v'];

    switch ($cat) {
        case 'art':
            $categorie = 'art';
            break;
        case 'design_tech':
            $categorie = 'design et Technologie';
            break;
        case 'cinema':
            $categorie = 'cinema';
            break;
        case 'food':
            $categorie = 'gastronomie';
            break;
        case 'game':
            $categorie = 'jeux';
            break;
        case 'music':
            $categorie = 'musique';
            break;
        case 'edition':
            $categorie = 'edition';
            break;
        default :
            $categorie = '';
            break;
    }



    echo "<div class='content_container'>";
    echo "<div class='col-lg-8'>";
    echo "<table>\n";
    echo "  <tr>\n";

    echo "      <th   style='width: 800px;' colspan=\"2\">\n";
    echo "  <div class='row'>\n";
    echo "  <div class='col-lg-6'>\n";
    echo "          <h1>" . $name . "</h1>\n";
    echo "          <h2>Un projet " . $categorie . " </h2>\n";
    echo "</div>";
    echo "  <div class='col-lg-6'>\n";
    echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"POST\">";
    echo "<input id=\"projectId\" name=\"projectId\"  name=\"projectId\" type=\"hidden\" value=\"" . $id . "\" />";
    if ($user_id != "none") {
        echo "<input id=\"userId\" name=\"userId\" type=\"hidden\" value=\"" . $user_id . "\" />";
    }
//echo "<input style='float: right' data-toggle=\"button\" aria-pressed=\"false\" autocomplete=\"off\"  class=\"btn btn-info \" type=\"submit\" value=\"❤\">\n";
    echo " </form>";
    if ($liked == "notConnected") {
        echo "";
    }
    else if ( !empty($liked) && $liked[0]['project_id'] == $id && $liked[0]['user_id'] == $user_id) {
        echo "<div class=\"btn-group-toggle\" data-toggle=\"buttons\">\n";
        echo "  <label id=\"likeButtonParent\" style='float: right' class=\"btn btn-primary active act\">\n";
        echo "    <input id=\"likeButton\" type=\"checkbox\" checked autocomplete=\"off\">❤\n";
        echo "  </label>\n";
        echo "</div>";
    } else {
        echo "<div class=\"btn-group-toggle\" data-toggle=\"buttons\">\n";
        echo "  <label id=\"likeButtonParent\" style='float: right' class=\"btn btn-primary\">\n";
        echo "    <input id=\"likeButton\" type=\"checkbox\"  autocomplete=\"off\">❤\n";
        echo "  </label>\n";
        echo "</div>";
    }
    echo "</script>";
    echo "</div>";
    echo "</div>";
    echo "          \n";
    echo "      </th>\n";
    echo "      <th>\n";
//echo "          <h3>Objectif : ".$goal." €</h3>\n";
    echo "      </th>\n";
    echo "  </tr>\n";
    echo "  <tr>\n";
    echo "      <td colspan=\"3\" style=\"text-align: center\">\n";

    echo "          <br>\n";
    echo "                <div style=\"width: 500px; height:500px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('" . $img . "');-moz-border-radius: 125px;webkit-border-radius: 250px;border-radius: 125px;\">\n";

    echo "                </div>\n";
//echo "          <img src=\"".$img."\" width=\"500\" height=\"500\" alt=\"Image Projet\" style=\"display: inline-block\"/>\n";
    echo "          <br>\n";
    echo "          <h3>" . $description . "\n";
    echo "                    </h3>\n";
    echo "          <br>\n";
    echo "                    <iframe width=\"720\" height=\"480\" src=\"https://www.youtube.com/embed/" . $ytcode . "\">\n";
    echo "                    </iframe> \n";
    echo "      </td>\n";
    echo "  </tr>\n";
    echo "";
    echo "</table> ";
    echo "</div>";


    echo "<div class='col-lg-4'>";
    echo "<div class='jumbotron'>";
    echo " <h3> " . $pseudo . " </h3> ";
    echo " <h4> Chef de projet </h4> ";
    echo "<a href=\"./chief_profile?id=" . $chef['id'] . "\" >";
    echo "<img src='" . $chef['img_url'] . "' style=\"border-radius: 100px\"  >";
    echo " </a>";
    if (isset($_SESSION['access_token'])) {
        echo "<a href=\"https://zimbra.utt.fr/?view=compose&to=" . $chef['email'] . "\" >";
        echo "            <input   class=\"btn btn-default\" type=\"submit\" value=\"contacter\">\n";
        echo " </a>";
    } else {
        echo "<form method='post'   action=\"mailto:" . $chef['email'] . "\" >";
        echo "            <input   class=\"btn btn-default\" type=\"submit\" value=\"contacter\">\n";
        echo " </form>";
    }

    echo "</div>";

    echo "<div class='jumbotron'>";
    echo " <h5> Type : " . $mode . " </h5> ";

    echo "               <div class='progress' style='height:20px;background-color: #c9dbbe;'>";
    echo "                  <div class='progress-bar' role='progressbar' aria-valuenow='" . $fund . "'  aria-valuemin='0' aria-valuemax='" . $goal . "' style='width:" . ((100 * $fund) / $goal) . "%;max-width:100%'>";
    echo "                      " . floor((100 * $fund) / $goal) . "%";
    echo "                  </div>";
    echo "                      </div> ";
    echo "              <p>" . $fund . " € sur " . $goal . " €</p> ";


    if (isset($_SESSION['access_token'])) {
        //echo "<form action=\"./view?p=".$id. "\" method=\"POST\">";
        echo "<form method=\"POST\">";
        echo "<input name=\"projectId\" type=\"hidden\" value=\"" . $id . "\" />";
        echo "    <div class=\"row\"> ";


        echo "<div  style='margin-top:20px' >";
        echo "<input name=\"montant\" value=\"0\" type=\"number\" min=\"0\" max=\"100000\" size=\"7\" maxlength=\"7\"/>";
        echo "                  </div>";

        echo "<div  style='margin-top:40px'>";
        echo "            <input   class=\"btn btn-default give-button\" type=\"submit\" value=\"Donner !\">\n";
        echo "                  </div>";

        echo " </form>";
    }

    echo "</div>";

    echo "</div>";
    echo "</div>";
    echo "</div>";
}

function generateProjectListViewItem2($project, $pseudo) {
    echo "<a  style='text-decoration:none; color:inherit;' href=./view?p=" . $project['id'] . ">";
    echo "<div class=\"row well\" style=\"margin: 20px;position: relative;\">\n";
    echo "    <div class=\"col-sm-4\" >";
    echo "          <div style=\"width: 200px; height:200px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('" . $project['img'] . "');-moz-border-radius: 100px;webkit-border-radius: 50px;border-radius: 100px;\">\n";

    echo "          </div>\n";
    echo "    </div>\n";
    echo "    <div class=\"col-sm-5\" >";

    echo "                    <h2>" . $project['name'] . "</h2>\n";
    echo "                    <h3>Par " . $pseudo . "</h3>\n";
    echo "                    <p>" . $project['place'] . "</p>\n";
    echo "                    <p>" . $project['mode'] . " : " . $project['goal'] . " €</p>\n";

    echo "</div>\n";
    echo "    <div class=\"col-sm-3\" style=\"position: absolute;bottom: 0;right: 0;\">";

    echo "               <div class='progress' style='width:150px;height:20px;background-color: #c9dbbe;'>";
    echo "                  <div class='progress-bar' role='progressbar' aria-valuenow='" . $project['fund'] . "'  aria-valuemin='0' aria-valuemax='" . $project['goal'] . "' style='width:" . ((100 * $project['fund']) / $project['goal']) . "%;max-width:100%;'>";
    echo "                      " . floor((100 * $project['fund']) / $project['goal']) . "%";
    echo "                  </div>";
    echo "                      </div> ";
    echo "              <p>" . $project['fund'] . " € sur " . $project['goal'] . " €</p> ";


    echo "</div>\n";

    echo "  </div>";
    echo "</a>";
}

function generateProjectListViewItem2withButton($project, $pseudo) {
    echo "<a  style='text-decoration:none; color:inherit;' href=./view?p=" . $project['id'] . ">";
    echo "<div class=\"row well\" style=\"margin: 20px;position: relative;\">\n";
    echo "    <div class=\"col-sm-4\" >";
    echo "          <div style=\"width: 200px; height:200px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('" . $project['img'] . "');-moz-border-radius: 100px;webkit-border-radius: 50px;border-radius: 100px;\">\n";

    echo "          </div>\n";
    echo "    </div>\n";
    echo "    <div class=\"col-sm-5\" >";

    echo "                    <h2>" . $project['name'] . "</h2>\n";
    echo "                    <h3>Par " . $pseudo . "</h3>\n";
    echo "                    <p>" . $project['place'] . "</p>\n";
    echo "                    <p>" . $project['mode'] . " : " . $project['goal'] . " €</p>\n";

    echo "</div>\n";
    echo "</a>";
    echo "    <div class=\"col-sm-3\" style=\"position: absolute;bottom: 0;right: 0;\">";

    echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"POST\">";
    echo "<input name=\"projectId\" type=\"hidden\" value=\"" . $project['id'] . "\" />";
    echo "    <div class=\"row\"> ";



    echo "<input name=\"montant\" value=\"0\" type=\"number\" min=\"0\" max=\"100000\" size=\"7\" maxlength=\"7\"/>";

    echo "            <input   class=\"btn btn-default give-button\" type=\"submit\" value=\"Donner !\">\n";


    echo " </form>";
    echo "    </div> ";
    echo "               <div class='progress' style='width:150px;height:20px;background-color: #c9dbbe;'>";
    echo "                  <div class='progress-bar' role='progressbar' aria-valuenow='" . $project['fund'] . "'  aria-valuemin='0' aria-valuemax='" . $project['goal'] . "' style='width:" . ((100 * $project['fund']) / $project['goal']) . "%;max-width:100%'>";
    echo "                      " . floor((100 * $project['fund']) / $project['goal']) . "%";
    echo "                  </div>";
    echo "                      </div> ";
    echo "              <p>" . $project['fund'] . " € sur " . $project['goal'] . " €</p> ";


    echo "</div>\n";

    echo "  </div>";
}

function generatePojectListViewItem($project, $pseudo) {
    echo "<a  style='text-decoration:none; color:inherit;' href=./view?p=" . $project['id'] . ">";
    echo "<div class=\"jumbotron\" style=\"padding: 10px;font-size: 15px;font-height: 1px;\">\n";
    echo "            <table>\n";
    echo "                <tr>\n";
    echo "                <th>\n";
    echo "                <div style=\"width: 200px; height:200px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('" . $project['img'] . "');-moz-border-radius: 100px;webkit-border-radius: 50px;border-radius: 100px;\">\n";
//echo "                    <img src=\"". addslashes(($project['img']))."\"  style=\"width: 100%;height: 100%; object-fit: contain;\" alt=\"Project image\"/>\n";
    echo "                </div>\n";
    echo "                </th>\n";
    echo "                <th>\n";
    echo "                    <h2>" . $project['name'] . "</h2>\n";
    echo "                    <h3>Par " . $pseudo . "</h3>\n";
    echo "                    <p>" . $project['place'] . "</p>\n";
    echo "                    <p>" . $project['mode'] . " : " . $project['goal'] . " €</p>\n";
    echo "                </th>\n";
    echo "                <th style=\"text-align: center;vertical-align: bottom; display: table-cell;\">\n";
//echo "          <progress value=".$project['fund']." max=".$project['goal']."></progress>\n";
    echo "               <div class='progress' style='width:150px;height:20px;background-color: #c9dbbe;'>";
    echo "                  <div class='progress-bar' role='progressbar' aria-valuenow='" . $project['fund'] . "'  aria-valuemin='0' aria-valuemax='" . $project['goal'] . "' style='width:" . ((100 * $project['fund']) / $project['goal']) . "%'>";
    echo "                      " . ((100 * $project['fund']) / $project['goal']) . "%";
    echo "                  </div>";
    echo "                      </div> ";
    echo "              <p>" . $project['fund'] . " € sur " . $project['goal'] . " €</p> ";


    echo "                </th>\n";
    echo "                </tr>\n";
    echo "            </table>\n";
    echo "        </div>";
    echo "</a>";
}

function generateProjectTable($projectArray) {
    echo " <ol>";
    foreach ($projectArray as $project) {
        echo "<a href='./view?p=" . $project['id'] . "'><li>" . $project['name'] . "</li></a>";
    }
    echo " </ol>";
}

function generateFundTable($fundArray) {
    $RDSHandler = new RDSHandler();
    echo " <ul>";
    foreach ($fundArray as $fund) {
        $projectName = $RDSHandler->getProjectById($RDSHandler->getBase(), $fund['project_id'])[0]['name'];
        echo "<a href='./view?p=" . $fund['project_id'] . "'><li>" . $fund['SUM(`fund`)'] . " € pour " . $projectName . "</li></a>";
    }
    echo " </ul>";
}

function generateLikedProjectTable($projectArray) {
    //var_dump($projectArray);
    echo " <ul>";
    foreach ($projectArray as $project) {
        $RDSHandler = new RDSHandler();
        $projectName = $RDSHandler->getProjectById($RDSHandler->getBase(), $project['project_id'])[0]['name'];
        echo "<a href='./view?p=" . $project['project_id'] . "'><li>" . $projectName . "</li></a>";
    }
    echo " </ul>";
}

function generateUeTable($ueArray) {
    echo " <ul>";
    foreach ($ueArray as $ues) {
        echo "<a href='https://etu.utt.fr/uvs/search?q=" . $ues['ue_sigle'] . "'><li>" . $ues['ue_sigle'] . "</li></a>";
    }
    echo " </ul>";
}

function generateProfileViewWithoutButton($pictureUrl, $fullname, $branch, $level, $speciality, $email, $projectArray, $LikedProjectArray, $fundArray, $ueArray) {
    echo "        <div class=\"row\">\n";
    echo "            <div class=\"col-lg-4\" style=\"overflow: hidden;\">\n";
    echo "            <img style=\"border-radius: 100px; float: left\" src=\" " . $pictureUrl . " \" alt=\"" . $fullname . "\">\n";
    echo "            <h3>" . $fullname . "</h3>\n";
    echo "             <br>";
    echo "            <h3>" . $branch . $level . " " . $speciality . "</h3>\n";
    echo "         </div>\n";

    echo "        <div class=\"col-lg-6\">\n";
    echo "         </div>\n";
    echo "        <div class=\"col-lg-2\">\n";
//echo "<a href=\"https://zimbra.utt.fr/?view=compose&to=".$chef['email']."\" >";
//echo "            <input   class=\"btn btn-default\" type=\"submit\" value=\"contacter\">\n";
//echo " </a>";
    echo "         </div>\n";
    echo "         </div>\n";
    echo "        \n";
    echo "       \n";
    echo "        <div class=\"row\">\n";
    echo "            \n";
    echo "            <div class=\"jumbotron col-lg-3 catbox\">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                <h3>Dirige</h3>\n";
    generateProjectTable($projectArray);
    echo "                <hr>\n";
    echo "          \n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "            <div class=\"jumbotron col-lg-3 catbox\">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                <h3>Supporte</h3>\n";
    generateFundTable($fundArray);
    echo "          \n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "                \n";
    echo "        \n";
    echo "            <div class=\"jumbotron col-lg-3 catbox \">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                <h3>Aime</h3>\n";
    generateLikedProjectTable($LikedProjectArray);
    echo "            </div>\n";
    echo "            </div>\n";
    echo "               \n";
    echo "            \n";
    echo "            <div class=\"jumbotron col-lg-2 catbox\">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                   <h3>UE suivies</h3>\n";
    generateUeTable($ueArray);
    echo "            </div>\n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "            \n";
    echo "        </div> ";
}

function generateProfileViewWithButton($pictureUrl, $fullname, $branch, $level, $speciality, $email, $projectArray, $LikedProjectArray, $fundArray, $ueArray) {
    echo "        <div class=\"row\">\n";
    echo "            <div class=\"col-lg-4\" style=\"overflow: hidden;\">\n";
    echo "            <img style=\"border-radius: 100px; float: left\" src=\" " . $pictureUrl . " \" alt=\"" . $fullname . "\">\n";
    echo "            <h3>" . $fullname . "</h3>\n";
    echo "             <br>";
    echo "            <h3>" . $branch . $level . " " . $speciality . "</h3>\n";
    echo "         </div>\n";

    echo "        <div class=\"col-lg-6\">\n";
    echo "         </div>\n";
    echo "        <div class=\"col-lg-2\">\n";
    if (isset($_SESSION['access_token'])) {
        echo "<a href=\"https://zimbra.utt.fr/?view=compose&to=" . $email . "\" >";
        echo "            <input   class=\"btn btn-default\" type=\"submit\" value=\"contacter\">\n";
        echo " </a>";
    } else {
        echo "<form method='post'   action=\"mailto:" . $email . "\" >";
        echo "            <input   class=\"btn btn-default\" type=\"submit\" value=\"contacter\">\n";
        echo " </form>";
    }
    echo "         </div>\n";
    echo "         </div>\n";
    echo "        \n";
    echo "       \n";
    echo "        <div class=\"row\">\n";
    echo "            \n";
    echo "            <div class=\"jumbotron col-lg-3 catbox\">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                <h3>Dirige</h3>\n";
    generateProjectTable($projectArray);
    echo "                <hr>\n";
    echo "          \n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "            <div class=\"jumbotron col-lg-3 catbox\">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                <h3>Supporte</h3>\n";
    generateFundTable($fundArray);
    echo "          \n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "                \n";
    echo "        \n";
    echo "            <div class=\"jumbotron col-lg-3 catbox \">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                <h3>Aime</h3>\n";
    generateLikedProjectTable($LikedProjectArray);
    echo "            </div>\n";
    echo "            </div>\n";
    echo "               \n";
    echo "            \n";
    echo "            <div class=\"jumbotron col-lg-2 catbox\">\n";
    echo "            <div class=\"col-lg-12\">\n";
    echo "                   <h3>UE suivies</h3>\n";
    generateUeTable($ueArray);
    echo "            </div>\n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "            \n";
    echo "        </div> ";
}

/* 



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

