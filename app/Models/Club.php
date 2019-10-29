<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Club
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Club newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Club newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Club query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Club whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Club whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Club whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Club whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Club extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'img_path'
    ];

    public function answers()
    {
        $questions = Question::all()->map(function ($question) {
            return new QuestionsWithAnswers(
                $question->id,
                $question->statement,
                $question->type,
                $this->countAnswers(Answer::where('question_id', $question->id)
                    ->where('club_id', $this->id)
                    ->get(), $question->type)
            );
        });
        return $questions;
    }

    private function countAnswers(Collection $answers, $type)
    {
        switch ($type) {
            case 'stars':
                return [
                    '1 estrella' => $answers->where('stars', '1')->count(),
                    '2 estrellas' => $answers->where('stars', '2')->count(),
                    '3 estrellas' => $answers->where('stars', '3')->count(),
                    '4 estrellas' => $answers->where('stars', '4')->count(),
                    '5 estrellas' => $answers->where('stars', '5')->count(),
                ];
            default:
                return $answers;
        }
    }

}
