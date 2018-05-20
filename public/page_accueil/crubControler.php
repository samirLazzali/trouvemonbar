
<?php
/**
 * Created by PhpStorm.
 * User: agammon
 * Date: 4/24/18
 * Time: 2:35 PM
 */

//include(vue.php);
include("model.php");
include("viewControler.php");

head();

$bdd = db_connect();
$tables = $bdd->query("SELECT * FROM pg_catalog.pg_tables WHERE tableowner='ensiie';");
$tabliste=$tables->fetchAll();
$tables->closeCursor();
$rep=$bdd->query('SELECT * FROM '. $tabliste[0][1]);

$repAll=$rep->fetchAll();

$rs = $bdd->query('SELECT * FROM '.$tabliste[0][1].' LIMIT 0');
for ($i = 0; $i < $rs->columnCount(); $i++) {
    $col = $rs->getColumnMeta($i);
    $columns[] = $col['name'];
}



selectlist("tabliste",$tabliste);

print "<div id=\"search\">";
foreach ($columns as $col){

    print "$col :";
    input("text",$col,$col);
}
print "</div>";

button("button","valider","valid","valider");


tab_show_crub($repAll,$columns);


?>

<script>

    $('#tabliste').change(function(){

        $.ajax({
        url : 'crubSearch.php', // La ressource ciblée
        type : 'GET', // Le type de la requête HTTP.
        data : 'tab=' + $('#tabliste').val(),

        dataType : 'html',
        success : function(code_html,statut){
            $('#search').html(code_html);

        },
        });

        $.ajax({
            url : 'crubReq.php', // La ressource ciblée
            type : 'GET', // Le type de la requête HTTP.
            data : 'tab=' + $('#tabliste').val(),

            dataType : 'html',
            success : function(code_html,statut){
                $('#tab').replaceWith(code_html);

            },
        });

    });

    $('#valid').click(function(){
        var childr=$('#search').children();
        var str="";
        for(var i=0;i<childr.length;i++){
            str += "&" + childr.eq(i).attr('id') + '=' + childr.eq(i).val();
        };
        $.ajax({
            url : 'crubReq.php', // La ressource ciblée
            type : 'GET', // Le type de la requête HTTP.
            data : 'tab=' + $('#tabliste').val()+ str,

            dataType : 'html',
            success : function(code_html,statut){
                $('#tab').replaceWith(code_html);

            },
        });

    });


    function tabclick(id) {
        if ($(id).attr('class')=="mod") {
            $(id).attr('class',"select");
            var childr = $(id).children();
            for (var i = 1; i < childr.length-1; i++) {

                childr.eq(i).html('<input type="text"  name ="' + childr.eq(i).attr('class') + '" value="' + childr.eq(i).html() + '"/>');
            }
                childr.eq(childr.length-1).append("<button type='button' id='updtade' onclick='delmod(2,this)'> modifier </button>");
            };

        }

        $('#del').click(delmod(1,this));

function delmod(choice,element) {
    var str = "";
    var childr = $(element).parent().parent().children();
    for (var i = 1; i < childr.length-1; i++) {
        str += "&" + childr.eq(i).find('input').attr('name') + '=' + childr.eq(i).find('input').val();
    }

    $.ajax({
        url: 'crubDelMod.php', // La ressource ciblée
        type: 'GET', // Le type de la requête HTTP.
        data: 'mod='+ choice +'&tab=' + $('#tabliste').val() + '&id=' + childr.eq(0).html() + str,

        dataType: 'html',
        success: function (code_html, statut) {
            alert(code_html);
        },

    });
    var str = "";
    for (var i = 0; i < childr.length; i++) {
        str += "&" + childr.eq(i).attr('id') + '=' + childr.eq(i).val();
    }
    ;


    $.ajax({
        url: 'crubReq.php', // La ressource ciblée
        type: 'GET', // Le type de la requête HTTP.
        data: 'tab=' + $('#tabliste').val() + str,

        dataType: 'html',
        success: function (code_html, statut) {
            $('#tab').replaceWith(code_html);

        },
    });
}
</script>
</body>
</html>