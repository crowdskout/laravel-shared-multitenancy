<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Email
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 * @property int $id
 * @property string $email
 * @property int $profile_id
 * @property int $source_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 */
class Email extends \Eloquent
{
    //
}
