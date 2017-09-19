<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Name
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 * @property int $id
 * @property string $first
 * @property string $last
 * @property int $profile_id
 * @property int $source_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Name whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Name whereFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Name whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Name whereLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Name whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Name whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Name whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Profile[] $profiles
 */
class Name extends \Eloquent
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('source', function (Builder $builder) {
            $builder->whereIn('source_id', Source::permissionedIds());
        });
    }
}
