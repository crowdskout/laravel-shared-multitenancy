<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * App\Profile
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Name[] $names
 */
class Profile extends \Eloquent
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function emails()
    {
        return $this->hasMany('App\Email');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function names()
    {
        return $this->hasMany('App\Name');
    }
}
