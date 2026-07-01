<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeDomain extends Command
{
    protected $signature = 'make:domain {name : The name of the domain}
                            {--table : Generate migration table}
                            {--policy : Generate policy class}
                            {--repository : Generate repository class}
                            {--livewire : Generate livewire class}
                            {--request : Generate request classes (Store/Update)}
                            {--dto : Generate DTO classes (Create/Update)}
                            {--usecase : Generate UseCase classes (Get/Register/Update)}
                            {--views : Generate admin CRUD blade views}
                            {--all : Generate everything (migration, policy, repository, request, livewire, dto, usecase, views, full CRUD)}';

    protected $description = 'Create a new domain structure (mirrors the Coaches domain) with a default "name" field';

    protected string $modelName;
    protected string $className;
    protected string $tableName;
    protected string $singular;
    protected string $kebabPlural;
    protected string $variable;
    protected string $variablePlural;
    protected string $viewNamespace;

    public function handle(): void
    {
        $input = $this->argument('name');
        $this->name = Str::pluralStudly(Str::studly($input));
        $this->className = Str::studly(Str::singular($input));
        $this->tableName = Str::snake($this->name);
        $this->singular = Str::snake($this->className);
        $this->kebabPlural = Str::kebab($this->name);
        $this->variable = Str::camel($this->className);
        $this->variablePlural = Str::camel($this->name);
        $this->viewNamespace = Str::lower($this->name);

        $domainPath = app_path("Domains/{$this->name}");
        $generateAll = (bool) $this->option('all');

        $this->createDirectoryStructure($domainPath);
        $this->createModel($domainPath);
        $this->createControllers($domainPath, $generateAll);
        $this->createRoutes($domainPath, $generateAll);
        $this->createWebView($domainPath);

        if ($generateAll || $this->option('table')) {
            $this->createMigration($domainPath);
        }

        if ($generateAll || $this->option('policy')) {
            $this->createPolicy($domainPath);
        }

        if ($generateAll || $this->option('repository')) {
            $this->createRepository($domainPath);
        }

        if ($generateAll || $this->option('request')) {
            $this->createRequests($domainPath);
        }

        if ($generateAll || $this->option('dto')) {
            $this->createDTOs($domainPath);
        }

        if ($generateAll || $this->option('usecase')) {
            $this->createUseCases($domainPath);
        }

        if ($generateAll || $this->option('livewire')) {
            $this->createLivewire($domainPath);
        }

        if ($generateAll || $this->option('views')) {
            $this->createAdminViews($domainPath);
        }

        $this->info("Domain {$this->name} created successfully.");
    }

    private function createDirectoryStructure(string $domainPath): void
    {
        $directories = [
            "{$domainPath}/Models",
            "{$domainPath}/Controllers/Web",
            "{$domainPath}/Controllers/Admin",
            "{$domainPath}/Routes",
            "{$domainPath}/Views/web",
            "{$domainPath}/Views/admin",
            "{$domainPath}/Views/livewire",
            "{$domainPath}/Database/Migrations",
            "{$domainPath}/DTOs",
            "{$domainPath}/Policies",
            "{$domainPath}/Repositories",
            "{$domainPath}/Requests",
            "{$domainPath}/UseCases",
            "{$domainPath}/Livewire",
        ];

        foreach ($directories as $dir) {
            File::ensureDirectoryExists($dir);
        }
    }

    private function createModel(string $domainPath): void
    {
        $path = "{$domainPath}/Models/{$this->className}.php";
        if (File::exists($path)) {
            return;
        }
        File::put($path, $this->getModelStub());
        $this->info("Model created: {$path}");
    }

    private function createControllers(string $domainPath, bool $full): void
    {
        $webPath = "{$domainPath}/Controllers/Web/{$this->className}Controller.php";
        File::put($webPath, $this->getWebControllerStub());
        $this->info("Web Controller created: {$webPath}");

        $adminPath = "{$domainPath}/Controllers/Admin/{$this->className}Controller.php";
        File::put(
            $adminPath,
            $full ? $this->getAdminControllerFullStub() : $this->getAdminControllerBasicStub()
        );
        $this->info("Admin Controller created: {$adminPath}");
    }

    private function createRoutes(string $domainPath, bool $full): void
    {
        $webRoutes = <<<PHP
<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('{$this->kebabPlural}')->group(function () {
    Route::get('/', [App\Domains\\{$this->name}\Controllers\Web\\{$this->className}Controller::class, 'index']);
});
PHP;

        $adminRoutes = <<<PHP
<?php

use Illuminate\Support\Facades\Route;
use App\Domains\\{$this->name}\Controllers\Admin\\{$this->className}Controller;

Route::middleware(['web', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('{$this->kebabPlural}', {$this->className}Controller::class);
});
PHP;

        File::put("{$domainPath}/Routes/web.php", $webRoutes);
        File::put("{$domainPath}/Routes/admin.php", $adminRoutes);
        $this->info("Routes created: {$domainPath}/Routes");
    }

    private function createWebView(string $domainPath): void
    {
        $path = "{$domainPath}/Views/web/index.blade.php";
        if (!File::exists($path)) {
            File::put($path, "<h1>{$this->name} Web Index</h1>\n");
            $this->info("Web view created: {$path}");
        }
    }

    private function createMigration(string $domainPath): void
    {
        $timestamp = now()->format('Y_m_d_His');
        $path = "{$domainPath}/Database/Migrations/{$timestamp}_create_{$this->tableName}_table.php";
        File::put($path, $this->getMigrationStub());
        $this->info("Migration created: {$path}");
    }

    private function createPolicy(string $domainPath): void
    {
        $path = "{$domainPath}/Policies/{$this->className}Policy.php";
        File::put($path, $this->getPolicyStub());
        $this->info("Policy created: {$path}");
    }

    private function createRepository(string $domainPath): void
    {
        $path = "{$domainPath}/Repositories/{$this->className}Repository.php";
        File::put($path, $this->getRepositoryStub());
        $this->info("Repository created: {$path}");
    }

    private function createRequests(string $domainPath): void
    {
        $storePath = "{$domainPath}/Requests/Store{$this->className}Request.php";
        $updatePath = "{$domainPath}/Requests/Update{$this->className}Request.php";

        File::put($storePath, $this->getStoreRequestStub());
        File::put($updatePath, $this->getUpdateRequestStub());

        $this->info("Requests created: {$storePath}");
        $this->info("Requests created: {$updatePath}");
    }

    private function createDTOs(string $domainPath): void
    {
        $createPath = "{$domainPath}/DTOs/Create{$this->className}Data.php";
        $updatePath = "{$domainPath}/DTOs/Update{$this->className}Data.php";

        File::put($createPath, $this->getCreateDtoStub());
        File::put($updatePath, $this->getUpdateDtoStub());

        $this->info("DTOs created: {$createPath}");
        $this->info("DTOs created: {$updatePath}");
    }

    private function createUseCases(string $domainPath): void
    {
        $get = "{$domainPath}/UseCases/Get{$this->className}UseCase.php";
        $register = "{$domainPath}/UseCases/Register{$this->className}UseCase.php";
        $update = "{$domainPath}/UseCases/Update{$this->className}UseCase.php";

        File::put($get, $this->getGetUseCaseStub());
        File::put($register, $this->getRegisterUseCaseStub());
        File::put($update, $this->getUpdateUseCaseStub());

        $this->info("UseCase created: {$get}");
        $this->info("UseCase created: {$register}");
        $this->info("UseCase created: {$update}");
    }

    private function createLivewire(string $domainPath): void
    {
        $componentFile = "{$domainPath}/Livewire/{$this->name}Index.php";
        if (!File::exists($componentFile)) {
            File::put($componentFile, $this->getLivewireStub());
            $this->info("Livewire Component created: {$componentFile}");
        }

        $bladeFile = "{$domainPath}/Views/livewire/{$this->kebabPlural}-index.blade.php";
        if (!File::exists($bladeFile)) {
            File::put($bladeFile, $this->getLivewireBladeStub());
            $this->info("Livewire Blade view created: {$bladeFile}");
        }
    }

    private function createAdminViews(string $domainPath): void
    {
        $index = "{$domainPath}/Views/admin/index.blade.php";
        $create = "{$domainPath}/Views/admin/create.blade.php";
        $edit = "{$domainPath}/Views/admin/edit.blade.php";

        File::put($index, $this->getAdminIndexBlade());
        File::put($create, $this->getAdminCreateBlade());
        File::put($edit, $this->getAdminEditBlade());

        $this->info("Admin views created in: {$domainPath}/Views/admin");
    }

    protected function getModelStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Models;

use Illuminate\Database\Eloquent\Model;

class {$this->className} extends Model
{
    protected \$fillable = [
        'name',
    ];
}
PHP;
    }

    protected function getWebControllerStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Controllers\Web;

