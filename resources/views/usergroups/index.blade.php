@extends('layouts.dashboard')
@section('page_heading','Manage User Groups')
@section('section')


@if(Session::has('success'))
<div class="alert alert-success  alert-dismissable " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>  
    <strong>Success:</strong>
    User Group has been saved successfully
</div>
@endif
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewItemModel">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Group
    </button>
    @if (count($data) > 0)
         <div class="panel panel-default">
            <div class="panel-heading">
                Available Groups
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Group Name</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($data as $group)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $group->name }}</div>
                                </td>

                                <td class="col-md-4">
                                    <a href="usergroups/roles/{{ $group->id }}" class="btn btn-success"> 
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Manage Roles
                                    </a>
                                    <button type="button" class="btn btn-primary editItem" data-items="name,description" data-element="{{ $group->id }}" data-path="/configurations/users/usergroups">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
                                    </button>
                                    {{ Form::model($model, [
                                        'method' => 'DELETE',
                                        'route' => ['usergroups.destroy', $group->id],
                                        'class' => 'showInline'
                                    ]) }}
                                    <button id="delete-usergroup-{{ $group->id }}" class="btn btn-danger deleteItem">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                                        </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    
    <div class="modal fade" id="addNewItemModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New User Group</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'route' => ['usergroups.store'], 
                    'class' => 'ajaxForm',
                    'data-parsley-validate' => ''
                ]) }}
                @include('usergroups/_form')
                {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="editElementModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit User Group</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'method' => 'PATCH',
                    'route' => ['usergroups.update', 000],
                    'class' => 'ajaxForm'
                ]) }}
                @include('usergroups/_form')
                {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

    
@endsection
