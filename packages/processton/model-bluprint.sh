#!/bin/bash

# Check if parameter is passed
if [ -z "$1" ]; then
  echo "Usage: $0 <module-name>"
  exit 1
fi

# Ensure MODULE_NAME is always lowercase
MODULE_NAME=$(echo "$1" | tr '[:upper:]' '[:lower:]')
CAMEL_CASE_NAME="$(tr '[:lower:]' '[:upper:]' <<< ${MODULE_NAME:0:1})${MODULE_NAME:1}"

# Define columns for models
declare -A MODEL_COLUMNS
MODEL_COLUMNS[company]='id:increments name:string domain:string:nullable phone:string:nullable website:string:nullable industry:string:nullable annual_revenue:decimal:15,2:nullable number_of_employees:integer:nullable lead_source:string:nullable description:text:nullable creator_id:foreignId:nullable address_id:foreignId:nullable created_at:timestamp updated_at:timestamp'
MODEL_COLUMNS[contact]='id:increments prefix:string:nullable first_name:string last_name:string email:string:unique:nullable phone:string:nullable linkedin_profile:string:nullable twitter_handle:string:nullable notes:text:nullable created_at:timestamp updated_at:timestamp'
MODEL_COLUMNS[items]='id:increments entity_type:string:nullable entity_id:foreignId:nullable created_at:timestamp updated_at:timestamp'
MODEL_COLUMNS[org]='id:increments title:string description:text org_key:string org_value:text timestamp'



# Validate that the provided MODULE_NAME exists in MODEL_COLUMNS
if [[ -z "${MODEL_COLUMNS[$MODULE_NAME]}" ]]; then
  echo "Error: The provided module name '$MODULE_NAME' does not exist in the MODEL_COLUMNS array."
  exit 1
fi

# Update pluralization logic to follow grammatical rules
if [[ "$MODULE_NAME" =~ y$ ]]; then
  PLURAL_MODULE_NAME="${MODULE_NAME%y}ies"
elif [[ "$MODULE_NAME" =~ s$ || "$MODULE_NAME" =~ sh$ || "$MODULE_NAME" =~ ch$ || "$MODULE_NAME" =~ x$ || "$MODULE_NAME" =~ z$ ]]; then
  PLURAL_MODULE_NAME="${MODULE_NAME}es"
else
  PLURAL_MODULE_NAME="${MODULE_NAME}s"
fi

CAMEL_CASE_PLURAL_NAME="$(tr '[:lower:]' '[:upper:]' <<< ${PLURAL_MODULE_NAME:0:1})${PLURAL_MODULE_NAME:1}"
TIMESTAMP=$(date +"%Y_%m_%d_%H%M%S")

# Create nested directories individually to avoid syntax issues
mkdir -p $MODULE_NAME/database/factories
mkdir -p $MODULE_NAME/database/migrations
mkdir -p $MODULE_NAME/database/seeders
mkdir -p $MODULE_NAME/resources/views
mkdir -p $MODULE_NAME/routes
mkdir -p $MODULE_NAME/src/Filament/Pages
mkdir -p $MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Actions
mkdir -p $MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Components
mkdir -p $MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Forms
mkdir -p $MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/InfoList
mkdir -p $MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Mutators
mkdir -p $MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Pages
mkdir -p $MODULE_NAME/src/Models

# Helper function to create PHP class files
create_php_class() {
  FILE_PATH=$1
  NAMESPACE=$2
  CLASS_NAME=$3
  mkdir -p "$(dirname "$FILE_PATH")"
  CONTENT="<?php\n\nnamespace $NAMESPACE;\n\nclass $CLASS_NAME\n{\n    //\n}\n"
  echo -e "$CONTENT" > "$FILE_PATH"
}

# Composer file
cat <<EOL > $MODULE_NAME/composer.json
{
    "name": "processton/$MODULE_NAME",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "codeat3/blade-carbon-icons": "^2.34"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23"
    },
    "autoload": {
        "psr-4": {
            "Processton\\\\$CAMEL_CASE_NAME\\\\": "src/",
            "Processton\\\\${CAMEL_CASE_NAME}Database\\\\Factories\\\\": "database/factories/",
            "Processton\\\\${CAMEL_CASE_NAME}Database\\\\Seeders\\\\": "database/seeders/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "Processton\\\\$CAMEL_CASE_NAME\\\\${CAMEL_CASE_NAME}ServiceProvider"
            ]
        }
    }
}
EOL

