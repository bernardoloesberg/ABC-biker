/**
 * @author: Bernardo Loesberg
 * When on a consignment a customer has been chosen then get a address.
 */
$('#loginButton').on('click', function(){
    $.ajax({
        url: 'http://sandbox-api.authy.com/protected/json/verify/' + $('#token').val() + '/6805549?api_key=41f3fe0a27e1c9cba05c30933811a2b8',
        type: 'GET',
        crossDomain:true,
        dataType: 'jsonp',
        success: function(data){
            alert(data);
        }
    });
});