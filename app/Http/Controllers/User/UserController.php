<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ValidationMessageService;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_visible', 1)->paginate(15);
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }
    public function create()
    {
        $roles = Role::where('is_visible', 1)->with('permissions')->get();

        return view('admin.users.create', [
            'roles' => $roles
        ]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:220',
            'email' => 'required|email|max:220|unique:users,email',
            'phone' => 'required|string|max:13|unique:users,phone',
            'password' => 'required|string|max:230',
            'role' => 'required|array',
            'role.*' => 'exists:roles,name',
        ], ValidationMessageService::getMessages('user_store'));

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assignRole($request->role);
        return redirect()->route('users.index')->with(['success' => 'Kulllanıcı oluşturuldu']);
    }
    public function edit($id)
    {
        $user = User::with(['roles'])->findOrFail($id);
        $roles = Role::where('is_visible', 1)->with('permissions')->get();
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:220',
            'email' => 'required|email|max:220|unique:users,email,' . $id,
            'phone' => 'required|string|max:13|unique:users,phone,' . $id,
            'password' => 'nullable|string|max:230',
            'role' => 'required|array',
            'role.*' => 'exists:roles,name',
        ], ValidationMessageService::getMessages('user_update'));

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with(['success' => 'Kulllanıcı Düzenlendi']);
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with(['success' => 'Kulllanıcı silindi']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:220',
            'password' => 'required|string',
        ], ValidationMessageService::getMessages('user_login'));

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('students.index');
        }
        return back()->withErrors([
            'check' => 'Kullanıcı adı veya şifre hatalı.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