# .gitignore file
cat <<EOL > $MODULE_NAME/.gitignore
/.phpunit.cache
/node_modules
/public/build
/public/hot
/public/storage
/storage/*.key
/storage/pail
/vendor
.env
.env.backup
.env.production
.phpactor.json
.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
/auth.json
/.fleet
/.idea
/.nova
/.vscode
/.zed
EOL

# Database
FACTORY_PATH="$MODULE_NAME/database/factories/${CAMEL_CASE_NAME}Factory.php"
FACTORY_NAMESPACE="Processton\\${CAMEL_CASE_NAME}Database\\Factories"
FACTORY_CLASS="${CAMEL_CASE_NAME}Factory"

cat <<EOL > "$FACTORY_PATH"
<?php

namespace $FACTORY_NAMESPACE;

use Illuminate\Database\Eloquent\Factories\Factory;

class $FACTORY_CLASS extends Factory
{
    public function definition(): array
    {
        return [
$(for col in ${MODEL_COLUMNS[$MODULE_NAME]}; do IFS=':' read -r name type <<< "$col"; if [[ "$name" != "id" && "$name" != "created_at" && "$name" != "updated_at" ]]; then echo "            '$name' => \$this->faker->word(),"; fi; done)
        ];
    }
}
EOL

MIGRATION_FILE="$MODULE_NAME/database/migrations/${TIMESTAMP}_create_${PLURAL_MODULE_NAME}_table.php"

# Create migration with defined columns
cat <<EOL > "$MIGRATION_FILE"
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('${PLURAL_MODULE_NAME}', function (Blueprint \$table) {
EOL

for col in ${MODEL_COLUMNS[$MODULE_NAME]}; do
  IFS=':' read -r name type <<< "$col"
  echo "            \$table->$type('$name');" >> "$MIGRATION_FILE"
done

cat <<EOL >> "$MIGRATION_FILE"
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('${PLURAL_MODULE_NAME}');
    }
};
EOL

# Seeder with model factory call
SEEDER_PATH="$MODULE_NAME/database/seeders/${CAMEL_CASE_PLURAL_NAME}Seeder.php"
cat <<EOL > "$SEEDER_PATH"
<?php

namespace Processton\\${CAMEL_CASE_NAME}Database\\Seeders;

use Illuminate\Database\Seeder;
use Processton\\$CAMEL_CASE_NAME\\Models\\$CAMEL_CASE_NAME;

class ${CAMEL_CASE_PLURAL_NAME}Seeder extends Seeder
{
    public function run(): void
    {
        $CAMEL_CASE_NAME::factory()->count(10)->create();
    }
}
EOL

# Views
> $MODULE_NAME/resources/views/view-${MODULE_NAME}-profile.blade.php
> $MODULE_NAME/resources/views/welcome.blade.php

# Routes
> $MODULE_NAME/routes/api.php
> $MODULE_NAME/routes/web.php

# Filament Pages and Resources
cat <<EOL > "$MODULE_NAME/src/Filament/Pages/Dashboard.php"
<?php

namespace Processton\\$CAMEL_CASE_NAME\\Filament\\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string \$navigationLabel = '$CAMEL_CASE_NAME Dashboard';
    protected static ?string \$title = '$CAMEL_CASE_NAME Dashboard';
    protected static string \$view = '$MODULE_NAME::dashboard';
}
EOL

# Filament Resource Main Class
RESOURCE_PATH="$MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource.php"
RESOURCE_NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Filament\\Resources"
RESOURCE_MODEL="Processton\\$CAMEL_CASE_NAME\\Models\\$CAMEL_CASE_NAME"
RESOURCE_CLASS="${CAMEL_CASE_NAME}Resource"

# Generate Filament Resource
cat <<EOL > "$RESOURCE_PATH"
<?php

namespace $RESOURCE_NAMESPACE;

use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Infolists\Infolist;
use $RESOURCE_MODEL;
use $RESOURCE_NAMESPACE\\$RESOURCE_CLASS\\Forms\\${CAMEL_CASE_NAME}Form;
use $RESOURCE_NAMESPACE\\$RESOURCE_CLASS\\InfoList\\${CAMEL_CASE_NAME}InfoList;
use $RESOURCE_NAMESPACE\\$RESOURCE_CLASS\\Mutators\\BeforeCreate;
use $RESOURCE_NAMESPACE\\$RESOURCE_CLASS\\Mutators\\BeforeEdit;
use $RESOURCE_NAMESPACE\\$RESOURCE_CLASS\\Actions\\Create${CAMEL_CASE_NAME};
use $RESOURCE_NAMESPACE\\$RESOURCE_CLASS\\Actions\\Edit${CAMEL_CASE_NAME};
use $RESOURCE_NAMESPACE\\$RESOURCE_CLASS\\Actions\\View${CAMEL_CASE_NAME};

class $RESOURCE_CLASS extends Resource
{
    protected static ?string \$model = ${CAMEL_CASE_NAME}::class;

    public static function form(Form \$form): Form
    {
        return \$form
            ->schema(${CAMEL_CASE_NAME}Form::make());
    }

    public static function infolist(Infolist \$infolist): Infolist
    {
        return \$infolist->schema(${CAMEL_CASE_NAME}InfoList::make());
    }

    public static function table(Table \$table): Table
    {
        return \$table
            ->columns([
$(for col in ${MODEL_COLUMNS[$MODULE_NAME]}; do IFS=':' read -r name type <<< "$col"; if [[ "$name" != "id" && "$name" != "created_at" && "$name" != "updated_at" ]]; then echo "                Tables\\Columns\\TextColumn::make('$name')->label('$name'),"; fi; done)
            ])
            ->actions([
                Edit${CAMEL_CASE_NAME}::make(),
                View${CAMEL_CASE_NAME}::make(),
            ])
            ->bulkActions([
                Tables\\Actions\\DeleteBulkAction::make(),
            ]);
    }
}
EOL

# Generate Actions, Components, Forms, InfoList, Mutators, and Pages
for PART in Actions/{Create,Edit,View}${CAMEL_CASE_NAME} Components/${CAMEL_CASE_NAME}Component InfoList/${CAMEL_CASE_NAME}InfoList Mutators/{BeforeCreate,BeforeEdit} Pages/{List,Create,Edit,View}${CAMEL_CASE_NAME}; do
  CLASS_NAME=$(basename "$PART")
  DIR_NAME=$(dirname "$PART")
  FILE_PATH="$MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/$DIR_NAME/$CLASS_NAME.php"
  NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource\\${DIR_NAME//\//\\}"
  create_php_class "$FILE_PATH" "$NAMESPACE" "$CLASS_NAME"
done

# Add logic to create Actions dynamically based on the attached examples
for ACTION in Create Edit View; do
    ACTION_CLASS="${ACTION}${CAMEL_CASE_NAME}"
    ACTION_PATH="$MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Actions/${ACTION_CLASS}.php"
    ACTION_NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource\\Actions"

    cat <<EOL > "$ACTION_PATH"
<?php

namespace $ACTION_NAMESPACE;

use Filament\Forms\Form;
use Filament\Tables\Actions\\${ACTION}Action;
use Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource;
use Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource\\Mutators\\Before${ACTION};
use Processton\\$CAMEL_CASE_NAME\\Models\\$CAMEL_CASE_NAME;

class $ACTION_CLASS
{
    public static function make(): ${ACTION}Action
    {
        return ${ACTION}Action::make()
            ->modalHeading(fn($CAMEL_CASE_NAME \$record): string => __("${ACTION} ".('$ACTION' === 'Create' ? 'New ' : 'Edit').('$ACTION' === 'Create' ? "$MODULE_NAME" : \$record->name)))
            ->mutateFormDataUsing(fn(array \$data) => Before${ACTION}::mutate(\$data))
            ->modalWidth('7xl')
            ->form(fn(Form \$form) => ${CAMEL_CASE_NAME}Resource::form(\$form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
EOL
done

# Update Resource\Forms creation logic to use columns array dynamically
RESOURCE_FORMS_PATH="$MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Forms/${CAMEL_CASE_NAME}Form.php"
RESOURCE_FORMS_NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource\\Forms"
RESOURCE_FORMS_CLASS="${CAMEL_CASE_NAME}Form"

cat <<EOL > "$RESOURCE_FORMS_PATH"
<?php

namespace $RESOURCE_FORMS_NAMESPACE;

use Filament\Forms;

class $RESOURCE_FORMS_CLASS
{
    public static function make(): array {
        return [
$(for col in ${MODEL_COLUMNS[$MODULE_NAME]}; do IFS=':' read -r name type <<< "$col"; if [[ "$name" != "id" && "$name" != "created_at" && "$name" != "updated_at" ]]; then echo "            Forms\\Components\\TextInput::make('$name')->label('$name')->required(),"; fi; done)
        ];
    }
}
EOL

# Generate InfoList class dynamically based on the attached example
INFO_LIST_PATH="$MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/InfoList/${CAMEL_CASE_NAME}InfoList.php"
INFO_LIST_NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource\\InfoList"
INFO_LIST_CLASS="${CAMEL_CASE_NAME}InfoList"

cat <<EOL > "$INFO_LIST_PATH"
<?php

namespace $INFO_LIST_NAMESPACE;

use Filament\Infolists\Components;

class $INFO_LIST_CLASS
{
    public static function make(): array
    {
        return [
            Components\Section::make('General Info')
                ->schema([
$(for col in ${MODEL_COLUMNS[$MODULE_NAME]}; do IFS=':' read -r name type <<< "$col"; if [[ "$name" != "id" && "$name" != "created_at" && "$name" != "updated_at" ]]; then echo "                    Components\\TextEntry::make('$name')->label('$name'),"; fi; done)
                ]),
        ];
    }
}
EOL

# Generate Mutators dynamically based on the attached example
for MUTATOR in BeforeCreate BeforeEdit; do
    MUTATOR_CLASS="$MUTATOR"
    MUTATOR_PATH="$MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Mutators/${MUTATOR_CLASS}.php"
    MUTATOR_NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource\\Mutators"

    cat <<EOL > "$MUTATOR_PATH"
<?php

namespace $MUTATOR_NAMESPACE;

class $MUTATOR_CLASS {

    public static function mutate(array \$data): array
    {
        \$data['creator_id'] = auth()->id();

        return \$data;
    }
}
EOL
done

# Generate Pages dynamically based on the attached examples
for PAGE in List Create Edit View; do

    # Ensure consistent pluralization for page names
    if [[ "$PAGE" == "List" ]]; then
        PAGE_CLASS="${PAGE}${CAMEL_CASE_PLURAL_NAME}"
    else
        PAGE_CLASS="${PAGE}${CAMEL_CASE_NAME}"
    fi

    PAGE_PATH="$MODULE_NAME/src/Filament/Resources/${CAMEL_CASE_NAME}Resource/Pages/${PAGE_CLASS}.php"
    PAGE_NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource\\Pages"

    if [ "$PAGE" == "List" ]; then
        cat <<EOL > "$PAGE_PATH"
<?php

namespace $PAGE_NAMESPACE;

use Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource;
use Filament\\Actions;
use Filament\\Resources\\Pages\\ListRecords;

class $PAGE_CLASS extends ListRecords
{
    protected static string \$resource = ${CAMEL_CASE_NAME}Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\\CreateAction::make(),
        ];
    }
}
EOL
    elif [ "$PAGE" == "Edit" ]; then
        cat <<EOL > "$PAGE_PATH"
<?php

namespace $PAGE_NAMESPACE;

use Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource;
use Filament\\Actions;
use Filament\\Resources\\Pages\\EditRecord;

class $PAGE_CLASS extends EditRecord
{
    protected static string \$resource = ${CAMEL_CASE_NAME}Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\\DeleteAction::make(),
        ];
    }
}
EOL
    elif [ "$PAGE" == "Create" ]; then
        cat <<EOL > "$PAGE_PATH"
<?php

namespace $PAGE_NAMESPACE;

use Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource;
use Filament\\Resources\\Pages\\CreateRecord;

class $PAGE_CLASS extends CreateRecord
{
    protected static string \$resource = ${CAMEL_CASE_NAME}Resource::class;
}
EOL
    elif [ "$PAGE" == "View" ]; then
        cat <<EOL > "$PAGE_PATH"
<?php

namespace $PAGE_NAMESPACE;

use Processton\\$CAMEL_CASE_NAME\\Filament\\Resources\\${CAMEL_CASE_NAME}Resource;
use Filament\\Resources\\Pages\\ViewRecord;

class $PAGE_CLASS extends ViewRecord
{
    protected static string \\$resource = ${CAMEL_CASE_NAME}Resource::class;
}
EOL
    fi

done

# Model
cat <<EOL > "$MODULE_NAME/src/Models/${CAMEL_CASE_NAME}.php"
<?php

namespace Processton\\$CAMEL_CASE_NAME\\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class $CAMEL_CASE_NAME extends Model
{
    use HasFactory;

    protected \$fillable = [
$(for col in ${MODEL_COLUMNS[$MODULE_NAME]}; do IFS=':' read -r name type <<< "$col"; if [[ "$name" != "id" && "$name" != "created_at" && "$name" != "updated_at" ]]; then echo "        '$name',"; fi; done)
    ];

}
EOL

# Plugin and ServiceProvider
PLUGIN_PATH="$MODULE_NAME/src/${CAMEL_CASE_NAME}Plugin.php"
PLUGIN_NAMESPACE="Processton\\$CAMEL_CASE_NAME"
PLUGIN_CLASS="${CAMEL_CASE_NAME}Plugin"

cat <<EOL > "$PLUGIN_PATH"
<?php

declare(strict_types=1);

namespace $PLUGIN_NAMESPACE;

use Filament\Pages;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use $PLUGIN_NAMESPACE\Filament\Resources\\${CAMEL_CASE_NAME}Resource;

class $PLUGIN_CLASS implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return '$MODULE_NAME';
    }

    public function register(Panel \$panel): void
    {
        \$panel->resources([
            ${CAMEL_CASE_NAME}Resource::class
        ]);

        \$panel->pages([
            Pages\Dashboard::class,
        ]);
    }

    public function boot(Panel \$panel): void
    {
        //
    }

    public static function get(): static
    {
        /** @var static \$plugin */
        \$plugin = filament(app(static::class)->getId());

        return \$plugin;
    }
}
EOL

