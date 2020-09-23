<?php

namespace App\Http\Controllers;

use App\Model\Episode;
use App\Model\EpisodeTag;
use App\Model\Tag;
use Illuminate\Http\Request;

class CreateEpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view ('create-episode.index')->with('tags', $tags);
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
        // Enregistrement en BDD des épisodes

        $values = $request->all();
        $episode = new Episode();
        $episode->titre = $values['titre'];
        $episode->numero_episode = $values['numero_episode'];
        $episode->saison = $values['saison'];
        $episode->note_id = $values['note'];
        $episode->lien = $values['lien'];
        $episode->lieu = $values['lieu'];
        $episode->annee = $values['annee'];
        $episode->description = $values['description'];
        $episode->commentaire = $values['commentaire'];
        $episode->save();

        // création d'une association Episode/Tag

        foreach ($request->get('tag_id') as $k => $v)
        {
            $episode->tags()->attach($v);
        }
        return view ('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
