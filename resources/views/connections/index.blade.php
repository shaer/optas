@extends('layouts.dashboard')
@section('page_heading','Manage Connections')
@section('section')

    @if(Session::has('success'))
    <div class="alert alert-success  alert-dismissable " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>  
        <strong>Success:</strong> Connection has been saved successfully
    </div>
    @endif
    @if(Auth::user()->hasRole('add_connections'))
    <div class='btn-group extraMargin'>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Connection
        </button>
    </div>
    @endif
    
    @if (count($connections) > 0)
         <div class="panel panel-default">
            <div class="panel-heading">
                Available Connections
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Connection Name</th>
                        <th>Type</th>
                        <th>Host</th>
                        <th>Username</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($connections as $connection)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $connection->name }}</div>
                                </td> 
                                <td class="table-text">
                                    <div>{{ $connection->connectionType->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $connection->host }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $connection->user }}</div>
                                </td>
                                <td class="col-md-2">
                                    <div class='btn-group'>
                                        <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" title="Test DB Connection"> 
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        </button>
                                        @if($can['edit'])
                                        <button type="button" class="btn btn-warning btn-xs editItem"  data-toggle="tooltip" title="Edit Record" data-items="name,connection_type_id,host,user" data-element="{{ $connection->id }}" data-path="{{ route('connections.update', false) }}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        @endif
                                        @if($can['delete'])
                                        {!! Form::open(['route' => ['connections.destroy', $connection->id], 'method' => 'delete', 'class' => 'btn-group']) !!}
                                        <button id="delete-connection-{{ $connection->id }}" data-toggle="tooltip" title="Delete Record" class="btn btn-danger btn-xs deleteItem">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        {!! Form::close() !!}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif;

    <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Connection</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'route' => ['connections.store'], 
                    'class' => 'ajaxForm',
                    'data-parsley-validate' => ''
                ]) }}
                @include('connections/_form')
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
            <h4 class="modal-title" id="myModalLabel">Edit Connection</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'method' => 'PATCH',
                    'route' => ['connections.update', 000],
                    'class' => 'ajaxForm'
                ]) }}
                @include('connections/_form')
                {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

@endsection
