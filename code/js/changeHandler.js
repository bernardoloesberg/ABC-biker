/**
 * @author: Bernardo Loesberg
 * When on a consignment a customer has been chosen then get a address.
 */
$('#customerChange').on('change', function(){
    $.ajax({
        url: '/ABC-biker/ajaxHandler.php',
        type: 'POST',
        data: {customernumber: $(this).val()},
        success: function(data){
            var customer =JSON.parse(data);

            getAddress(customer.customernumber);
        }
    });
});

/**
 * @author Bernardo Loesberg
 * Get a address of a customer and set it to the forms.
 * @param customernumber
 */
function getAddress(customernumber){
    $.ajax({
        url: '/ABC-biker/ajaxHandler.php',
        type: 'POST',
        data: {customernumberforaddress: customernumber},
        success: function(data){
            var address = JSON.parse(data);

            $('#pickupstreet').val(address.street);
            $('#pickuphousenumber').val(address.housenumber);
            $('#pickuphousenumberaddon').val(address.housenumberaddon);
            $('#pickupzipcode').val(address.zipcode);
            $('#pickupcity').val(address.city);
        }
    });
}
