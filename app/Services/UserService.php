<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ImageTrait;
use App\Traits\UserTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Auth, Hash, Storage};
use Spatie\Permission\Models\Role;use Spatie\Permission\Models\Permission;

class UserService
{
    use UserTrait, ImageTrait;

    protected $user;

    /**
     * __construct
     *
     * @param  mixed $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * get
     *
     * @return void
     */
    public function get()
    {
        return Auth::user();
    }

    /**
     * getAllPermissions
     *
     * @param  mixed $roles
     * @return void
     */
    public function getAllPermissions($roles): array
    {
        /** @var object User */
        $currentUser = Auth::user();
        return $currentUser->getAllPermissions()->whereIn('name', $roles)->flatten()->toArray();
    }

    /**
     * changePassword
     *
     * @param  mixed $password
     * @param  mixed $user
     * @return void
     */
    /**
     * changePassword
     *
     * @param  mixed $password
     * @param  mixed $user
     * @return void
     */
    public function changePassword($password, $user)
    {
        $data = [
            'password' => Hash::make($password)
        ];

        return $user->update($data);
    }

    /**
     * userCount
     *
     * @return void
     */
    public function userCount()
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('super-admin')) {
            return $this->user->count();
        } else {
            $roles = $this->showRoles();
            return $this->user->role($roles)->count();
        }
    }

    /**
     * showRoles
     *
     * @return void
     */
    public function showRoles(): array
    {
        $roles = Role::all()->reject(function ($role) {
            return $role->name === 'super-admin';
        })->map(function ($role) {
            return 'read-' . $role->name;
        })->toArray();

        /** @var Permission */
        $permissions =  $this->getAllPermissions($roles);

        $roles = [];

        foreach ($permissions as $permission) {
            $roles[] = last(explode('-', $permission['name']));
        }
        return $roles;
    }

    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save($request)
    {
        $this->user->create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make(request('password')),
        ])->assignRole($request->role);
    }

    /**
     * modify
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function modify($request, $id)
    {
        $user = $this->user->findOrFail($id);

        $user->name       = request('name');
        $user->password   = request('password') ? Hash::make(request('password')) : $user->password;
        $user->email      = request('email');
        $user->updated_at = Carbon::now();

        // if (request()->missing('status')) {
        //     $user->ban();
        //     $user->active = '0';
        // } else {
        //     if ($user->isBanned()) {
        //         $user->unban();
        //         $user->active = 1;
        //     }
        // }

        $user->save();
        $user->syncRoles($request->role);
    }

    /**
     * remove
     *
     * @param  mixed $id
     * @return void
     */
    public function remove($id)
    {
        $user = $this->user->findOrFail($id);

        if ($user->photo) {
            $this->diskStorage()->delete('avatar/' . $user->photo);
        }

        return $user->delete();
    }

    /**
     * massRemove
     *
     * @param  mixed $id
     * @return void
     */
    public function massRemove($id): array
    {
        $user_id_array = $id;

        $users = $this->user->whereIn('id', $user_id_array)->get();

        foreach ($users as $item) {
            if ($item->photo) {
                $this->diskStorage()->delete('avatar/' . $item->photo);
            }
        }

        return $this->user->whereIn('id', $user_id_array);
    }

}
