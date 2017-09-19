<?php

namespace App\Http\Controllers;

use App\CustomerUser;
use App\Email;
use App\Name;
use App\Profile;
use App\Source;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->getProfileQuery()->limit(20)->get()->map([$this, 'transformProfile']);
        return view('home', ['table' => $table->toArray()]);
    }

    public function profile($profileId)
    {
        $table = $this->getProfileQuery()->where('id', '=', $profileId)->get()->map([$this, 'transformProfile']);
        return view('home', ['table' => $table->toArray()]);
    }

    /**
     * Returns a profile model with source id constraints and eager loaded collections
     *
     * @return Profile|Builder
     */
    public function getProfileQuery()
    {
        // assemble source id constraints from query params
        $sourceIds = [];
        if ($customerId = \Request::input('customer')) {
            $sourceIds = Source::fromCustomer($customerId)->pluck('id')->toArray();
        } else if ($sourceId = \Request::input('source')) {
            $sourceIds = [$sourceId];
        }

        return Profile::with(['names', 'emails'])->inSources($sourceIds);
    }

    /**
     * @param Profile $profile
     * @return array
     */
    public static function transformProfile(Profile $profile)
    {
        return [
            'id' => $profile->id,
            'names' => $profile->names->map(function (Name $name) {
                return [
                    'first' => $name->first,
                    'last' => $name->last,
                    'source_id' => $name->source_id
                ];
            })->toArray(),
            'emails' => $profile->emails->map(function (Email $email) {
                return [
                    'email' => $email->email,
                    'source_id' => $email->source_id
                ];
            })->toArray()
        ];
    }
}