use App\Http\Controllers\Controller;

class {$this->className}Controller extends Controller
{
    public function index()
    {
        return view('{$this->viewNamespace}::web.index');
    }
}
PHP;
    }

    protected function getAdminControllerBasicStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Controllers\Admin;

use App\Http\Controllers\Controller;

class {$this->className}Controller extends Controller
{
    public function index()
    {
        return view('{$this->viewNamespace}::admin.index');
    }
}
PHP;
    }

    protected function getAdminControllerFullStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Domains\\{$this->name}\Requests\Store{$this->className}Request;
use App\Domains\\{$this->name}\Requests\Update{$this->className}Request;
use App\Domains\\{$this->name}\UseCases\Get{$this->className}UseCase;
use App\Domains\\{$this->name}\UseCases\Register{$this->className}UseCase;
use App\Domains\\{$this->name}\UseCases\Update{$this->className}UseCase;

class {$this->className}Controller extends Controller
{
    public \$titlePage = '{$this->name}';
    public \$sectionPage = '{$this->name}';

    public function index(): View
    {
        \$titlePage = \$this->titlePage;
        return view('{$this->viewNamespace}::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        \$titlePage = 'إضافة ' . \$this->titlePage . ' جديد';
        \$sectionPage = \$this->sectionPage;
        return view('{$this->viewNamespace}::admin.create', compact('sectionPage', 'titlePage'));
    }

    public function store(
        Store{$this->className}Request \$request,
        Register{$this->className}UseCase \$useCase
    ) {
        \$useCase->execute(\$request->validated());

        return redirect()
            ->route('admin.{$this->kebabPlural}.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم الإضافة!',
                'text' => 'تمت إضافة البيانات بنجاح.',
            ]);
    }

