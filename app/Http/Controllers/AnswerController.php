<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Resources\Answer as AnswerResource;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return AnswerResource
     */
    public function store(Request $request)
    {
        $answer = Answer::create($request->all());

        return new AnswerResource($answer);
    }

    /**
     * Display the specified resource.
     *
     * @param Answer $answer
     * @return AnswerResource
     */
    public function show(Answer $answer)
    {
        return new AnswerResource($answer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     * @return AnswerResource
     * @throws \Exception
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return new AnswerResource($answer);
    }
}
