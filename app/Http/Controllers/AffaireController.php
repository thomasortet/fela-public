<?php

namespace App\Http\Controllers;

use App\Model\Episode;
use App\Model\EpisodePresentateur;
use App\Model\EpisodeTag;
use App\Model\Presentateur;
use App\Model\Note;
use App\Model\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AffaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
// Variable pour la recherche
        $q = request()->input('q');
        $affaires = [];

        if(!empty($q)){
// On recherche les affaires qui correspondent a la recherche
            $affaires = Episode::where('titre' , 'like', "%$q%")
                ->orWhere('lieu', 'like', "%$q%")
                ->orWhere('annee', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->orderBy('note_id', 'desc')
                ->paginate(100);
            if($affaires->isNotEmpty() === true){
                return view('affaires', compact(['affaires', 'q']));
            }else{
                $affaires;
                return view('affaires', compact(['affaires', 'q']));
            }
        }else{
            return view('accueil');
        }
    }

    public function episodesSelecteurSaisons()
    {
        $episodes   = Episode::all()->where('saison', 2);
// A MODIFIER LA PROCHAINE FOIS
        $saisons    = Episode::get('saison')->pluck('saison')->unique();
        return  view ('episodes', compact(['episodes', 'saisons']));
    }

    public function episodesList()
    {
        $q          = request()->input('q');
        $episodes   = Episode::all()->where('saison', $q);
        return  response (compact(['episodes']));
    }

    public function criteres()
    {
        $presentateurs  = Tag::get()->where('parent_tag_name', 'presentation');
        $notes          = Tag::get()->where('parent_tag_name', 'note');
        $decennies      = Tag::get()->where('parent_tag_name', 'ambiance');
        $decors         = Tag::get()->where('parent_tag_name', 'decor');
        $styles         = Tag::get()->where('parent_tag_name', 'style');
        $divers         = Tag::get()->where('parent_tag_name', 'divers');
        $episodes       = Episode::all();

        return view ('criteres', compact(['presentateurs', 'notes', 'decennies', 'decors', 'styles', 'divers', 'episodes']));
    }

    public function showCriteres(Request $request)

    {
        $data = request()->all();
        $arrayTags = collect($data)->except('_token', 'divers');

// Variable pour la recherche
        $presentateurId = $request->presentateur;
        $noteId         = $request->note;
        $decennieId     = $request->epoque;
        $decorId        = $request->decor;
        $styleId        = $request->style;
        $diversIds      = $request->divers;
        $episodes       = EpisodeTag::all();
        $recherche      = [];
        $testId = collect($diversIds)->values();


        if (!empty(request()->all())) {
            foreach ($arrayTags as $arrayTag) {
                if ($arrayTag != null) {
                    $recherche [] = $arrayTag;
                }
            }
            if( $diversIds > 1 ) {
                foreach ($diversIds as $diversId){
                    $recherche [] = $diversId;
                }
            }
            else if ($diversIds === 1) {
                $recherche [] = $diversIds;
            }
            else{
            }
            $episodeTests = Episode::whereHas('tags', function ($query) use ($recherche) {
//  dd($recherche);
                $query->whereIn('tag_id', $recherche);
            }, '=', count($recherche))->orderBy('note_id', 'desc')->get();
            return view('resultats', compact(['episodeTests', 'recherche', 'arrayTags']));
        }
    }

    public function showCriteresAjax(Request $request){

//dd($request->all());

        $data = request()->all();
        $arrayTags = collect($data)->except('_token', 'divers');

// Variable pour la recherche

        $presentateurId = $request->presentateur;
        $noteId         = $request->note;
        $decennieId     = $request->epoque;
        $decorId        = $request->decor;
        $styleId        = $request->style;
        $diversIds      = $request->divers;
        $episodes       = EpisodeTag::all();
        $recherche      = [];
        $testId = collect($diversIds)->values();


        if (!empty(request()->all())) {
            foreach ($arrayTags as $arrayTag) {
                if ($arrayTag != null) {
                    $recherche [] = $arrayTag;
                }
            }
            if( $diversIds > 1 ) {
                foreach ($diversIds as $diversId){
                    $recherche [] = $diversId;
                }
            }
            else if ($diversIds === 1) {
                $recherche [] = $diversIds;
            }
            else{
            }
            $episodeCountAjax = Episode::whereHas('tags', function ($query) use ($recherche) {
//  dd($recherche);
                $query->whereIn('tag_id', $recherche);
            }, '=', count($recherche))->get();
        }
        return response(count($episodeCountAjax));
    }

    public function criteresTriAjax(Request $request)
    {
        $data =  $request->input('q');
        $episodesTri = $request->input('tri');

        $test =  unserialize($data);

        $resultats = " ";

        switch ($episodesTri){
            case 'dateAncienne';
                $resultats = Episode::whereHas('tags', function ($query) use ($test) {
                    $query->whereIn('tag_id', $test);
                }, '=', count($test))
                    ->orderBy('annee', 'asc')
                    ->get();
                break;

            case 'dateRecente';
                $resultats = Episode::whereHas('tags', function ($query) use ($test) {
                    $query->whereIn('tag_id', $test);
                }, '=', count($test))
                    ->orderBy('annee', 'desc')
                    ->get();
                break;

            case 'noteMauvaise';
                $resultats = Episode::whereHas('tags', function ($query) use ($test) {
                    $query->whereIn('tag_id', $test);
                }, '=', count($test))
                    ->orderBy('note_id', 'asc')
                    ->get();
                break;

            case 'noteBonne';
                $resultats = Episode::whereHas('tags', function ($query) use ($test) {
                    $query->whereIn('tag_id', $test);
                }, '=', count($test))
                    ->orderBy('note_id', 'desc')
                    ->get();
                break;
        }
        return response(compact(['resultats']));
    }

    public function episodesTriAjax()
    {
        $episodesTri = request()->input("tri");
        $q = request()->input('recherche');


        switch ($episodesTri){
            case 'dateAncienne';
                $affaires = Episode::where('titre' , 'like', "%$q%")
                    ->orWhere('lieu', 'like', "%$q%")
                    ->orWhere('annee', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orderBy('annee', 'asc')
                    ->paginate(100);
                break;
            case 'dateRecente';
                $affaires = Episode::where('titre' , 'like', "%$q%")
                    ->orWhere('lieu', 'like', "%$q%")
                    ->orWhere('annee', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orderBy('annee', 'desc')
                    ->paginate(100);
                break;
            case 'noteMauvaise';
                $affaires = Episode::where('titre' , 'like', "%$q%")
                    ->orWhere('lieu', 'like', "%$q%")
                    ->orWhere('annee', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orderBy('note_id', 'asc')
                    ->paginate(100);
                break;
            case 'noteBonne';
                $affaires = Episode::where('titre' , 'like', "%$q%")
                    ->orWhere('lieu', 'like', "%$q%")
                    ->orWhere('annee', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orderBy('note_id', 'desc')
                    ->paginate(100);
                break;
        }

        $test = $affaires->unique(function ($item) {
            return $item['titre'].$item['slug'];
        });
        $test->values()->all();

        return response(compact(['affaires','test']));
    }

    public function aleatoire()
    {
        $episode = Episode::inRandomOrder()->get()->whereNotNull('lien')->first();
        return redirect( 'affaire/'. $episode->id . "/" . Str::slug($episode->titre));

    }

    public function carte()
    {
        return view ('carte');
    }

    public function carteApi()
    {

        Log::info("carteApi()");
        $episodes = Episode::get(['id', 'titre', 'lieu', 'note_id']);
        return response()->json($episodes, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $episode    = Episode::find($id);
        $note       = $episode->tags->where('parent_tag_name', 'note')->pluck(('name'));

        return view('affaire', compact(['episode', 'note']));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//
    }
}
