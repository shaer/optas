@extends('layouts.app')
@section('content')

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

                                <td>
                                    <!-- TODO: Delete Button -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif;


@endsection
