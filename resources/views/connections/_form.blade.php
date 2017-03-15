<div class="panel-body">
    <!-- New Connection Form -->
    <div class="form-group">
            {{ Form::label('name', 'Connection Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            <label for="connection-type">Connection Type</label>
            {{ Form::select('connection_type_id', $connection_types, null, ['class' => 'form-control', 'placeholder' => 'Select Type', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('host', 'Host') }}
            {{ Form::text('host', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('user', 'Username') }}
            {{ Form::text('user', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
            <div class="hidden editPassword">
                <input type="checkbox" class="editPassCb" name="checkpassword"> Edit Password
            </div>
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::button('<i class="glyphicon glyphicon-ok"></i> Save Connection', 
                    ['class' => 'btn btn-primary','type' => 'submit']) }}
            {{ Form::button('<i class="glyphicon glyphicon-exclamation-sign"></i> Test Connection', 
                    ['class' => 'btn btn-success']) }}
    </div>
</div> 
