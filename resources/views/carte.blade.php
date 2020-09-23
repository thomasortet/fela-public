@extends('layouts.master')

@section('script-header')
    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
          integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
          crossorigin="" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h1>LA CARTE</h1>
            <div id="map">
                <!-- Ici s'affichera la carte -->
            </div>
        </div>
    </div>
@endsection

@section('script-footer')
    <!-- Fichiers Javascript -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script type="text/javascript">

        var test = "";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
                }
            });


            $.ajax({
                url: '/carte',
                type: 'POST',
                data: {},
                dataType: 'JSON',

                success: function (data) {
                    test = data;
                    doWork(test)
                },
                error: function (e) {
                    console.log(e.responseText);
                }

            });

            function doWork(test) {
                 var i = 0;
                 var str = {};
                   // console.log(test);
                 for (var affaires in test) {
                   // (console.log(test[i]['lieu']));
                     var str  = test[i]['lieu'];
                     console.log(str.split(','));
                     i++;

                     if (test[i]['lieu'].search(",") === true) {

                     }
                     else {
                         //console.log(str[i]);
                     }

                    for (var elements in affaires) {
                       // console.log(affaires[elements]);
                    }
                }
            }


            // On initialise la latitude et la longitude du centre de la carte
            var lat = 46.4798;
            var lon = 2.5263;
            var macarte = null;

// Fonction d'initialisation de la carte
            function initMap() {
// Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
                macarte = L.map('map').setView([lat, lon], 6);
// Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
// Il est toujours bien de laisser le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);

// On stocke les coordonnées des villes
                var villes = {
                    "Paris"     : {"lat": 48.85291000 , "lon": 2.34991000, "lien": "https://www.psg.fr"},
                    "Marseille" : {"lat": 43.3330100 , "lon": 5.3979100, "lien": "https://www.psg.fr"},
                    "Quimper"   : { "lat": 48.000, "lon": -4.100, "lien": "https://www.psg.fr" },
                    "Bayonne"   : { "lat": 43.500, "lon": -1.467, "lien": "https://www.psg.fr" },
                    "Nancy"   : { "lat": 48.6833, "lon": 6.2, "lien": "affaire/show/1", "titre": "Simone Weber, la diabolique de Nancy" },
                    "Quimper2"   : { "lat": 48.010, "lon": -4.109, "lien": "affaire/show/1", "titre": "Simone Weber, la diabolique de Nancy" },
                }
// On crée les villes sur la carte
                for (ville in villes) {
                    var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(macarte);
                    marker.bindPopup("<a href=" + villes[ville].lien + ">" + villes[ville].titre + "</a>");
                }
            }

            window.onload = function(){
// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
                initMap();
            };

            function chercher(){

                {{--  var ville = {{$episode->lieu}}; --}}

                if(ville != ""){
                    $.ajax({
                        url: "https://nominatim.openstreetmap.org/search", // URL de Nominatim
                        type: 'get', // Requête de type GET
                        data: "q="+ville+"&format=json&addressdetails=1&limit=1&polygon_svg=1" // Données envoyées (q -> adresse complète, format -> format attendu pour la réponse, limit -> nombre de réponses attendu, polygon_svg -> fournit les données de polygone de la réponse en svg)
                    }).done(function (response) {
                        if(response != ""){
                            userlat = response[0]['lat'];
                            userlon = response[0]['lon'];
                        }
                    }).fail(function (error) {
                        alert(error);
                    });
                }
            }

    </script>
    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
@endsection
