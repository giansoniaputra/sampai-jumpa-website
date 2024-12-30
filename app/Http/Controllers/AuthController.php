<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.index');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/pegawai');
        }

        return back()->with('error', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth');
    }

    public function register()
    {
        $data = [
            'title' => 'Register User',
        ];
        return view('admin.auth.register', $data);
    }

    public function dataTables(Request $request)
    {
        $query = User::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>
                <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-id="' . $row->id . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }

    public function create(Request $request)
    {
        $rules = [
            'username' => 'required|min:7',
            'name' => 'required',
            'password' => 'required|confirmed|min:7',
            'password_confirmation' => 'required',
        ];
        $pesan = [
            'username.required' => 'Username Tidak Boleh Kosong',
            'username.min' => 'Username Minimal 7 Character',
            'name.required' => 'Nama Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.confirmed' => 'Password Tidak Sesuai/Sama',
            'password.min' => 'Password Minimal 7 Karakter',
            'password_confirmation.required' => 'Konfirmasi Password Tidak Boleh Kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'username' => $request->username,
                'name' => ucwords(strtolower($request->name)),
                'password' => bcrypt($request->password),
            ];
            User::create($data);
            return response()->json(['success' => "Data User Berhasil Ditambahakan"]);
        }
    }

    public function edit_user($id)
    {
        $akun = User::where('id', $id)->first();
        return response()->json(['data' => $akun]);
    }

    public function update_user(Request $request)
    {
        $rules = [
            'username' => 'required|min:7',
            'name' => 'required',
        ];
        $pesan = [
            'username.required' => 'Username Tidak Boleh Kosong',
            'username.min' => 'Username Minimal 7 Character',
            'name.required' => 'Nama Tidak Boleh Kosong',
        ];
        if ($request->password) {
            $rules['password'] = 'confirmed|min:7';
            $rules['password.confirmed'] = 'Password tidak sesuai';
            $rules['password.min'] = 'Password minimal 7 karakter';
        }
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $data = [
                'username' => $request->username,
                'name' => ucwords(strtolower($request->name)),
            ];
            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }
            User::where('id', $request->id)->update($data);
            return response()->json(['success' => "Data User Berhasil Diubah"]);
        }
    }

    public function delete_user(Request $request, $id)
    {
        User::where('id', $id)->delete();
        return response()->json(['success' => 'Data User Berhasil Dihapus']);
    }
}
