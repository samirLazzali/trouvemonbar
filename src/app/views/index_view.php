<div class="container-fluid justify-content-center">
    <h4 class="pb-0 pt-2"> Planning des tables </h4>
    <div>
        <iframe src="https://calendar.google.com/calendar/embed?src=o0tvlgqfogmrkdd4iejeso0a7g%40group.calendar.google.com&ctz=Europe%2FParis"
                frameborder="0"
                width="1000"
                height="440"
                class="mr-5 ml-5 frame2"
                id="frame2"
        ></iframe>
    </div>

    <div class="md-5">
        <div> <a href="games.php"> Consulter </a> la liste complète des tables </div>
        <?=Auth::logged() ? "<span> <a href='create_game.php'> Ajouter </a> une table </span>" :
                            "<span> <a href='authentication.php'> Connectez-vous </a> pour vous inscrire à une table ou en proposer. </span>";?>

    </div>

</div>



