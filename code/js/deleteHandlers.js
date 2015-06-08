/**
 * Button on click will trigger the ajax request.
 * @author: Bernardo Loesberg
 */
$('.deleteConsignment').on('click', function(){
    if (confirm("Weet u zeker dat u een zending wilt verwijderen?") == true) {
        $.ajax({
            url: '/ABC-biker/ajaxdelete',
            type: 'POST',
            data: {consignmentnumber: $(this).val()},
            success: function(data){
                // Success eventueel een message weergeven
            }
        });

        $(this).closest('tr').remove();
    }
});

$('.deleteCustomer').on('click', function(){
    if (confirm("Weet u zeker dat u een klant wilt verwijderen?") == true) {
        $.ajax({
            url: '/ABC-biker/ajaxdelete',
            type: 'POST',
            data: {customernumber: $(this).val()},
            success: function(data){
                // Success eventueel een message weergeven
            }
        });

        $(this).closest('tr').remove();
    }
});

$('.deleteEmployee').on('click', function(){
    if (confirm("Weet u zeker dat u een werknemer wilt verwijderen?") == true) {
        $.ajax({
            url: '/ABC-biker/ajaxdelete',
            type: 'POST',
            data: {employeenumber: $(this).val()},
            success: function(data){
            }
        });
        $(this).closest('tr').remove();
    }
});

$('.deleteAddress').on('click', function(){

    if (confirm("Weet u zeker dat u een adres wilt verwijderen?") == true) {
        $.ajax({
            url: '/ABC-biker/ajaxdelete',
            type: 'POST',
            data: {addressnumber: $(this).val()},
            success: function(data){
            }
        });
        $(this).closest('tr').remove();
    }
});


$('.deleteParcel').on('click', function(){
    if (confirm("Weet u zeker dat u een pakket wilt verwijderen?") == true) {
        $.ajax({
            url: '/ABC-biker/ajaxdelete',
            type: 'POST',
            data: {parcelnumber: $(this).val()},
            success: function(data){
                // Success eventueel een message weergeven
                console.log(data);
            }
        });

        $(this).closest('tr').remove();
    }
});