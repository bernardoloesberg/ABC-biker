/**
 * Button on click will trigger the ajax request.
 * @author: Bernardo Loesberg
 */
$('.deleteConsignment').on('click', function(){
    if (confirm("Weet u zeker dat u een consignment wilt verwijderen?") == true) {
        $.ajax({
            url: '/ABC-biker/consignmentdelete',
            type: 'POST',
            data: {consignmentnumber: $(this).val()},
            success: function(data){
                // Success eventueel een message weergeven
                alert(data);
            }
        });

        $(this).closest('tr').remove();
    }
});