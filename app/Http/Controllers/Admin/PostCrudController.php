<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PostRequest as StoreRequest;
use App\Http\Requests\PostRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Post');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/post');
        $this->crud->setEntityNameStrings('post', 'posts');
        $this->crud->addColumn([
            'name' => "name",
            'label' => "Tiêu đề bài viết", // Table column heading
            'type' => "model_function",
            'function_name' => 'getSlugWithLink', // the method in your Model
            // 'limit' => 100, // Limit the number of characters shown
        ]);
        $this->crud->addColumn([
            'name' => 'content',
            'label' => 'Nội dung bài viết',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'label' => "Tên môn học", // Table column heading
            'type' => "select",
            'name' => 'subject_id', // the column that contains the ID of that connected entity;
            'entity' => 'subject', // the method that defines the relationship in your Model
            'attribute' => "name_subject", // foreign key attribute that is shown to user
            'model' => "App\Models\Subject",
        ]);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Tiêu đề',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => 'Nội dung bài viết',
            'type' => 'ckeditor',
        ]);
        $this->crud->addField([
            'label' => "Tên môn học", // Table column heading
            'type' => "select",
            'name' => 'subject_id', // the column that contains the ID of that connected entity;
            'entity' => 'subject', // the method that defines the relationship in your Model
            'attribute' => "name_subject", // foreign key attribute that is shown to user
            'model' => "App\Models\Subject",
        ]);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();

        // add asterisk for fields that are required in PostRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
