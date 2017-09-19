<?php

namespace App;

/**
 * App\CustomerUser
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 * @property int $id
 * @property int $customer_id
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerUser whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerUser whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Customer[] $customers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Source[] $sources
 */
class CustomerUser extends \Eloquent
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
        return $this->belongsToMany('App\Source', 'customer_sources', 'customer_id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