    public function edit(
        int \$id,
        Get{$this->className}UseCase \$useCase
    ): View {
        \${$this->variable} = \$useCase->execute(\$id);
        \$titlePage = 'تعديل ' . \$this->titlePage;
        \$sectionPage = \$this->sectionPage;
        return view('{$this->viewNamespace}::admin.edit', compact('{$this->variable}', 'sectionPage', 'titlePage'));
    }

    public function update(
        Update{$this->className}Request \$request,
        int \$id,
        Update{$this->className}UseCase \$useCase
    ) {
        \$useCase->execute(\$id, \$request->validated());

        return redirect()
            ->route('admin.{$this->kebabPlural}.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم التعديل!',
                'text' => 'تم تعديل البيانات بنجاح.',
            ]);
    }
}
PHP;
    }

    protected function getMigrationStub(): string
    {
        return <<<PHP
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('{$this->tableName}', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('{$this->tableName}');
    }
};
PHP;
    }

    protected function getPolicyStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Policies;

use App\Models\User as AuthUser;
use App\Domains\\{$this->name}\Models\\{$this->className};

class {$this->className}Policy
{
    public function view(AuthUser \$user, {$this->className} \$model): bool
    {
        return true;
    }

    public function create(AuthUser \$user): bool
    {
        return true;
    }

