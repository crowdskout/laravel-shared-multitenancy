<?php

namespace App;

/**
 * App\CustomerSource
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 * @property int $id
 * @property int $customer_id
 * @property int $source_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerSource whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerSource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerSource whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerSource whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Customer[] $customers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Source[] $sources
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 */
class CustomerSource extends \Eloquent
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sources()
    {
        return $this->hasMany('App\Source');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'customer_users', 'customer_id', 'customer_id');
    }
}
