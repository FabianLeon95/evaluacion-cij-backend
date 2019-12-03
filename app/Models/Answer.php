<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Answer
 *
 * @property int $id
 * @property int $question_id
 * @property int|null $stars
 * @property int|null $response
 * @property string|null $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereStars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $club_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Answer whereClubId($value)
 */
class Answer extends Model
{
    protected $fillable = [
        'question_id', 'club_id', 'stars', 'response', 'text', 'audio_path'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
