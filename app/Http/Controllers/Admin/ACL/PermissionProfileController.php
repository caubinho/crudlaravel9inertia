<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if(!$profile){
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return Inertia::render('Admin/Profiles/Permissions/Index', [
            'profiles' => $profile,
            'permissions' => $permissions,
        ]);

    }

    public function permissionsAvailable($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $permissions = $profile->permissionsAvailable();


        return Inertia::render('Admin/Profiles/Permissions/Available', [
            'profile' => $profile,
            'permissions' => $permissions,
        ]);
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        if ( ! $request->permissions || count($request->permissions) === 0){
            return redirect()->back()->with('message', 'Necessário vincular uma permissao!');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profile.permissions', $idProfile);

    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('profile.permissions', $profile->id);
    }
}
