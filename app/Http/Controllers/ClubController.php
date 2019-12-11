<?php

namespace App\Http\Controllers;

use App\Http\Resources\Club as ClubResource;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClubController extends Controller
{
    /**
     * ClubController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

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
        $file = $request->file('image');
        $fileName = Str::slug($request->name, '_') . '_img_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/images', $fileName);

        $club = Club::create([
            'name' => $request->name,
            'img_path' => Storage::url($path)
        ]);

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
        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = Str::slug($request->name, '_') . '_img_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/images', $fileName);
            File::delete(public_path() . $club->img_path);
            $club->update([
                'name' => $request->name,
                'img_path' => Storage::url($path)
            ]);
        } else {
            $club->update([
                'name' => $request->name,
            ]);
        }

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
        File::delete(public_path() . $club->img_path);
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
        return response()->json(['data' => $club->answers()]);
    }
}
