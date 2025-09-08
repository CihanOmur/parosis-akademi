<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_visible', 1)->get();
        return view('admin.user.index', [
            'users' => $users,
        ]);
    }
    public function create()
    {
        $roles = Role::where('is_visible', 1)->get();

        return view('admin.user.create', [
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
            'role' => 'required|exists:roles,name',
        ]);
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
        $roles = Role::where('is_visible', 1)->get();
        return view('admin.user.edit', [
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
            'role' => 'required|exists:roles,name',

        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $user->syncRoles([$request->role]);
        return redirect()->route('users.index')->with(['success' => 'Kulllanıcı Düzenlendi']);
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with(['success' => 'Kulllanıcı silindi']);
    }
}
