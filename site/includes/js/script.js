/* Will delete the currently selected value */
$(".delete").click(function() {
    var rowIndex = $(this).parent().parent().index();
    var classes = this.classList;
    $.post( "supprimerMenu.php", { repasID: classes[1]} )
        .done(function( data ){
            $(".message").html(data);
            if(data.indexOf("succ&egrave;s!") != -1)
            {
                document.getElementById("showRecettes").deleteRow(rowIndex);
            }
        });
});
