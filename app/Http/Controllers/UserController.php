<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $page = "Users";
        return view('dashboardPage.user')->with(compact('users', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'username' => ['required', 'unique:users'],
                'password' => 'required',
                'isAdmin' => 'required',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);

            return redirect()->route('user.index')->with('success', "User data for $request->name has been successfully updated!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('user.index')->with('failed', "Failed to create data for $request->name!" . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
                'username' => ['required', 'unique:users,username,' . $user->id],
                'isAdmin' => 'required',
            ];

            $validatedData = $request->validate($rules);

            User::where('id', $user->id)->update($validatedData);

            return redirect()->route('user.index')->with('success', "User data for $user->name has been successfully updated!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('user.index')->with('failed', 'Failed to update data!' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('user.index')->with('failed', "User $user->name cannot be deleted because it is being used in another table!");
            }
        }

        return redirect()->route('user.index')->with('success', "User $user->name has been successfully deleted!");
    }

    public function resetPasswordAdmin(Request $request, User $user)
    {
        try {
            $rules = [
                'password' => 'required|min:5|max:255',
            ];

            if ($request->password == $request->password2) {
                $validatedData = $request->validate($rules);
                $validatedData['password'] = Hash::make($validatedData['password']);

                $user->update($validatedData);
                return redirect()->route('user.index')->with('success', 'Password has been successfully changed!');
            } else {
                return back()->with('failed', 'Password confirmation does not match!');
            }
        } catch (\Exception $e) {
            return back()->with('failed', 'An error occurred: ' . $e->getMessage());
        }
    }
}
