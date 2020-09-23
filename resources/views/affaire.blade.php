@extends('layouts.master')

@section('content')
    <span class="titre d-none">
        @if( strlen($episode->lien) === 11 )
            <span class="test">
               FELA | {!! $episode->titre !!}, épisode complet en streaming
            </span>
        @elseif( strlen($episode->lien) !== 11)
            <span class="test">
              FELA | {!! $episode->titre !!}
            </span>
        @endif
    </span>


    <div class="container-fluid episodeShow">
        <div class="container d-flex flex-column ">
            <div class="row">
                <div class="col-12 col-md-12 d-flex flex-column align-items-center mb-5 mobileSaison">
                    <div class="col-12 col-md-12 d-flex justify-content-center align-items-center mobileTitre">
                        <h2 class="pr-3">
                            @if($episode->note_id === '1')
                                <img src="{{ asset('images/pipe-bronze.png') }}" alt="Pipe de bronze - épisode moyen" class="pipe" data-toggle="tooltip" data-placement="top" title="Pipe de bronze">
                            @elseif($episode->note_id === '2')
                                <img src="{{ asset('images/pipe-argent.png') }}" alt="Pipe d'argent - bon épisode" class="pipe" data-toggle="tooltip" data-placement="top" title="Pipe d'argent">
                            @elseif($episode->note_id === '3')
                                <img src="{{ asset('images/pipe-or.png') }}" alt="Pipe d'or - très bon épisode" class="pipe" data-toggle="tooltip" data-placement="top" title="Pipe d'or">
                            @elseif($episode->note_id === '4')
                                <img src="{{ asset('images/pipe-diamant.png') }}" alt="Pipe de diamant - excellent épisode" class="pipe" data-toggle="tooltip" data-placement="top" title="Pipe de diamant">
                            @endif
                        </h2>
                        <h1 class="episodeShowTitre">{{ $episode->titre }}</h1>
                    </div>
                    <p>saison {{ $episode->saison }} épisode {{ $episode->numero_episode }}</p>
                </div>
            </div>
            @if( strlen($episode->lien) === 11)
                <div class="container mb-5">
                    <div class="row justify-content-center boxPlayer">
                        <div id="player">

                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 d-flex mb-5 blocRizet">
                            <div class="col-6 col-md-6 col-xs-12 texteRizet d-flex flex-column justify-content-center">
                                <p>Si Dominique Rizet</p>
                                <p>est soucieux,</p>
                                <p>c'est que l'épisode</p>
                                <p>n'est pas sur le site...</p><br>
                            </div>
                            <div class="col-6 col-xs-12 photoRizet">
                                <img src="../../images/DominiqueRizet.jpg" alt="Dominique Rizet">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex infosEpisode mb-3">
                        <div class="col-lg-4 col-xs-12" style="border-right: 1px solid #F8D26F">
                            <p><span class="jaune">{{strpos($episode->lieu, ',') ? "Lieux" : "Lieu"}} :</span> {{ $episode->lieu }}</p>
                            <p><span class="jaune">Début de l'affaire : </span>{{ $episode->annee }}</p>
                        </div>
                        <div class="col-lg-4 col-xs-12" style="border-right: 1px solid #F8D26F">
                            <p><span class="jaune">Point de départ : </span>{{ $episode->description }}</p>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            @if( !empty($episode->commentaire))
                                <p><span class="jaune">Commentaire :</span> {{ $episode->commentaire }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12 d-lg-flex justify-content-lg-center">
                        @foreach($episode->tags as $tags)
                            <span class="badge badge-warning m-1">{{$tags->name}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-footer')
    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '360',
                width: '640',
                videoId: '{{ $episode->lien }}',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange,
                }
            });
        }
        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.playVideo();
        }
        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
            }
        }
        function stopVideo() {
            player.stopVideo();
        }

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        let test = document.querySelector('.test').innerHTML;
        let title = document.querySelector('#title');
        title.textContent = test;

        $('meta[name=description]').remove();
        $('head').append( '<meta name="description" content="Faites entrer l\'accusé, épisode : {{ $episode->titre }}">' )


    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
@endsection