    public function update(AuthUser \$user, {$this->className} \$model): bool
    {
        return true;
    }

    public function delete(AuthUser \$user, {$this->className} \$model): bool
    {
        return true;
    }
}
PHP;
    }

    protected function getRepositoryStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Repositories;

use App\Domains\\{$this->name}\Models\\{$this->className};

class {$this->className}Repository
{
    public function all()
    {
        return {$this->className}::all();
    }

    public function find(int \$id)
    {
        return {$this->className}::find(\$id);
    }

    public function create(array \$data)
    {
        return {$this->className}::create(\$data);
    }

    public function update(int \$id, array \$data)
    {
        \$model = {$this->className}::findOrFail(\$id);
        \$model->update(\$data);
        return \$model;
    }

    public function delete(int \$id)
    {
        return {$this->className}::destroy(\$id);
    }
}
PHP;
    }

    protected function getStoreRequestStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store{$this->className}Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
PHP;
    }

    protected function getUpdateRequestStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update{$this->className}Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
PHP;
    }

    protected function getCreateDtoStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\DTOs;

class Create{$this->className}Data
{
    public function __construct(
        public string \$name,
    ) {}

    public static function fromArray(array \$data): self
    {
        return new self(
            name: \$data['name'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => \$this->name,
        ];
    }
}
PHP;
    }

    protected function getUpdateDtoStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\DTOs;

class Update{$this->className}Data
{
    public function __construct(
        public string \$name,
    ) {}

    public static function fromArray(array \$data): self
    {
        return new self(
            name: \$data['name'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => \$this->name,
        ];
    }
}
PHP;
    }

    protected function getGetUseCaseStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\UseCases;

use App\Domains\\{$this->name}\Models\\{$this->className};
use App\Domains\\{$this->name}\Repositories\\{$this->className}Repository;

class Get{$this->className}UseCase
{
    public function __construct(
        protected {$this->className}Repository \$repository
    ) {}

    public function execute(int \$id): {$this->className}
    {
        return \$this->repository->find(\$id);
    }
}
PHP;
    }

    protected function getRegisterUseCaseStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\\{$this->name}\Models\\{$this->className};
use App\Domains\\{$this->name}\DTOs\Create{$this->className}Data;
use App\Domains\\{$this->name}\Repositories\\{$this->className}Repository;

class Register{$this->className}UseCase
{
    public function __construct(
        protected {$this->className}Repository \$repository
    ) {}

    public function execute(array \$data): {$this->className}
    {
        return DB::transaction(function () use (\$data) {
            \$dto = Create{$this->className}Data::fromArray(\$data);
            return \$this->repository->create(\$dto->toArray());
        });
    }
}
PHP;
    }

    protected function getUpdateUseCaseStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\\{$this->name}\Models\\{$this->className};
use App\Domains\\{$this->name}\DTOs\Update{$this->className}Data;
use App\Domains\\{$this->name}\Repositories\\{$this->className}Repository;

class Update{$this->className}UseCase
{
    public function __construct(
        protected {$this->className}Repository \$repository
    ) {}

