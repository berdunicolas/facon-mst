<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeApiResourceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example: php artisan make:api-resource User
     */
    protected $signature = 'make:api-resource {name}';

    /**
     * The console command description.
     */
    protected $description = 'Crea un set de archivos ApiResource (Controller, Requests, Resource, Model)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = Str::studly($this->argument('name'));

        $basePath = app_path("Http/Api/{$name}");

        $paths = [
            'Controller' => "{$basePath}/Controller/{$name}ApiController.php",
            'QueryRequest' => "{$basePath}/Requests/{$name}QueryRequest.php",
            'StoreRequest' => "{$basePath}/Requests/{$name}StoreRequest.php",
            'UpdateRequest' => "{$basePath}/Requests/{$name}UpdateRequest.php",
            'Resource' => "{$basePath}/Resources/{$name}Resource.php",
            'Model' => app_path("Models") . "/{$name}.php",
        ];

        foreach ($paths as $type => $path) {
            $this->makeDirectory($path);

            if (!File::exists($path)) {
                File::put($path, $this->getStub($type, $name));
                $this->info("{$type} creado: {$path}");
            } else {
                $this->warn("{$type} ya existe: {$path}");
            }
        }

        return Command::SUCCESS;
    }

    protected function makeDirectory($path)
    {
        if (!File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }
    }

    protected function getStub($type, $name)
    {
        $lowerName = strtolower($name);

        switch ($type) {
            case 'Controller':
                return <<<PHP
<?php

namespace App\Http\Api\\{$name}\\Controller; 

use Illuminate\Http\JsonResponse;

use App\Models\\{$name};

use App\Http\Api\ApiController;
use App\Http\Api\\{$name}\\Requests\\{$name}QueryRequest;
use App\Http\Api\\{$name}\\Requests\\{$name}StoreRequest;
use App\Http\Api\\{$name}\\Requests\\{$name}UpdateRequest;
use App\Http\Api\\{$name}\\Resources\\{$name}Resource;

class {$name}ApiController extends ApiController
{
    private string \$resource;
    private string \$successfullStoreTask;
    private string \$successfullUpdateTask;
    private string \$failedStoreTask;
    private string \$failedUpdateTask;
    private string \$failedDeleteTask;

    public function __construct()
    {
        \$this->resource = UserResource::class;
        \$this->successfullStoreTask = __('');
        \$this->successfullUpdateTask = __('');
        \$this->failedStoreTask = __('');
        \$this->failedUpdateTask = __('');
        \$this->failedDeleteTask = __('');
    }

    public function index({$name}QueryRequest \$request): JsonResponse 
    {
        \$validatedData = \$request->validated();
        return \$this->listTask(function () {});
    }

    public function show({$name} \${$lowerName}): JsonResponse
    {
        return \$this->getTask(function () {});
    }

    public function store({$name}StoreRequest \$request): JsonResponse
    {
        \$validatedData = \$request->validated();

        return \$this->storeTask(function () {});
    }

    public function update({$name} \${$lowerName}, {$name}UpdateRequest \$request): JsonResponse
    {
        \$validatedData = \$request->validated();

        return \$this->updateTask(function () {});
    }

    public function destroy({$name} \${$lowerName}): JsonResponse
    {
        return \$this->deleteTask(function () {});
    }
}

PHP;
            case 'QueryRequest':
                return <<<PHP
<?php

namespace App\Http\Api\\{$name}\\Requests;

use App\Http\Api\ApiRequest;

class {$name}QueryRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            // reglas de validación para crear
        ];
    }
}
                
PHP;
            case 'StoreRequest':
                return <<<PHP
<?php

namespace App\Http\Api\\{$name}\\Requests;

use App\Http\Api\ApiRequest;

class {$name}StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            // reglas de validación para crear
        ];
    }
}

PHP;

            case 'UpdateRequest':
                return <<<PHP
<?php

namespace App\Http\Api\\{$name}\\Requests;

use App\Http\Api\ApiRequest;

class {$name}UpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return false;
    }
        
    public function rules(): array
    {
        return [
            // reglas de validación para crear
        ];
    }
}

PHP;

            case 'Resource':
                return <<<PHP
<?php

namespace App\Http\Api\\{$name}\\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class {$name}Resource extends JsonResource
{
    public function toArray(Request \$request): array
    {
        return [
            'id' => \$this->id,
            // otros campos
        ];
    }
}

PHP;

            default:
                return '';
        }
    }
}
