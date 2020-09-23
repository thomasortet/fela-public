@extends ('layouts.master')

@section('content')
 <div class="container">

     <div class="row">
         <form action="" method="post">
         @csrf
                {{-- TITRE --}}
             <label for="titre">Titre</label>
             <input class="form-control" type="text" id=titre" name="titre" placeholder="Titre">
             <br>

             {{-- SAISON --}}
             <label for="saison">Numéro de la saison</label>
             <select class="form-control" id="saison" name="saison">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                 <option value="6">6</option>
                 <option value="7">7</option>
                 <option value="8">8</option>
                 <option value="9">9</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option>
                 <option value="13">13</option>
                 <option value="14">14</option>
                 <option value="15">15</option>
                 <option value="16">16</option>
                 <option value="17">17</option>
                 <option value="18">18</option>
                 <option value="19">19</option>
                 <option value="20">20</option>
             </select>
             <br>

             {{-- NUMERO EPISODE --}}
             <label for="numero_episode">Numéro de l'épisode</label>
             <select class="form-control" id="numero_episode" name="numero_episode">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                 <option value="6">6</option>
                 <option value="7">7</option>
                 <option value="8">8</option>
                 <option value="9">9</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option>
                 <option value="13">13</option>
                 <option value="14">14</option>
                 <option value="15">15</option>
                 <option value="16">16</option>
                 <option value="17">17</option>
                 <option value="18">18</option>
                 <option value="19">19</option>
                 <option value="20">20</option>
             </select>
             <br>

             {{-- NOTE --}}
             <label for="note">Note</label>
             <select class="form-control" id="note" name="note">
                 <option value="1">Bronze</option>
                 <option value="2">Argent</option>
                 <option value="2">Or</option>
                 <option value="4">Platine</option>
             </select>
             <br>

             {{-- LIEN --}}
             <label for="lien">Lien</label>
             <input class="form-control" type="text" id="lien" name="lien" placeholder="Lien">
             <br>

             {{-- LIEU --}}
             <label for="lieu">Lieu</label>
             <input class="form-control" type="text" id="lieu" name="lieu" placeholder="Lieu">
             <br>

             {{-- ANNEE --}}
             <label for="annee">Année de début de l'affaire</label>
             <input class="form-control" type="text" id="annee" name="annee" placeholder="Default input">
             <br>

             {{-- DESCRIPTION --}}

             <div class="form-group">
                 <label for="description">Description</label>
                 <textarea class="form-control" id="description" name="description" rows="3"></textarea>
             </div>
             <br>

             {{-- COMMENTAIRE --}}

             <div class="form-group">
                 <label for="commentaire">Commentaire</label>
                 <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
             </div>
             <br>

             {{-- TAGS --}}
             <div>
                 @foreach($tags as $tag)
                     <label for="tag_id">{{ $tag->name }}</label>
                         <input type="checkbox" id="tag_id" name="tag_id[{{ $tag->id }}]"  value="{{ $tag->id }}">
                 @endforeach

             </div>



             <button type="submit">Envoyer</button>

         </form>


     </div>


 </div>


@endsection
