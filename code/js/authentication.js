/**
 * @author: Bernardo Loesberg
 * When on a consignment a customer has been chosen then get a address.
 */
$('#loginButton').on('click', function(){
    $.ajax({
        url: 'http://api.authy.com/protected/json/verify/' + $('#token').val() + '/6805549?api_key=TAVynpvxam12wcdM6oBNFAQ2HuBL28EF',
        type: 'GET',
        crossDomain:true,
        dataType: 'jsonp',
        success: function(data){
            alert(data);
        }
    });
});