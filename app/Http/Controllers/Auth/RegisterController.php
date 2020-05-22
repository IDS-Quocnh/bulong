<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Confession;
use App\Bulong\Feeds\Feed;
use App\Bulong\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Bulong\Users\Requests\RegisterUserRequest;
use App\Bulong\Users\Repositories\Interfaces\UserRepositoryInterface;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    private $userRepo;

    /**
     * Crate a new controller instance.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest');
        $this->userRepo = $userRepository;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'city_id' => $data['city_id'],
        ]);
    }

    /**
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $year = $request->year;
        $month = $request->month;
        $day = $request->day;

        $request['dob'] = $year.'-'.$month.'-'.$day;
        $request->validate([
            'username' => 'required|max:30|alpha_dash',
            'terms_and_conditions' => 'accepted',
            'dob' => 'before:18 years ago',
        ], [
            'dob.before' => 'You must be at least 18 years old to use Bulong',
            'username.alpha_dash' => 'The username may only contain letters, numbers, dashes and underscores. No spaces allowed'
        ]);

        $user = $this->create($request->except('_method', '_token'));
        Auth::login($user);

        return response()->json(['message' => 'success']);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $date = Carbon::now()->subDays(15);

        $trendingConfessions = Confession::where('created_at', '>=', $date)
        ->orderBy('like', 'desc')->take(2)->get();

        return view('users.register', compact('trendingConfessions'));
    }
}
