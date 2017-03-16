@extends('layouts.dashboard')
@section('page_heading','Manage Users')
@section('section')


@if(Session::has('success'))
<div class="alert alert-success  alert-dismissable " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>  
    <strong>Success:</strong>
    User has been saved successfully
</div>
@endif
    
    <div class='btn-group extraMargin'>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New User
        </button>
    </div>
    
    @if (count($users) > 0)
         <div class="panel panel-default">
            <div class="panel-heading">
                Available Users
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Usergroup</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $user->name }}</div>
                                </td> 
                                <td class="table-text">
                                    <div>{{ $user->email }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $user->userGroup->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $user->getStatus() }}</div>
                                </td>
                                <td class="col-md-2">
                                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete', 'class' => 'showInline']) !!}
                                    <div class='btn-group'>
                                        <button type="button" class="btn btn-warning btn-xs editItem"  data-toggle="tooltip" title="Edit Record" data-items="name,email,user_group_id,status" data-element="{{ $user->id }}" data-path="{{ route('users.update', false) }}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        <button id="delete-item-{{ $user->id }}" data-toggle="tooltip" title="Delete Record" class="btn btn-danger btn-xs deleteItem">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New User</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'route' => ['users.store'], 
                    'class' => 'ajaxForm',
                    'data-parsley-validate' => ''
                ]) }}
                @include('users/_form')
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
            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'method' => 'PATCH',
                    'route' => ['users.update', 000],
                    'class' => 'ajaxForm'
                ]) }}
                @include('users/_form')
                {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

@endsection
