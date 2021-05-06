$(document).ready(function(){

    let emails = document.getElementById('selectUser');

    function ajaxUtilisateurs(){
        var requete = $.ajax({
            url : "http://serveur1.arras-sio.com/symfony4-4063/ppe/web/index.php?page=utilisateurws", 
            method : "GET",
            dataType : "json",
            beforeSend: function( xhr ) {
                xhr.overrideMimeType( "application/json; charset=utf-8" );
            }});
            requete.done(function(msg){
                $.each(msg, function(index, e){
                    emails.innerHTML += "<option value=" + e.email + ">" + e.email + "</option>";
                });

            });
            requete.fail(function(jqXHR, textStatus){
                alert("Erreur");
            });
        }
    ajaxUtilisateurs();
});