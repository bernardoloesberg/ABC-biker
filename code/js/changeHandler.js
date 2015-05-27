$('#customerChange').on('change', function(){
    alert($(this).val());

    $.ajax({
        url: '/ABC-biker/ajaxHandler.php',
        type: 'POST',
        data: {customernumber: $(this).val()},
        success: function(data){
            alert(data);
            var customer = JSON.parse(data);
            alert(customer.email);

            $('#pickupstreet').val(data.street);
            $('#pickuphousenumber').val(data.housnumber);
            $('#pickuphousenumberaddon').val(data.housenumberaddon);
            $('#pickupzipcode').val(data.zipcode);
            $('#pickupcity').val(data.pickupcity);


        }
    });
});
