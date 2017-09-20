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
        return Profile::with(['names', 'emails']);
    }

    /**
     * Prepares a profile and it's collections for output in the view
     *
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
                    'last' => $name->last
                ];
            })->toArray(),
            'emails' => $profile->emails->map(function (Email $email) {
                return [
                    'email' => $email->email
                ];
            })->toArray()
        ];
    }
}
