<?php
include_once('../modele/DataUser.class.php');
include_once('../controleur/secure.php');
include_once('controleur/checkStatut.php');

include_once('controleur/header.php');

/*Inclusions pour le chat*/

include_once('modele/Chat.class.php');

$messages = [];
$titre = '';
$id_chat = '';

$afficher_liste_ajax = false;

$list_chat = [];
$list_chat = Chat::getListChat($bdd, $_SESSION['id'])->fetchAll();
/*Vérification de la validité de la liste*/
foreach ($list_chat as $cle => $elt) {
  $check_match = Match::matchEntreEux($bdd, $_SESSION['id'], ($elt['id_utilisateur'] != $_SESSION['id']) ? $elt['id_utilisateur'] : $elt['id_cible'], 'banni');
  if (!$check_match || !$check_match->fetch())
    unset($list_chat[$cle]);
}

/*Chat avec le $_GET['id']*/
if (isset($_GET['id'])) {
  $id_chat = (int) secureData($_GET['id']);
  $check_match = Match::matchEntreEux($bdd, $_SESSION['id'], $id_chat, 'banni');

  if ($check_match && $check_match->fetch()) {
    $chat = new Chat($bdd, $_SESSION['id'], $id_chat);
    $titre = 'Numéro '.$id_chat;
    $messages = $chat->getMessages(0, 30)->fetchAll();

    $_SESSION['last_msg_id'] = (isset($messages[0]['id'])) ? (int) $messages[0]['id'] : 0;

    $messages = array_reverse($messages);
  }else {
    header('Location: chat.php');
    exit(1);
  }


  include_once('vue/chat.php');
  exit(1);
}

/*Ajax*/
if (isset($_POST['message']) && isset($_POST['id'])) {
  $id_chat = (int) secureData($_POST['id']);
  $message = secureData($_POST['message']);

  $check_match = Match::matchEntreEux($bdd, $_SESSION['id'], $id_chat, 'banni');

  if ($check_match && $check_match->fetch()) {
    $chat = new Chat($bdd, $_SESSION['id'], $id_chat);
    $chat->sendMessage($message);
  }
}else if (isset($_POST['next']) && isset($_POST['id'])) {
  $id_chat = (int) secureData($_POST['id']);

  $check_match = Match::matchEntreEux($bdd, $_SESSION['id'], $id_chat, 'banni');

  if (isset($_SESSION['last_msg_id']) && $check_match && $check_match->fetch()) {
    $chat = new Chat($bdd, $_SESSION['id'], $id_chat);
    $messages = $chat->getMessageLeft($_SESSION['last_msg_id'])->fetchAll();

    $chat->resetMessageNonLu();

    $_SESSION['last_msg_id'] = (isset($messages[0]['id'])) ? (int) $messages[0]['id'] : $_SESSION['last_msg_id'];

    echo json_encode(array_reverse($messages));
  }
}else if (isset($_POST['id'])) {
  $id_chat = (int) secureData($_POST['id']);
  $check_match = Match::matchEntreEux($bdd, $_SESSION['id'], $id_chat, 'banni');

  if ($check_match && $check_match->fetch()) {
    $chat = new Chat($bdd, $_SESSION['id'], $id_chat);
    $messages = $chat->getMessages(0, 30)->fetchAll();

    $chat->resetMessageNonLu();

    $_SESSION['last_msg_id'] = (isset($messages[0]['id'])) ? (int) $messages[0]['id'] : 0;

    echo json_encode(array_reverse($messages));
  }
}else if(isset($_POST['reset_list_chat'])) {
  $len_list_chat = count($list_chat);

  if (!isset($_SESSION['last_id_list_match']))
    $_SESSION['last_id_list_match'] = 0;

  if (isset($_SESSION['last_id_list_match']) && $len_list_chat > 0 && $_SESSION['last_id_list_match'] < $list_chat[0]['id'])
    $afficher_liste_ajax = true;

  $_SESSION['last_id_list_match'] = ($len_list_chat > 0) ? $list_chat[0]['id'] : 0;

  if ($afficher_liste_ajax)
    echo json_encode($list_chat);
}else
  include_once('vue/chat.php');
