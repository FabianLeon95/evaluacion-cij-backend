<?php

namespace App\Http\Controllers;

use App\Http\Resources\Club as ClubResource;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ClubResource
     */
    public function index()
    {
        return new ClubResource(Club::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ClubResource
     */
    public function store(Request $request)
    {
        $club = Club::create($request->all());

        return new ClubResource($club);
    }

    /**
     * Display the specified resource.
     *
     * @param Club $club
     * @return ClubResource
     */
    public function show(Club $club)
    {
        return new ClubResource($club);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Club $club
     * @return ClubResource
     */
    public function update(Request $request, Club $club)
    {
        $club->update($request->all());

        return new ClubResource($club);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Club $club
     * @return ClubResource
     * @throws \Exception
     */
    public function destroy(Club $club)
    {
        $club->delete();

        return new ClubResource($club);
    }

    /**
     * Display a listing of the answers.
     *
     * @param Club $club
     */
    public function answers(Club $club)
    {
        return response()->json(['data'=>$club->answers()]);
    }
}
