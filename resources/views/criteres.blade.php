@extends ('layouts.master')

@section ('content')
    <div class="container-fluid criteres">
        <div class="container">
            <div class="row criteresTitre" id="countCriteres">
                <h1>Recherchez vos épisodes</h1>
            </div>
            <div class="row">
                <form action="" method="post" id="target" class="criteresInput">
                    @csrf
                    {{-- Présentation radio ou select --}}
                    <div class="form-row flex-column mt-5">
                        <label for="presentateur">Présentation</label>
                        <span class="criteresSpan"></span>
                    </div>
                    <div class="form-row">
                            @foreach($presentateurs as $presentateur)
                                <p>{{ $presentateur->name }}</p>
                                <input type="radio" class="type inputPad" id="presentateur" name="presentateur" value="{{ $presentateur->id }}">
                            @endforeach
                    </div>
                    {{-- Note radio ou select --}}
                    <div class="form-row flex-column mt-5">
                        <label for="note">Note de l'épisode</label>
                        <span class="criteresSpan"></span>
                    </div>
                    <div class="form-row criteresNotes">
                        @foreach($notes as $note)
                                <div class="col-xs-12 d-flex">
                                    <p>{{ $note->name }}</p>
                                    <input type="radio" class="type inputPad" id="note" name="note" value="{{ $note->id }}">
                                </div>
                        @endforeach
                    </div>
                    {{-- Décennie select --}}
                    <div class="form-row flex-column mt-5">
                        <label for="epoque">Époque de l'affaire</label>
                        <span class="criteresSpan"></span>
                    </div>
                    <div>
                        <select name="epoque" id="epoque">
                            <option value="">Toutes</option>
                            @foreach($decennies as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Décor radio ou select --}}
                    <div class="form-row flex-column mt-5">
                        <label for="decor">Décor</label>
                        <span class="criteresSpan"></span>
                    </div>
                    <div class="form-row">
                        @foreach($decors as $decor)
                            <p>{{ $decor->name }}</p>
                            <input type="radio" class="type inputPad" id="decor" name="decor" value="{{ $decor->id }}">
                        @endforeach
                    </div>
                    {{-- Type d'épisode radio ou select --}}
                    <div class="form-row flex-column mt-5">
                        <label for="style">Type d'épisode</label>
                        <span class="criteresSpan"></span>
                    </div>
                    <div class="form-row">
                        @foreach($styles as $style)
                            <p>{{ $style->name }}</p>
                            <input type="radio" class="type inputPad" id="style" name="style" value="{{ $style->id }}">
                        @endforeach
                    </div>
                    {{-- Critères supplémentaires checkbox(interrupteur) --}}
                    <div class="form-row flex-column mt-5">
                        <label for="divers">Critères supplémentaires (plusieurs choix possibles)</label>
                        <span class="criteresSpan"></span>
                    </div>
                    <div class="form-row">
                        @foreach($divers as $d)
                            <div class="col-xs-12 d-flex">
                                <p>{{$d->name}}</p>
                                <input type="checkbox" class="type inputPad" id="divers" name="divers[{{$d->name}}]" value="{{$d->id}}">
                            </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-center mt-4 mb-5">
                        <div>
                            <button type="submit" class="mr-3 criteresButton">Rechercher (<span id="count">{{ $episodes->count() }} résultats</span>)</button>
                        </div>
                        <div>
                            <button type="button" class="criteresButton criteresButtonForm" onclick="clearForm();">Rafraîchir le formulaire</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid criteresGradient">
    </div>
    <div class="container-fluid criteresImage">
    </div>


@endsection

@section('script-footer')
    <!-- Fichiers Javascript -->
    <script type="text/javascript">
        let count = document.querySelector('#count');
        $( "#target" ).change(function( event ) {
//console.log($('input[name=presentateur]').val());
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
                }
            });


            $.ajax({
                url: "/criteresAjax",
                type: 'post',
                data: $('#target').serialize(),
                dataType: 'JSON',

                success: function (data) {
                    test = data;

                    if( $("#target").click())
                    {
                        if(test > 1){
                            $("#count").empty();
                            count.insertAdjacentHTML('beforeend', test + " résultats")
                        }else{
                            $("#count").empty();
                            count.insertAdjacentHTML('beforeend', test + " résultat")
                        }
                    }
                },
                error: function (e) {
                    console.log(e.responseText);
                }

            });

        });

        function clearForm(){
            document.getElementById("target").reset();
            $("#count").empty();
            count.insertAdjacentHTML('beforeend', {{ count($episodes) }} + " résultats");
        }

        let title = document.querySelector('#title');
        title.textContent = "FELA | Recherchez vos épisodes de Faites entrer l'accusé";

        $('meta[name=description]').remove();
        $('head').append( '<meta name="description" content="Trouvez un Faites entrer l\'accusé selon vos critères">' )


    </script>
    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>

@endsection