SERVICE_PROVIDER_PATH="$MODULE_NAME/src/${CAMEL_CASE_NAME}ServiceProvider.php"
SERVICE_PROVIDER_NAMESPACE="Processton\\$CAMEL_CASE_NAME"
SERVICE_PROVIDER_CLASS="${CAMEL_CASE_NAME}ServiceProvider"

cat <<EOL > "$SERVICE_PROVIDER_PATH"
<?php

namespace $SERVICE_PROVIDER_NAMESPACE;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class $SERVICE_PROVIDER_CLASS extends ServiceProvider
{

    public function boot()
    {
        \$this->loadViewsFrom(__DIR__ . '/../resources/views', 'processton-$MODULE_NAME');

        if (\$this->app->runningInConsole()) {
            // Export the migration
            \$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        }

        \$this->registerWebRoutes();
        \$this->registerApiRoutes();

    }

    protected function registerWebRoutes()
    {
        Route::group(\$this->webRouteConfiguration(), function () {
            \$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function webRouteConfiguration()
    {
        return [
            'middleware' => config('panels.locale.middleware.web'),
        ];
    }

    protected function registerApiRoutes()
    {
        Route::group(\$this->apiRouteConfiguration(), function () {
            \$this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    protected function apiRouteConfiguration()
    {
        return [
            'middleware' => config('panels.locale.middleware.api'),
        ];
    }
}
EOL

# Ensure the directory exists before creating the controller file
mkdir -p "$MODULE_NAME/src/Controllers"

# Add Controller creation logic
CONTROLLER_PATH="$MODULE_NAME/src/Controllers/Controller.php"
CONTROLLER_NAMESPACE="Processton\\$CAMEL_CASE_NAME\\Controllers"
CONTROLLER_CLASS="Controller"

cat <<EOL > "$CONTROLLER_PATH"
<?php

namespace $CONTROLLER_NAMESPACE;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class $CONTROLLER_CLASS extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
EOL

echo "$MODULE_NAME module scaffolded!"
