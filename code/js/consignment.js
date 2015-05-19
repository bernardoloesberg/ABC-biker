$('.deleteConsignment').on('click', function(){
    $(this).closest("tr").remove();
    $.post();
});