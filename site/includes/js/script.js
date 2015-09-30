/* Will delete the currently selected value */
$(".delete").click(function() {

    var rowIndex = $(this).parent().parent().index();
    var classes = this.classList;

    $( "<div></div>" ).appendTo( "body" )
        .html('<div><h4>Voulez-vous supprimer le repas?</h4></div>')
        .dialog({
            modal: true,
            dialogClass: 'alert alert-warning span9',
            title: 'Supprimer le repas',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: false,
            buttons: {
                Oui: function () {
                    $.post( "supprimerMenu.php", { repasID: classes[1]} )
                        .done(function( data ){
                            showMsg = true;
                            $(".message").html(data);
                            if(data.indexOf("succ&egrave;s!") != -1)
                            {
                                document.getElementById("showRecettes").deleteRow(rowIndex);
                            }
                        });
                    $(this).dialog("close");
                },
                Non: function () {
                    $(this).dialog("close");
                }
            },
            X: function (event, ui) {
                $(this).remove();
            }
        }); 
});