    public function execute(int \$id, array \$data): {$this->className}
    {
        return DB::transaction(function () use (\$id, \$data) {
            \$dto = Update{$this->className}Data::fromArray(\$data);
            return \$this->repository->update(\$id, \$dto->toArray());
        });
    }
}
PHP;
    }

    protected function getLivewireStub(): string
    {
        return <<<PHP
<?php

namespace App\Domains\\{$this->name}\Livewire;

use App\Livewire\BaseTableComponent;

class {$this->name}Index extends BaseTableComponent
{
    protected string \$model = \App\Domains\\{$this->name}\Models\\{$this->className}::class;

    protected \$listeners = [
        'deleteItem' => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '\$refresh',
    ];

    public function render()
    {
        \${$this->variablePlural} = \$this->model::query()
            ->when(\$this->search, function (\$query) {
                \$query->where('name', 'like', "%{\$this->search}%");
            })
            ->paginate(10);

        return view('{$this->viewNamespace}::livewire.{$this->kebabPlural}-index', compact('{$this->variablePlural}'));
    }
}
PHP;
    }

    protected function getLivewireBladeStub(): string
    {
        $kebab = $this->kebabPlural;
        $vars = $this->variablePlural;
        $var = $this->variable;

        return <<<BLADE
<div>
    <div class="card">
        <div class="m-3 row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <input type="text"
                       class="form-control"
                       placeholder="بحث بالاسم..."
                       wire:model.live.500ms="search">
            </div>

            <div class="col-12 col-md-8 text-md-end text-left">
                @if(count(\$selected) > 0)
                    <button wire:click="confirmDeleteSelected" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف العناصر المحددة ({{ count(\$selected) }})
                    </button>
                @else
                    <a href="{{ route('admin.{$kebab}.create') }}" class="btn btn-primary mb-2 mb-md-0">
                        <i class="fas fa-plus"></i>
                        إضافة {$this->className} جديد
                    </a>
                @endif
            </div>
        </div>

        <div class="card-header pb-0">
            <h4 class="card-title">قائمة {$this->name}</h4>

            @if(count(\$selected) > 0)
                <div class="text-muted mt-1">
                    تم تحديد {{ count(\$selected) }} عنصر
                </div>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-md-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" wire:model.live="selectAll">
                            </th>
                            <th>#</th>
                            <th>الاسم</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse (\${$vars} as \${$var})
                            <tr class="@if(in_array(\${$var}->id, \$selected)) table-active @endif">
                                <td>
                                    <input type="checkbox"
                                           wire:model.live="selected"
                                           value="{{ \${$var}->id }}"
                                           class="form-check-input">
                                </td>

                                <td>
                                    {{ \$loop->iteration + (\${$vars}->currentPage() - 1) * \${$vars}->perPage() }}
                                </td>

                                <td>{{ \${$var}->name }}</td>

                                <td>
                                    <a href="{{ route('admin.{$kebab}.edit', \${$var}->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button wire:click="confirmDelete({{ \${$var}->id }})"
                                            class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                    <br>
                                    لا توجد بيانات حالياً
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ \${$vars}->links() }}
            </div>
        </div>
    </div>
</div>
BLADE;
    }

    protected function getAdminIndexBlade(): string
    {
        $kebab = $this->kebabPlural;
        return <<<BLADE
@extends('layouts.master',['titlePage'=>\$titlePage])

@section('content')
<x-page-header :titlePage="\$titlePage" />
<livewire:{$kebab}.{$kebab}-index />
@endsection
BLADE;
    }

    protected function getAdminCreateBlade(): string
    {
        $kebab = $this->kebabPlural;
        return <<<BLADE
@extends('layouts.master',['titlePage'=>\$titlePage])
<x-page-header :sectionPage="\$sectionPage" :titlePage="\$titlePage" />

@section('content')
<x-form
    :action="route('admin.{$kebab}.store')"
    submitLabel="إضافة {$this->className} جديد"
    cancelRoute="admin.{$kebab}.index"
>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ \$message }}</span> @enderror
        </div>
    </div>
</x-form>
@endsection
BLADE;
    }

    protected function getAdminEditBlade(): string
    {
        $kebab = $this->kebabPlural;
        $var = $this->variable;
        return <<<BLADE
@extends('layouts.master',['titlePage'=>\$titlePage])

<x-page-header :sectionPage="\$sectionPage" :titlePage="\$titlePage" />

@section('content')
<x-form
    :action="route('admin.{$kebab}.update', \${$var}->id)"
    submitLabel="تعديل {$this->className}"
    cancelRoute="admin.{$kebab}.index"
>
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', \${$var}->name) }}" required>
            @error('name') <span class="text-danger">{{ \$message }}</span> @enderror
        </div>
    </div>
</x-form>
@endsection
BLADE;
    }
}