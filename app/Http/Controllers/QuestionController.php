<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Resources\Question as QuestionResource;

class QuestionController extends Controller
{
    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return QuestionResource
     */
    public function index(Request $request)
    {
        $type = $request->type;

        return $type
            ? new QuestionResource(Question::where('type', $type)->get())
            : new QuestionResource(Question::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return QuestionResource
     */
    public function store(QuestionRequest $request)
    {
        $question = Question::create($request->all());

        return new QuestionResource($question);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param Question $question
     * @return QuestionResource
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->all());

        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return QuestionResource
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return new QuestionResource($question);
    }
}
