@extends('layouts.master')

@section('content')

    <div class="container-fluid affaires">
        <div class="container d-flex flex-column resultatsTitre">
            <div class="row">
                <div class="col-12 affairesRecherche">
                    <form action="{{ '/affaires' }}" method="post" class="action text-center barre-recherche">
                            @csrf
                            <input type="search" name="q" value="{{ $q }}" class="accueilBarre" rows="3">
                            <button type="submit" class="btn cst-btn"><i class="fas fa-search loupe"></i></button>
                    </form>
                </div>
            </div>
            @if($affaires->isEmpty() === true)
                <div class="row justify-content-center mb-4 resultatsNul">
                    <h1>Nous n'avons trouvé aucun épisode pour "{{ $q }}"</h1>
                </div>
            @elseif(count($affaires) > 1)
                <div class="row justify-content-lg-center titreAffaires mb-4">
                    <h1>Voici la liste des épisodes pour "{{ $q }}"</h1>
                </div>
                <div class="row col-12 infosA">
                    <div class="col-lg-7 d-xs-flex infosAffaires">
                        <div class="col-xs-12 nbrResultats">
                            <p>{{count($affaires)}} résultats</p>
                        </div>
                        <div class="col-xs-12">
                            <p><i class="far fa-eye"></i> : l'épisode est visible directement sur le site.</p>
                        </div>
                    </div>
                    <div class="col-5 d-flex align-items-end classementAffaires">
                        <form action="{{'/affairesAjax'}}" method="post" class="d-flex flex-row" id="tri">
                            <p>Classer par : </p>
                            <select name="tri" class="mb-3">
                                <option value="noteBonne">Meilleure note</option>
                                <option value="noteMauvaise">Moins bonne note</option>
                                <option value="dateAncienne">Affaire la plus ancienne</option>
                                <option value="dateRecente">Affaire la plus récente</option>
                            </select>
                            <input type="hidden" name="recherche" value="{{ $q }}">
                        </form>
                    </div>
                </div>
            @elseif(count($affaires) === 1)
                <div class="row justify-content-center mb-4">
                    <h1>Voilà l'unique résultat pour "{{ $q }}"</h1>
                </div>
            @endif
            <div class="row">
                <div class="col-12 d-flex flex-column align-items-center" id="resultatsAffaires">
                    @foreach($affaires as $a)
                        <div class="card m-2 divToclear" style="width: 62rem;">
                            <div class="card-body resultatsCards">
                                <div class="col-12 d-flex ">
                                    <div class="col-2">
                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                            <h2>@if($a->note_id === '1')<img src="{{ asset('images/pipe-bronze.png') }}" alt="Pipe de bronze - épisode moyen" class="pipeCard" data-toggle="tooltip" data-placement="right" title="Pipe de bronze">
                                                @elseif($a->note_id === '2')<img src="{{ asset('images/pipe-argent.png') }}" alt="Pipe d'argent - bon épisode" class="pipeCard" data-toggle="tooltip" data-placement="right" title="Pipe d'argent">
                                                @elseif($a->note_id === '3')<img src="{{ asset('images/pipe-or.png') }}" alt="Pipe d'or - très bon épisode" class="pipeCard" data-toggle="tooltip" data-placement="right" title="Pipe d'or">
                                                @elseif($a->note_id === '4')<img src="{{ asset('images/pipe-diamant.png') }}" alt="Pipe de diamant - excellent épisode" class="pipeCard" data-toggle="tooltip" data-placement="right" title="Pipe de diamant">
                                                @endif</h2>
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div class="col-12 d-flex justify-content-between">
                                            <h1 class="card-title titre"><a href="{{ route('affaire.show', [$a->id, Str::slug($a->titre, '-')] ) }}">{{ $a->titre }} </a></h1>
                                            <span>@if(strlen($a->lien) === 11) <i class="far fa-eye" data-toggle="tooltip" data-placement="top" title="Visible sur le site"></i> @endif</span>
                                        </div>
                                        <div class="col-12 d-flex mt-0">
                                            {{$a->annee}}
                                        </div>
                                        <hr class="hrCards">
                                        <div class="col-12 card-text">
                                            <p>{{ $a->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex">
                                    <div class="col-2">

                                    </div>
                                    <div class="col-10 d-flex flex-wrap justify-content-end">
                                        @foreach($a->tags as $tags)
                                            <span class="badge badge-secondary m-1">{{$tags->name}}</span>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach()
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script-footer')
    <script src="https://kit.fontawesome.com/531842cde4.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        let resultatsAffaires = document.querySelector('#resultatsAffaires');
        let test = document.querySelector('test');

        function slugify(string) {
            const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
            const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
            const p = new RegExp(a.split('').join('|'), 'g')

            return string.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
                .replace(/&/g, '-and-') // Replace & with 'and'
                .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, '') // Trim - from end of text
        }

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        $( "#tri" ).change(function( event ) {
            event.preventDefault();
//console.log('toto');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
                }
            });

            $.ajax({
                url: "/affairesAjax",
                type: 'post',
                data: $('#tri').serialize(),
                dataType: 'JSON',

                success: function (data) {
                    test = data;
                    $('.divToclear').remove();

                    console.log(test.affaires.data);

                    $.each(test.affaires.data, function (key, val) {
                        //console.log(val);
                        var $p = $('<div>').appendTo('#resultatsAffaires').addClass("card m-2 divToclear").css("width", "62rem");
                        var $a = $('<div>').appendTo($p).addClass("card-body resultatsCards");
                        var $z = $('<div>').appendTo($a).addClass("col-12 d-flex");
                        var $w = $('<div>').appendTo($z).addClass("col-2");
                        var $d = $('<div>').appendTo($w).addClass("col-12 d-flex justify-content-center align-items-center");
                        if(val.note_id === '1'){
                            var $j = $('<h2>').appendTo($d);
                            var $m = $('<img>').appendTo($j).attr('src', '../images/pipe-bronze.png').attr('alt', 'Pipe de bronze - épisode moyen').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe de bronze').addClass('pipeCard');
                        }
                        if(val.note_id === '2'){
                            var $j = $('<h2>').appendTo($d);
                            var $m = $('<img>').appendTo($j).attr('src', '../images/pipe-argent.png').attr('alt', 'Pipe d\'argent - bon épisode').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe d\'argent').addClass('pipeCard');
                        }
                        if(val.note_id === '3'){
                            var $j = $('<h2>').appendTo($d);
                            var $m = $('<img>').appendTo($j).attr('src', '../images/pipe-or.png').attr('alt', 'Pipe d\'or - très bon épisode').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe d\'or').addClass('pipeCard');
                        }
                        if(val.note_id === '4'){
                            var $j = $('<h2>').appendTo($d);
                            var $m = $('<img>').appendTo($j).attr('src', '../images/pipe-diamant.png').attr('alt', 'Pipe de diamant - excellent épisode').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe de diamant').addClass('pipeCard');
                        }
                        var $b = $('<div>').appendTo($z).addClass("col-10");
                        var $c = $('<div>').appendTo($b).addClass("col-12 d-flex justify-content-between");
                        var $l = $('<h1>').appendTo($c).addClass("card-title titre");
                        var $s = $('<a>').appendTo($l).attr('href', window.location.url="affaire" + '/' +  val.id + '/' + slugify(val.titre)).addClass("card-title titre").text(val.titre);
                        var $r = $('<span>').appendTo($c);
                        if((val.lien != null)){
                            $('<i>').appendTo($r).addClass("far fa-eye").attr('data-toogle', 'tooltip').attr('data-placement', 'top').attr('aria-hidden', 'true').attr('data-original-title','Visible sur le site');
                        }
                        var $f = $('<div>').appendTo($b).addClass("col-12 d-flex mt-0").text(val.annee);
                        var $i = $('<hr>').appendTo($b).addClass("hrCards");
                        var $k = $('<div>').appendTo($b).addClass("col-12 card-text");
                        var $u = $('<p>').appendTo($k).text(val.description);
                        var $t = $('<div>').appendTo($a).addClass("col-12 d-flex mt-3");
                        var $h = $('<div>').appendTo($t).addClass("col-2");
                        var $g = $('<div>').appendTo($t).addClass("col-10 d-flex flex-wrap justify-content-end");
                    })
                },
                error: function (e) {
                    console.log(e.responseText);
                }

            });

        });


        let title = document.querySelector('#title');
        title.textContent = "FELA | Résultats de votre recherche";

        $('meta[name=description]').remove();
        $('head').append( '<meta name="description" content="Résultats de recherche pour {!! $q !!}">' )

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
@endsection
