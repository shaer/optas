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

    <div class='btn-group extraMargin'>
        @if(Auth::user()->hasRole('add_usergroups'))
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewItemModel">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Group
        </button>
        @endif
        @if($can['view_roles'])
        <a href="{{route('showRoles', false)}}" class="btn btn-success">
            <span class="glyphicon glyphicon-knight" aria-hidden="true"></span> Manage Roles
        </a>
        @endif
    </div>
    
    @if (count($data) > 0)
         <div class="panel panel-default">
            <div class="panel-heading">
                Available Groups
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Group Name</th>
                        <th>Description</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $group)
                            <tr @if ($group->group_type == 0) class="danger" @endif>
                                <td class="table-text">
                                    <div>{{ $group->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $group->description }}</div>
                                </td>
                                <td class="col-md-2">
                                    @if($can['edit'] || $can['delete'] || $can['view_roles'])
                                    <div class='btn-group'>
                                        @if($can['view_roles'])
                                        <a href="usergroups/roles/{{ $group->id }}" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" title="Manage Roles"> 
                                            <span class="glyphicon glyphicon-knight" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @if ($group->group_type != 0)
                                            @if($can['edit'])
                                            <button type="button" class="btn btn-warning btn-xs editItem"  data-toggle="tooltip" title="Edit Record" data-items="name,description" data-element="{{ $group->id }}" data-path="{{ route('usergroups.update', false) }}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </button>
                                            @endif
                                            @if($can['delete'])
                                            {!! Form::open(['route' => ['usergroups.destroy', $group->id], 'method' => 'delete', 'class' => 'btn-group']) !!}
                                            <button id="delete-item-{{ $group->id }}" data-toggle="tooltip" title="Delete Record" class="btn btn-danger btn-xs deleteItem">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </button>
                                            {!! Form::close() !!}
                                            @endif
                                        @endif
                                    </div>
                                    @endif
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
