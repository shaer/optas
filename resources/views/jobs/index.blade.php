@extends('layouts.dashboard')
@section('page_heading','Manage Jobs')
@section('section')


@if(Session::has('success'))
<div class="alert alert-success  alert-dismissable " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>  
    <strong>Success:</strong>
    Job has been saved successfully
</div>
@endif
    
    <div class='btn-group extraMargin'>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Job
        </button>
    </div>
    
    @if (count($data) > 0)
         <div class="panel panel-default">
            <div class="panel-heading">
                Available Jobs
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Job Name</th>
                        <th>Job Describtion</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($data as $job)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $job->name }}</div>
                                </td> 
                                <td class="table-text">
                                    <div>{{ $job->description }}</div>
                                </td>
                                <td class="col-md-2">
                                    {!! Form::open(['route' => ['jobs.destroy', $job->id], 'method' => 'delete', 'class' => 'showInline']) !!}
                                    <div class='btn-group'>
                                        <button type="button" class="btn btn-warning btn-xs editItem"  data-toggle="tooltip" title="Edit Record" data-items="job" data-element="{{ $job->id }}" data-path="{{ route('jobs.update', false) }}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </button>
                                        <button id="delete-item-{{ $job->id }}" data-toggle="tooltip" title="Delete Record" class="btn btn-danger btn-xs deleteItem">
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
            <h4 class="modal-title" id="myModalLabel">Add New Job</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'route' => ['jobs.store'], 
                    'class' => 'ajaxForm',
                    'data-parsley-validate' => ''
                ]) }}
                @include('jobs/_form')
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
            <h4 class="modal-title" id="myModalLabel">Edit Job</h4>
          </div>
          <div class="modal-body">
                {{ Form::model($model, [
                    'method' => 'PATCH',
                    'route' => ['jobs.update', 000],
                    'class' => 'ajaxForm'
                ]) }}
                @include('jobs/_form')
                {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

@include('jobs/_extraFields')

@endsection
