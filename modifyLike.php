<?php
include 'classes/RDSHandler.php';


//data: "action="+addLike+"&userId="+userId+"&projectId="+projectId,
if (isset($_POST['action']) && $_POST['action'] == 'addLike') {
   $RDSHandler = new RDSHandler();
   $RDSHandler->addUserlikeProject($RDSHandler->getBase(),  $_POST['projectId'],  $_POST['userId']);
}
elseif (isset($_POST['action']) && $_POST['action'] == 'removeLike') {
   $RDSHandler = new RDSHandler();
   $RDSHandler->deleteUserlikeProject($RDSHandler->getBase(),  $_POST['projectId'],  $_POST['userId']);
}