$(document).ready(function(){
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://nominatim.openstreetmap.org/search?format=json",
                "method": "GET",
                "headers": {
                    "cache-control": "no-cache",

                }         
            }       

            $.ajax(settings).done(function (response) {
                console.log(response);
            });
});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


