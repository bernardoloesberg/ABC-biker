$(document).ready(function(e){
    $.ajax({
        url: 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=Arnhem%20twikkelstraat&destinations=Nijmegen%20straat&mode=bicycling&language=nl-NL&key=AIzaSyCrAiycx_hRZPYFlnZKobXzdBZ8Dh3HuI0',
        type: 'GET',
        success: function(data){
            console.log(data);
        }
    });
});