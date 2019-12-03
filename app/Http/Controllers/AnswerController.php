<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Resources\Answer as AnswerResource;
use App\Models\Club;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $path = null;
        if ($request->file('audio')) {
            $file = $request->file('audio');
            $fileName = time() . '.wav';
            $path = $file->storeAs('public/audios', $fileName);
        }

        $answer = Answer::create([
            'question_id' => $request->question_id,
            'club_id' => $request->club_id,
            'stars' => $request->stars,
            'response' => $request->response,
            'text' => $request->text,
            'audio_path' => $path ? Storage::url($path) : null,
        ]);

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
        File::delete(public_path() . $answer->audio_path);
        $answer->delete();

        return new AnswerResource($answer);
    }

    public function getQuestionAnswersByClub(Request $request, Club $club, Question $question)
    {
        return Answer::where('club_id', $club->id)
            ->with('question')
            ->where('question_id', $question->id)
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                return $query->whereBetween('created_at', [
                    Carbon::parse($request->start_date)->format('Y-m-d'),
                    Carbon::parse($request->end_date)->format('Y-m-d')
                ]);
            })
            ->get();
    }
}
