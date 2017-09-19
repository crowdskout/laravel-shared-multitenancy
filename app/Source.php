<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Source
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Source whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Source whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Source whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Source whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Customer[] $customers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Source fromCustomer($customerId)
 */
class Source extends \Eloquent
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'customer_sources');
    }

    public function scopeFromCustomer(Builder $query, $customerId)
    {
        $query->whereHas('customers', function (Builder $query) use ($customerId) {
            $query->where('customer_id', '=', $customerId);
        });
    }

    public static function permissioned()
    {
        return self::whereIn('id', self::permissionedIds())->get();
    }

    public static function permissionedIds()
    {
        return \DB::table('customer_users as u')
            ->join('customer_sources as s', 'u.customer_id', '=', 's.customer_id')
            ->where('u.user_id', '=', \Auth::id())
            ->distinct()
            ->pluck('s.source_id');
    }
}
