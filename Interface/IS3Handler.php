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

interface IS3Handler
{
    public function uploadToS3($fileURL);
    public function DeleteFromS3($keyname);
}
