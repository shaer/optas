@extends('layouts.dashboard')
@section('page_heading','Manage Roles')
@section('section')


@if(Session::has('success'))
<div class="alert alert-success  alert-dismissable " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>  
    <strong>Success:</strong>
    Roles have been applied successfully.
</div>
@endif

    @if (count($groups) > 0)
         <div class="panel panel-default">
            <div class="panel-heading">
                Available Roles
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => ['updateGroupRoles', $group_id]]) !!}
                <table class="table table-striped task-table">
                    <thead>
                        <th>Role</th>
                        @foreach ($groups as $group)
                        <th>{{ $group->name }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $role->name }}</div>
                                </td>
                                @foreach ($groups as $group)
                                <td>{{ Form::checkbox('roles[' . $group->id . '][]',
                                    $role->id, $group->hasRole($role->id)) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(Auth::user()->hasRole('add_usergroups'))
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Update Roles
                </button>
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    @endif
@endsection
