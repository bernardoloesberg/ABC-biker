/**
 * Created by Christiaan on 21-5-2015.
 */
$('.biker').on('click', function(){
    if(document.getElementById("biker").checked){
        document.getElementById("hiddenFields").style.visibility = "visible";
    }
    else{
        document.getElementById("hiddenFields").style.visibility = "hidden";
    }
});