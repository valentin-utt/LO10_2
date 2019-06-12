<?php


/**
 * Description of project
 *
 * @author val-r
 */
class Project {
    function getDes() {
        return $this->des;
    }

    function getLat() {
        return $this->lat;
    }

    function setDes($des) {
        $this->des = $des;
    }

        function getVid() {
        return $this->vid;
    }

    function setVid($vid) {
        $this->vid = $vid;
    }

    private $owner;
    private $name;
    private $cat;
    private $des;
    private $place;
    private $img;
    private $vid;
    private $mode;
    private $goal;
    private $lon;
    private $lat;
    private $fund;
    
    function __construct($owner, $name, $cat, $description, $place, $img, $vid, $mode, $goal, $longitide, $latitude, $fund) {
        $this->owner = $owner;
        $this->name = $name;
        $this->cat = $cat;
        $this->des = $description;
        $this->place = $place;
        $this->img = $img;
        $this->vid = $vid;
        $this->mode = $mode;
        $this->goal = $goal;
        $this->lon = $longitide;
        $this->lat = $latitude;
        $this->fund = $fund;
    }

        
    function getOwner() {
        return $this->owner;
    }

    function getName() {
        return $this->name;
    }

    function getCat() {
        return $this->cat;
    }

    function getDescription() {
        return $this->description;
    }

    function getPlace() {
        return $this->place;
    }

    function getImg() {
        return $this->img;
    }

    function getMode() {
        return $this->mode;
    }

    function getGoal() {
        return $this->goal;
    }

    function getLon() {
        return $this->lon;
    }

    function getLatitude() {
        return $this->lat;
    }

    function getFund() {
        return $this->fund;
    }

    function setOwner($owner) {
        $this->owner = $owner;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCat($cat) {
        $this->cat = $cat;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setPlace($place) {
        $this->place = $place;
    }

    function setImg($img) {
        $this->img = $img;
    }

    function setMode($mode) {
        $this->mode = $mode;
    }

    function setGoal($goal) {
        $this->goal = $goal;
    }

    function setLon($lon) {
        $this->lon = $lon;
    }

    function setLat($lat) {
        $this->lat = $lat;
    }

    function setFund($fund) {
        $this->fund = $fund;
    }
    
}
