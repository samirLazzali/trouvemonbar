<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Chat</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/chat.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body>

<?php include_once('vue/include/header.php'); ?>

<div class="container">
  <div id="chat">
    <div id="chat_list" class="list-group">
      <?php foreach ($list_chat as $elt) : ?>
      <a href="#" class="list-group-item <?php echo (!$elt['etat_lu'] && $elt['id_cible'] == $_SESSION['id']) ? 'new' : ''; ?>"><strong>Numéro <span class="id_chat_list"><?php echo ($elt['id_utilisateur'] != $_SESSION['id']) ? $elt['id_utilisateur'] : $elt['id_cible']; ?></span></strong><br /><small class="text-muted"><strong>Numéro <?php echo $elt['id_utilisateur']; ?></strong> : <?php echo $elt['message']; ?></small></a>
    <?php endforeach; ?>
    </div>
    <div id="chat_text" class="well">
      <div id="chat_text_p">
        <?php foreach ($messages as $elt) : ?>
          <br /><span class="pull-<?php echo ($elt['id_utilisateur'] == $_SESSION['id'] ? 'right' : 'left'); ?> numero">Numéro <?php echo $elt['id_utilisateur']; ?></span>
          <div class="chat-<?php echo ($elt['id_utilisateur'] == $_SESSION['id'] ? 'right' : 'left'); ?> well">
            <?php echo $elt['message']; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <form action="#" onsubmit="return false" style="display: <?php echo ($id_chat > 0) ? 'block' : 'none'; ?>;">
        <div class="form-group">
          <input type="text" class="form-control" id="message" maxlength="2000" placeholder="Votre message ... avec [<?php echo $titre; ?>]" autocomplete="off" autofocus />
        </div>
      </form>
    </div>

  </div>
</div>
<div class="container-fluid">
	<?php include_once('vue/include/footer.php'); ?>
</div>

<script>
/*Positionnement du chat en fonction de la taille du support*/
var chat = document.getElementById('chat');
var chat_text = document.getElementById('chat_text');
var chat_list = document.getElementById('chat_list');

chat.style.height = 0.8 * window.innerHeight + "180px";
chat_text.style.height = 0.8 * window.innerHeight + "px";
chat_list.style.height = 0.8 * window.innerHeight + "px";

/*Processus d'envoi du chat en Jquery*/
$(function(){
var message = $('#message');
var id_user = <?php echo $_SESSION['id']; ?>;
var id_cible = '<?php echo $id_chat; ?>';

function sendMessage(message_val) {
  result = $.post(
    'chat.php',
    {  id : id_cible,
       message : message_val
    }
  );
}


$(message).keyup(function(entree) {
  if (entree.keyCode == 13 || entree.which == 13) {
    var message_text = $(message).val();
    if (( message_text = message_text.trim()) != '') {
      sendMessage($(message).val());
      $('#chat_text').scrollTop(100000000);
      $(this).val('');
			resetListChat();
    }
  }
});

/************************************/
$('#chat_text').scrollTop(100000000);
function resetChat() {
  if (id_cible > 0) {
    var result = $.post(
      'chat.php',
      {  id : id_cible,
         next : ''
        }
    );

    result.done(function(messages) {
      var reset = '';
      if (messages) {
        var messages_parse = JSON.parse(messages);

        var cote = '';

        for (var i = 0; i < messages_parse.length; i++) {
          cote = 'left';
          if (messages_parse[i]['id_utilisateur'] == id_user)
            cote = 'right';

          $('#chat_text_p').append('<br /><span class="pull-' + cote + ' numero">Numéro ' + messages_parse[i]['id_utilisateur'] + '</span>'
          + '<div class="chat-' + cote + ' well">' + messages_parse[i]['message']
          + '</div>');
        }
        if (messages_parse.length > 0)
          $('#chat_text').scrollTop(100000000);
        }
    });
  }
}


var id = setInterval(resetChat, 2000);

function initEventListChat() {
	$('#chat_list a').click(function() {
	  id_cible = $(this).find('.id_chat_list').text();
	    var result = $.post(
	      'chat.php',
	      {  id : id_cible  }
	    );

	    result.done(function(messages) {

	      if (messages) {
	        clearInterval(id);

	        var reset = '';
	        var messages_parse = JSON.parse(messages);

	        var cote = '';

	        for (var i = 0; i < messages_parse.length; i++) {
	          cote = 'left';
	          if (messages_parse[i]['id_utilisateur'] == id_user)
	            cote = 'right';

	          reset += '<br /><span class="pull-' + cote + ' numero">Numéro ' + messages_parse[i]['id_utilisateur'] + '</span>'
	          + '<div class="chat-' + cote + ' well">' + messages_parse[i]['message']
	          + '</div>';
	        }
	        $('#chat_text_p').html(reset);
	        $('form').css('display', 'block');
	        $('#chat_text').scrollTop(100000000);
	        $(message).attr('placeholder', 'Votre message ... avec [Numéro ' + id_cible + ']');
	        id = setInterval(resetChat, 2000);
	      }else
	        alert('Il y a eu un problème lors de la réception des données');
	    });
	});
}
initEventListChat();
	/***************/
	function resetListChat() {
		var result = $.post(
			'chat.php',
			{  reset_list_chat : ""  }
		);

		result.done(function(messages) {
			if (messages) {
				var list_chat = "";
				var tmp_user = 0;
				var etat_lu = 'new';

				var messages_parse = JSON.parse(messages);
				for (var i = 0; i < messages_parse.length; i++) {
					tmp_user = messages_parse[i]["id_cible"];
					etat_lu = '';

					if (messages_parse[i]["id_utilisateur"] != id_user)
						tmp_user = messages_parse[i]["id_utilisateur"];
					if (messages_parse[i]["etat_lu"] == '0' && messages_parse[i]["id_cible"] == id_user && id_cible != messages_parse[i]["id_cible"])
						etat_lu = 'new';

					list_chat += '<a href="#" class="list-group-item ' + etat_lu + '"><strong>Numéro <span class="id_chat_list">' + tmp_user + '</span></strong><br /><small class="text-muted"><strong>Numéro ' + messages_parse[i]["id_utilisateur"] + '</strong> : ' + messages_parse[i]["message"] + '</small></a>';

				}
				$('#chat_list a').off('click');
				$('#chat_list').html(list_chat);
				initEventListChat();
			}
		});
	}
	setInterval(resetListChat, 2000);
	/***************/
















});



</script>

	</body>

</html>
