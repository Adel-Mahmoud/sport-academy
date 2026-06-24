<?php

namespace App\Domains\Users\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Users\Repositories\UserRepository;
use App\Domains\Users\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;

class UserController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        // Permissions
        $this->middleware('permission:view users')->only(['index']);
        $this->middleware('permission:create user')->only(['create', 'store']);
        $this->middleware('permission:edit user')->only(['edit', 'update']);
        $this->middleware('permission:delete user')->only(['destroy']);
    }

    public function index(): View
    {
        $titlePage = 'المستخدمين';
        return view('users::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $sectionPage = 'المستخدمين';
        $titlePage = 'مستخدم جديد';
        $roles = Role::all();
        return view('users::admin.create', compact('sectionPage', 'titlePage', 'roles'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        return redirect()
            ->route('admin.users.index')
            ->with('swal', [
                'type'  => 'success',
                'title' => 'تم الإضافة!',
                'text'  => 'تمت إضافة البيانات بنجاح.',
            ]);
    }

    public function edit($id): View
    {
        $sectionPage = 'المستخدمين';
        $titlePage = 'تعديل مستخدم';
        $user = $this->repository->find($id);
        $roles = Role::all();
        return view('users::admin.edit', compact('user', 'sectionPage', 'titlePage', 'roles'));
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        $this->repository->update($id, $request->validated());
        return redirect()
                ->route('admin.users.index')
                ->with('swal', [
                    'type'  => 'success',
                    'title' => 'تم التعديل!',
                    'text'  => 'تم تعديل البيانات بنجاح.',
                ]);
    }

    public function destroy($id): RedirectResponse
    {
        $this->repository->delete($id);
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
