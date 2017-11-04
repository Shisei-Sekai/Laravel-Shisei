//Select mode is disabled by default
let editMode = false;
//If disable, enable and viceversa
function controlEditMode(){
    editMode = !editMode;
}
$(document).ready(function(){
//Hide all extra buttons
$('#deleteSelected').hide();
$('#moveSelected').hide();
$('#pinSelected').hide();

$('.list-group-item').click(function () {
    //If you are in edit mode, ergo, you are a staff member
    if(editMode){
        $(this).toggleClass('sub-section');
        $(this).toggleClass('selected-item');
    }

    //If there's any thread selected, show the buttons. Else, hide.
    if($('.selected-item').length){
        $('#deleteSelected').show();
        $('#moveSelected').show();
        $('#pinSelected').show();
    }else{
        $('#deleteSelected').hide();
        $('#moveSelected').hide();
        $('#pinSelected').hide();
    }
});
//Enter/exit the select mode
$('#toggleEdit').click(function(){
    controlEditMode();
    $('#toggleEdit').text(editMode? "Desactivar":"Seleccionar");
    //If we cancel the select mode, clear all
    if(!editMode){
        $('.selected-item').each(function () {
            $(this).toggleClass('sub-section');
            $(this).toggleClass('selected-item');
            $('#deleteSelected').hide();
            $('#moveSelected').hide();
            $('#pinSelected').hide();
        });
    }
});
});
