<?php



interface IStatAPI {
    
    public function GET(string $format, string $cat, float $range, float $lon, float $lat);
}