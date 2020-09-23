@extends('layouts.master')

@section('content')
    <div class="container-fluid accueil">
        <div class="container">
            <div class="row d-flex flex-column align-items-center">
                <h1 class="titreAccueil">Trouvez votre</br>
                    Faites entrer l'accusé.</h1>
            </div>
            <div class="row">
                <div class="accueilRecherche col-12 col-md-12 col-xs-12">
                    <form action="{{ '/affaires' }}" method="get" class="action barre-recherche text-center">
                        @csrf
                        <input type="search" name="q" placeholder="Tapez le nom de l'affaire ou un mot-clé" class="accueilBarre" rows="3">
                        <button type="submit" class="btn cst-btn"><i class="fas fa-search loupe"></i></button>
                    </form>
                    <div class="text-center boutonsAccueil">
                        <a href="{{ '/criteres' }}" class="accueilCriteres">Rechercher avec vos critères</a>
                        <a href="{{ '/aleatoire'}}" class="accueilCriteres">Regarder un épisode au hasard</a>
                        {{-- <a href="{{ '/carte' }}" class="accueilCriteres">Recherche géographique</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid accueilGradient">
    </div>
    <div class="container-fluid accueilImage">
    </div>

    <section class="container-fluid" id="notice">
        <div class="container">
            <div class="row justify-content-center pb-5 noticeTitre">
                <h1>Foire aux questions</h1>
            </div>
            <div class="noticeCard">
                <ul>
                    <li>
                        <button class="noticeButton1 notbutt d-flex justify-content-between">
                            Où trouver les épisodes indisponibles sur le site ?
                            <i id="laCroix" class="fas fa-plus"></i>
                        </button>
                        <div class="noticeReponse1 notrep closed">
                            <p>Ce site étant non-officiel, il nous est malheureusement impossible de proposer l'intégralité des épisodes de "Faites entrer l'accusé".
                                Seuls les numéros présents sur la <a href="https://www.youtube.com/channel/UCXUSLU65KYElvyrrbQA1KIw" class="lienYtb" target="_blank">chaîne Youtube de l'émission</a>
                                sont disponibles ici (ça représente un peu plus de 100 épisodes, dont beaucoup sont très bien).<br><br>
                                Pour les personnes qui habitent à l'étranger, un certain nombre d'épisodes supplémentaires son disponibles sur la chaîne Youtube de FELA, mais tout dépend de
                                votre localisation. N'hésitez pas à vérifier.<br><br>
                                Et pour les autres épisodes ? En accolant l'acronyme "fela" au titre de l'épisode sur un moteur de recherche vous trouverez dans la plupart des cas ce que vous
                                cherchez, mais la qualité de l'image et du son ne sera jamais aussi bonne que sur la chaîne officielle.<br><br>
                                Le meilleur moyen de profiter des épisodes, mais pas forcément le plus accessible, reste de les regarder à la télévision.
                                Si vous êtes abonné à Canal Sat, il y a toujours des épisodes disponibles en replay sur MyCanal. La liste est mise à jour fréquemment et certains sont
                                parfois introuvables sur internet, donc n'hésitez pas à y jeter un oeil. Idem pour le replay de RMC Story, même si le choix est plus restreint.
                                Et sinon pour la TV en direct, Planète +, Planète + CI et RMC Story proposent des épisodes toutes les semaines dans leur programmation.</p>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="noticeCard">
                <ul>
                    <li>
                        <button class="noticeButton2 notbutt d-flex justify-content-between">
                            Comment fonctionne le site ?
                            <i id="laCroix2" class="fas fa-plus"></i>
                        </button>
                        <div class="noticeReponse2 notrep closed">
                            <p>Il y a plusieurs fonctionnalités. <br><br>
                                <span class="jaune">La barre de recherche :</span> vous tapez simplement un mot-clé (ville, nom d'épisode ou numéro de département par exemple). <br><br>
                                <span class="jaune">La recherche par critères :</span> vous remplissez un formulaire avec les critères de votre choix. <br><br>
                                <span class="jaune">Regarder un épisode au hasard :</span> le site choisit pour vous un épisode au hasard parmi la liste de tous ceux qui sont visionnables sur le site.<br><br>
                                Dans la section <span class="jaune">Épisodes</span>, vous trouverez la liste de tous les épisodes classés par saisons. Dans tous les cas, si un épisode est visionnable directement depuis le site,
                                un <i class="far fa-eye"> </i> apparaît dans la fiche de l'épisode.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="noticeCard">
                <ul>
                    <li>
                        <button class="noticeButton3 notbutt d-flex justify-content-between">
                            Pourquoi et comment les épisodes sont-ils notés ?
                            <i id="laCroix3" class="fas fa-plus"></i>
                        </button>
                        <div class="noticeReponse3 notrep closed">
                            <p>Tous les épisodes de "Faites entrer l'accusé" ne se valent pas. Aussi il nous est apparu logique, quoique délicat, de désigner les
                                épisodes qui nous ont semblé les plus intéressants. Les notes des épisodes sont représentées par des pipes (référence à l'esprit polar de l'émission)
                                de différentes couleurs.<br>
                                Pipe de bronze : épisode moyen. <br>
                                Pipe d'argent : bon épisode. <br>
                                Pipe d'or : très bon épisode. <br>
                                Pipe de diamant : excellent épisode. <br><br>
                                Évidemment, chacun aura sa propre sensibilité et nos notes ne correspondront pas toujours à celles que vous pourriez fixer. Les pipes ne sont donc qu'une
                                indication de ce que nous avons pu penser d'un épisode à un moment précis, et elles ne sont pas à considérer comme autre chose qu'une indication.<br>
                                Nos critères : le titre de l'épisode, la qualité de la narration, le speech d'intro et de conclusion, la richesse de la documentation et des divers témoignages,
                                les interventions de Dominique Rizet, les éventuels rebondissements et autres séquences inattendues.<br><br>
                                <span class="jaune">Précision importante :</span> les notes ne prennent jamais en compte la nature des crimes, le nombre de victimes, le travail des enquêteurs ni celui des magistrats.
                                Il n'est pas question ici de décerner des trophées de "meilleur criminel" ni de juger du travail des uns et des autres, pas plus que ne le fait l'émission.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="noticeCard">
                <ul>
                    <li>
                        <button class="noticeButton4 notbutt d-flex justify-content-between">
                            Comment faire une recherche par critères ?
                            <i id="laCroix4" class="fas fa-plus"></i>
                        </button>
                        <div class="noticeReponse4 notrep closed">
                            <p>Les recherches par critères permettent de vous proposer un épisode adapté à vos attentes.
                                Pour cela, vous devez remplir le formulaire avec un ou plusieurs critères. Les voici détaillés : <br><br>
                                <span class="jaune">Présentation :</span> vous avez le choix entre Christophe Hondelatte (saisons 2 à 11) et Frédérique Lantieri (saisons 12 à 20).<br><br>
                                <span class="jaune">Note de l'épisode :</span> elles vont de bronze (épisode moyen) à diamant (excellent épisode).<br><br>
                                <span class="jaune">Époque de l'affaire :</span> il s'agit de la décennie durant laquelle l'affaire a débuté. L'ambiance d'un épisode est parfois très différente d'une époque à l'autre.<br><br>
                                <span class="jaune">Décor :</span> vous avez ici le choix entre la ville et la campagne. Ce critère n'est pas particulièrement déterminant mais il peut également jouer sur l'ambiance
                                d'un épisode.<br><br>
                                <span class="jaune">Type d'épisode :</span> les trois possibilités sont "une seule scène de crime" (mais parfois avec plusieurs crimes sur un même lieu), "plusieurs scènes de crimes" (dans cette catégorie on trouve notamment les tueurs en série)
                                ou "pas de scène de crime" (par exemple des affaires de disparition). Attention, les scènes de crime se sont parfois avérées être des scènes de suicide ou sont restées des
                                mystères. Ce critère ne présume en rien de la culpabilité des protagonistes des épisodes.<br><br>
                                <span class="jaune">Critères supplémentaires :</span> vous avez plusieurs choix possibles.<br>
                                <span class="jaune">Longue enquête :</span> désigne des épisodes où l'enquête s'est avérée être particulièrement longue.<br>
                                <span class="jaune">Affaire mystérieuse :</span> dans le cas des épisodes où il reste encore des parts d'ombre. On trouve notamment sous ce critère les affaires non élucidées.<br>
                                <span class="jaune">Principal suspect témoigne :</span> ce critère s'applique si un des témoins interviewés a son nom dans le titre de l'épisode ou a été le principal suspect (ou le coupable) d'un un crime relaté dans l'épisode.
                                Attention, ce critère ne s'applique pas si le témoignage a été recueilli par d'autres journalistes que ceux de Faites entrer l'accusé.<br>
                                <span class="jaune">Affaire adaptée au cinéma :</span> Les téléfilms ne sont pas compris dans ce critère, tout comme les films librement inspirés d'affaires traitées dans FELA.<br>
                                <span class="jaune">Grand banditisme :</span> si l'affaire traitée dans l'épisode touche de près ou de loin au grand banditisme.<br><br>
                                Une fois que vous avez sélectionné votre ou vos critères, vous pouvez lancer une recherche.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="noticeCard">
                <ul>
                    <li>
                        <button class="noticeButton5 notbutt d-flex justify-content-between">
                            Pourquoi la saison 1 n'est-elle pas présente sur ce site ?
                            <i id="laCroix5" class="fas fa-plus"></i>
                        </button>
                        <div class="noticeReponse5 notrep closed">
                            <p>La saison 1 de "Faites entrer l'accusé" remonte à l'an 2000. Elle compte 7 épisodes, dont 5 traitent de plusieurs affaires à la fois.
                                Ces épisodes ont plutôt mal vieilli et ne ressemblent pas à ce que FELA est devenu à partir de la saison 2. C'est pour cette raison
                                qu'ils ne sont pas répertoriés ici. Ils ne sont pas non plus diffusés à la télévision, mais en cherchant un peu vous pouvez tout de même les trouver sur internet.
                                Ceci étant, attention au spoil car beaucoup d'affaires abordées en vrac dans la saison 1 ont été traitées bien plus en profondeur dans les saisons suivantes.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container-fluid parallax">
    </section>

    <section class="container-fluid" id="aPropos">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h1>À propos</h1>
                    </div>
                    <div>
                        <p>Bonjour,</p>
                        <p>Un soir du mois d'avril 2020 j'ai passé une demi-heure sur mon ordinateur à chercher un épisode de "Faites entrer l'accusé", tournant en boucle sur la page Youtube, avant de me décourager
                            et de regarder un épisode que j'avais déjà vu cinq fois. C'est à ce moment-là que j'ai eu l'idée de créer un site qui permettrait de classer les épisodes afin de les trouver
                            plus facilement.</p><br>
                        <p>Puisque j'étais en reconversion professionnelle pour devenir développeur web, je me suis dit que c'était une bonne occasion d'appliquer quelques concepts appris en cours.
                            Comme il est bien plus agréable de travailler à deux, j'ai proposé à un de mes camarades de cours de m'accompagner sur ce projet.
                            Il a accepté avec enthousiasme d'apporter ses idées et ses techniques de développement.</p><br>
                        <p>C'est comme ça que nous avons passé une partie de l'été 2020 à réaliser fela.fr.</p><br>
                        <p>Ce site non-officiel a pour but de faciliter l'accès aux épisodes de Faites entrer l'accusé. C'est aussi un hommage à l'émission, à Dominique Rizet, Christophe Hondelatte, Frédérique Lantieri,
                            aux musiques de Jean-Marie Leau et Raphaël Tidas, à toutes les personnes qui ont oeuvré afin de constituer ce programme.</p><br>
                        <p>Nous vous souhaitons une bonne navigation.</p><br>
                        <div class="d-flex justify-content-end">
                            <p>fela.fr</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <footer class="container-fluid" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center pb-3">
                    <h1>Contact</h1>
                </div>
                <div class=" footerContact col-12 col-sm-12 d-flex pb-3">
                    <div class="col-xs-12 col-sm-12 col-lg-6" style="border-right: 1px solid #F8D26F">
                        <p>Si vous avez une idée, une question, une suggestion ou toute autre remarque, vous pouvez nous contacter à cette adresse :</p>
                        <div class="pb-3">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                        </svg>
                        <a class="jaune" style="font-size:1.2rem" href="mailto:fela.message@gmail.com">fela.message@gmail.com</a>
                    </div>
                        <p>(Nous ne sommes pas en contact avec l'équipe de l'émission ni avec aucune personne ayant travaillé de près ou de loin sur l'émission).</p>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="col-12 lienSite">
                            <p>Retrouvez Faites entrer l'accusé sur <a href="https://rmcstory.bfmtv.com/faites-entrer-laccuse_1452" class="lienYtb" target="_blank">RMC Story</a></p>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-lg-12 titreRS">
                            <h2> Réseaux sociaux officiels : </h2>
                        </div>

                        <div class="col-xs-12 col-lg-12 d-flex pb-3 lienRS">

                            <div class="col-xs-6 col-sm-6 col-lg-6">
                                <i class="fab fa-youtube"></i>
                                <a href="https://www.youtube.com/channel/UCXUSLU65KYElvyrrbQA1KIw" class="lienYtb" target="_blank">Chaîne Youtube</a>
                                <br>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-lg-6">
                                <i class="fab fa-facebook-f"></i>
                                <a href="https://fr-fr.facebook.com/FelaF2/" class="lienYtb" target="_blank">Page Facebook</a>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-12 titreCredits">
                            <h2> Crédits photos :</h2>
                        </div>

                        <div class="col-12">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p>
                                <a href="https://www.flickr.com/photos/franckmichel/" class="lienYtb" target="_blank">Franck Michel</a> (page d'accueil)
                                </p>

                                <p>
                                <a href="https://pixabay.com/fr/users/richardfoulon-7223858/" class="lienYtb" target="_blank">Richard Foulon</a> (sous la F.A.Q)
                                </p>

                                <p>
                                <a href="https://www.flickr.com/photos/hellolapomme/" class="lienYtb" target="_blank">hellolapomme</a> (page critères)
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center creditFinal">
                    <p>2020 - fela.fr - Site non-officiel créé par deux amis sérieux</p>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('script-footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        let croix = document.querySelector("#laCroix");

        $(document).ready(function(){


            $(".noticeButton1").click(function(){

                $(".noticeReponse1").slideToggle("slow");

                if( $('.noticeReponse1').hasClass('closed') === true) {
                    $("#laCroix").css("transform", "rotate(45deg)");
                    $('.noticeReponse1').addClass("open");
                    $('.noticeReponse1').removeClass("closed");
//console.log('closed = true')
                }
                else {
                    $("#laCroix").css("transform", "rotate(0deg)");
                    $('.noticeReponse1').addClass("closed");
                    $('.noticeReponse1').removeClass("open");
//console.log('closed = false')
                }
            });

            $(".noticeButton2").click(function(){

                $(".noticeReponse2").slideToggle("slow");

                if( $('.noticeReponse2').hasClass('closed') === true) {
                    $("#laCroix2").css("transform", "rotate(45deg)");
                    $('.noticeReponse2').addClass("open");
                    $('.noticeReponse2').removeClass("closed");
                }
                else {
                    $("#laCroix2").css("transform", "rotate(0deg)");
                    $('.noticeReponse2').addClass("closed");
                    $('.noticeReponse2').removeClass("open");
                }
            });

            $(".noticeButton3").click(function(){

                $(".noticeReponse3").slideToggle("slow");

                if( $('.noticeReponse3').hasClass('closed') === true) {
                    $("#laCroix3").css("transform", "rotate(45deg)");
                    $('.noticeReponse3').addClass("open");
                    $('.noticeReponse3').removeClass("closed");
                }
                else {
                    $("#laCroix3").css("transform", "rotate(0deg)");
                    $('.noticeReponse3').addClass("closed");
                    $('.noticeReponse3').removeClass("open");
                }
            });

            $(".noticeButton4").click(function(){

                $(".noticeReponse4").slideToggle("slow");

                if( $('.noticeReponse4').hasClass('closed') === true) {
                    $("#laCroix4").css("transform", "rotate(45deg)");
                    $('.noticeReponse4').addClass("open");
                    $('.noticeReponse4').removeClass("closed");
                }
                else {
                    $("#laCroix4").css("transform", "rotate(0deg)");
                    $('.noticeReponse4').addClass("closed");
                    $('.noticeReponse4').removeClass("open");
                }
            });

            $(".noticeButton5").click(function(){

                $(".noticeReponse5").slideToggle("slow");

                if( $('.noticeReponse5').hasClass('closed') === true) {
                    $("#laCroix5").css("transform", "rotate(45deg)");
                    $('.noticeReponse5').addClass("open");
                    $('.noticeReponse5').removeClass("closed");
                }
                else {
                    $("#laCroix5").css("transform", "rotate(0deg)");
                    $('.noticeReponse5').addClass("closed");
                    $('.noticeReponse5').removeClass("open");
                }
            });
        });

    </script>
@endsection
