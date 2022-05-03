<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\Rule;

final class UsersTable extends PowerGridComponent
{
    use ActionButton;

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'refreshTable' => 'refreshTable',
                'deleteRow' => 'deleteRow'
            ]
        );
    }

    public function refreshTable()
    {
        $this->emit('$refresh');
    }

    public function deleteRow($id)
    {
        User::destroy($id);
        $this->emit('$refresh');
    }
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): void
    {
        $this->showCheckBox()
            ->showPerPage()
            ->showSearchInput()
            ->showExportOption('download', ['excel', 'csv']);
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Builder
    {
        return User::query()
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.role_name as role');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('username')
            ->addColumn('email')
            ->addColumn('role')
            ->addColumn('created_at_formatted', function (User $model) {
                return Carbon::parse($model->created_at)->format('d/m/y');
            })
            ->addColumn('updated_at_formatted', function (User $model) {
                return Carbon::parse($model->updated_at)->format('d/m/y');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->makeInputRange(),

            Column::add()
                ->title('NAME')
                ->field('name')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->editOnClick(),

            Column::add()
                ->title('USERNAME')
                ->field('username')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->editOnClick(),

            Column::add()
                ->title('EMAIL')
                ->field('email')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->editOnClick(),

            Column::add()
                ->title('ROLE')
                ->field('role'),

            Column::add()
                ->title('CREATED AT')
                ->field('created_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('users.created_at'),

            Column::add()
                ->title('UPDATED AT')
                ->field('updated_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('users.updated_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */


    public function actions(): array
    {
        return [
            Button::add('edit')
                ->caption('Edit role')
                ->class('cursor-pointer bg-indigo text-white px-2 py-2 m-0 rounded text-sm')
                ->openModal('admin.user-edit', ['user' => 'id']),

            Button::add('destroy')
                ->caption('Delete')
                ->class('cursor-pointer bg-red text-white px-2 py-2 m-0 rounded text-sm')
                ->emit('deleteRow', ['id' => 'id'])
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\Rule>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($user) => $user->id === 1)
                ->hide(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

    /**
     * PowerGrid User Update.
     *
     * @param array<string,string> $data
     */


    public function update(array $data): bool
    {
        try {
            $updated = User::query()->findOrFail($data['id'])
                ->update([
                    $data['field'] => $data['value'],
                ]);
        } catch (QueryException $exception) {
            $updated = false;
        }
        return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
}
