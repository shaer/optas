@extends('layouts.dashboard')
@section('page_heading','Manage Connections')
@section('section')


@if(Session::has('success'))
<div class="alert alert-success  alert-dismissable " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>  
    <strong>Success:</strong>
    Connection has been added successfully
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger  alert-dismissable " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>  
    <strong>Errors:</strong>
    <ul>
        @foreach($model->errors()->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addConnectionModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Connection
    </button>
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

                                <td class="col-md-4">
                                    <button type="button" class="btn btn-success"> 
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Test Connection
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif;

    <div class="modal fade" id="addConnectionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Connection</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, ['route' => ['addConnection']]) }}
                @include('connections/_form')
                {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="editConnectionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Connection</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'method' => 'PATCH',
                    'route' => ['updateConnection', 000]
                ]) }}
                @include('connections/_form')
                {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

@endsection
