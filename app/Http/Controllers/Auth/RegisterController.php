<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Ditambahkan untuk method registered
use Illuminate\Auth\Events\Registered; // Ditambahkan untuk method registered

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $tarifs = Tarif::all();
        return view('auth.register', ['tarifs' => $tarifs]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:pelanggans'],
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'nomor_kwh' => ['required', 'string', 'max:20', 'unique:pelanggans'],
            'alamat' => ['required', 'string'],
            'id_tarif' => ['required', 'integer', 'exists:tarifs,id_tarif'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pelanggans'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Pelanggan::create([
            'username' => $data['username'],
            'nama_pelanggan' => $data['nama_pelanggan'],
            'nomor_kwh' => $data['nomor_kwh'],
            'alamat' => $data['alamat'],
            'id_tarif' => $data['id_tarif'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    /**
     * Menimpa method register bawaan untuk menggunakan guard 'pelanggan'.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Login otomatis menggunakan guard 'pelanggan'
        $this->guard('pelanggan')->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new \Illuminate\Http\JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }
}