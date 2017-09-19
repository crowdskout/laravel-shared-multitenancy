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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile inSources($sourceIds = array())
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

    /**
     * Adds constraints for $sourceIds to eager loaded collections
     * This will limit profile data to only the source ids passed in
     *
     * @param Builder $profile
     * @param array $sourceIds
     */
    public function scopeInSources(Builder $profile, array $sourceIds = [])
    {
        $sourceConstraint = function ($query) {
            return $query; // Start with an empty constraint
        };

        if (!empty($sourceIds)) {
            $sourceConstraint = function ($query) use ($sourceIds) {
                /** @var Builder $query */
                $query->whereIn('source_id', $sourceIds);
            };
        }

        foreach ($profile->getEagerLoads() as $relation => $builder) {
            $profile->orWhereHas($relation, $sourceConstraint); // only grab rows with the source constraint
            $profile->with([$relation => $sourceConstraint]); // reset relations to include the source constraint
        }
    }
}
