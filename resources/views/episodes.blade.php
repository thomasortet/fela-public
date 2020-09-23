@extends ('layouts.master')

@section ('content')
    <div class="container-fluid episodes">
        <div class="container">
            <div class="row episodesTitre">
                <h1>FAITES ENTRER L'ACCUSÉ - <span id="saisonsNumero">Saison 2</span></h1>
            </div>
            <div class="row d-flex justify-content-between">
                <form action="" method="post" id="saisonsTable" class="EpisodesInput">
                    @csrf
                    <div class="form-row flex-column mt-5">
                        <label for="saison">Liste des saisons</label>
                        <span class="criteresSpan"></span>
                    </div>
                    <div>
                        <select name="q" id="saison" class="mb-3">
                            <option value="2">Sélectionnez votre saison</option>
                            @foreach($saisons as $saison)
                                <option value="{{ $saison }}">Saison {{ $saison }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="d-flex align-items-end">
                    <p><i class="far fa-eye"></i> : l'épisode est visible directement sur le site.</p>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table id="tableResponsive" class="table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Année</th>
                            <th scope="col">Note</th>
                        </tr>
                        </thead>
                        <tbody id="saisonsTableBody">
                        @foreach($episodes as $episode)
                            <tr class="trToClear">
                                <th scope="row" class="episodesNumero">{{$episode->numero_episode}}</th>
                                <td id="lien"><a class="lienA pr-2" href="{{ route('affaire.show', [$episode->id, Str::slug($episode->titre, '-') ]) }}">{{$episode->titre}}</a>
                                    @if(strlen($episode->lien) === 11)<i class="far fa-eye"></i> @endif</td>
                                <td class="pt-auto episodesAnnee">{{$episode->annee}}</td>
                                <td class="episodesPipe">@if($episode->note_id === '1')<img src="../images/pipe-bronze.png" alt="Pipe de bronze - épisode moyen" class="pipe" data-toggle="tooltip" data-placement="right" title="Pipe de bronze">
                                    @elseif($episode->note_id === '2')<img src="../images/pipe-argent.png" alt="Pipe d'argent - bon épisode" class="pipe" data-toggle="tooltip" data-placement="right" title="Pipe d'argent">
                                    @elseif($episode->note_id === '3')<img src="../images/pipe-or.png" alt="Pipe d'or - très bon épisode" class="pipe" data-toggle="tooltip" data-placement="right" title="Pipe d'or">
                                    @elseif($episode->note_id === '4')<img src="../images/pipe-diamant.png" alt="Pipe de diamant - excellent épisode" class="pipe" data-toggle="tooltip" data-placement="right" title="Pipe de diamant">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection

@section ('script-footer')
    <!-- Fichiers Javascript -->
    <script type="text/javascript">
        $()

        let saisons         = document.querySelector('#saisonsTable');
        let saisonsBody     = document.querySelector('#saisonsTableBody');
        let saisonsNumero   = document.querySelector('#saisonsNumero');
        let $lien           = document.querySelector('#lien');

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
        $('#saisonsTable').change( function() { ajaxCall(); console.log('test selecteur') });
        $(window).on( "load", function() { ajaxCall();  console.log('test load') })
        function ajaxCall() {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
                }
            });
            $.ajax({
                url: "/episodes",
                type: 'post',
                data: $('#saisonsTable').serialize(),
                dataType: 'JSON',
                success: function (data) {
                    test = data;
                    console.log(data);
                    $(".trToClear").remove();
                    $("#tableResponsive").addClass('table-responsive-sm')
                    //console.log(test);
                    $.each(test.episodes, function (key, val) {
                        var $p = $('<tr>').appendTo(saisonsBody).addClass('trToClear');
                        var $a = $('<th>').appendTo($p).text(val.numero_episode).attr('scope', 'row').addClass('episodesNumero');
                        var $u = $('<td>').appendTo($p).attr('id', 'lien');
                        var $z = $('<a>').appendTo($u).attr('href', window.location.url = "affaire" + '/' + val.id + '/' + slugify(val.titre)).text(val.titre).addClass('lienA').addClass('pr-2');
                        if (val.lien != null) {
                            var $x = $('<i>').appendTo($u).addClass('far fa-eye');
                        }
                        var $l = $('<td>').appendTo($p).text(val.annee).addClass('pt-auto').addClass('episodesAnnee');
                        if (val.note_id === '1') {
                            var $t = $('<td>').appendTo($p).addClass('episodesPipe');
                            var $h = $('<img>').appendTo($t).attr('src', '../images/pipe-bronze.png').attr('alt', 'Pipe de bronze - épisode moyen').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe de bronze').addClass('pipe');
                        }
                        if (val.note_id === '2') {
                            var $t = $('<td>').appendTo($p).addClass('episodesPipe');
                            var $h = $('<img>').appendTo($t).attr('src', '../images/pipe-argent.png').attr('alt', 'Pipe d\'argent - bon épisode').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe d\'argent').addClass('pipe');
                        }
                        if (val.note_id === '3') {
                            var $t = $('<td>').appendTo($p).addClass('episodesPipe');
                            var $h = $('<img>').appendTo($t).attr('src', '../images/pipe-or.png').attr('alt', 'Pipe d\'or - très bon épisode').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe d\'or').addClass('pipe');
                        }
                        if (val.note_id === '4') {
                            var $t = $('<td>').appendTo($p).addClass('episodesPipe');
                            var $h = $('<img>').appendTo($t).attr('src', '../images/pipe-diamant.png').attr('alt', 'Pipe de diamant - excellent épisode').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Pipe de diamant').addClass('pipe');
                        }
                    });
                    $(document).ready(function () {
                        $('[data-toggle="tooltip"]').tooltip();
                    });
                    $('#saisonsNumero').empty();
                    let toto = $('#saison').val();
                    //console.log(toto);
                    saisonsNumero.insertAdjacentHTML('beforeend', 'Saison ' + toto);
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
        }

        let title = document.querySelector('#title');
        title.textContent = "FELA | Tous les épisodes de Faites entrer l'accusé";

        $('meta[name=description]').remove();
        $('head').append( '<meta name="description" content="Toutes les saisons, tous les épisodes de Faites entrer l\'accusé">' )

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
@endsection




