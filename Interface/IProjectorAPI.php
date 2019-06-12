<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author val-r
 */
interface IProjectorAPI {
    
    public function GET(int $projectid, string $format);
    public function POST(int $projectid, string $format);
    public function PUT(int $projectid,string $format);
    public function DELETE(int $Projectid, string $format);
    public function xml_encode($mixed, $domElement, $DOMDocument );

    
}
