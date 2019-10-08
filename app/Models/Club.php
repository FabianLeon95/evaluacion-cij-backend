<?php

namespace App\Models;

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
        'name'
    ];

    public function answers()
    {
        $questions = Question::all()->map(function ($question) {
            return new QuestionsWithAnswers(
                $question->id,
                $question->statement,
                $question->type,
                Answer::where('question_id', $question->id)
                    ->where('club_id', $this->id)
                    ->get()
                    ->toArray());
        });
        return $questions;
    }
}
