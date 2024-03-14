<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\{RoleService, UserService};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\{Auth, Gate};
use App\Http\Requests\Backend\Users\UserRequest;

class UserController extends Controller
{
    private $userService, $roleService;

    /**
     * __construct
     *
     * @param  mixed $userService
     * @return void
     */
    public function __construct(
        UserService $userService,
        RoleService $roleService
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;

        $this->middleware('permission:read-users', ['only' => 'index']);
        $this->middleware('permission:add-users', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-users', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roleSelected = (Auth::user()->roles->pluck('name')[0] == 'super-admin') ? 'admin' : 'author';
        $roles = $this->roleService->roles();
        return view('backend.users.create', compact('roles', 'roleSelected'));
    }


    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        $this->userService->save($request);

        return redirect()->route('user.index')
            ->withSuccess(__('message.saved_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        // $image = $this->showAvatarInUploadContainer($user->photo);

        $links = json_decode($user->links);
        $roles = $this->roleService->roles();

        return view(
            'backend.users.edit',
            compact(
                'user',
                'links',
                'roles'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $request->validated();
        $this->userService->modify($request, $id);

        return redirect()->route('user.index')
            ->withSuccess(__('message.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-users')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $this->userService->remove($id);
        return response()->json(['success' => __('message.deleted_successfully')]);
    }

    /**
     * massdestroy
     *
     * @return void
     */
    public function massdestroy()
    {
        if (!Gate::allows('delete-users')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $id = request('id');
        $user = $this->userService->massRemove($id);

        if ($user instanceof User && $user->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }
}