<div class="panel-body">
    
    <div class="bs-callout bs-callout-warning hidden">
      <h4>Oh snap!</h4>
      <p>This form seems to be invalid :(</p>
    </div>
    
    <div class="bs-callout bs-callout-info hidden">
      <h4>Yay!</h4>
      <p>Everything seems to be ok :)</p>
    </div>
    
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
            {{ Form::button('<i class="fa fa-plus"></i> Save Connection', 
                    ['class' => 'btn btn-primary','type' => 'submit']) }}
            {{ Form::button('<i class="glyphicon glyphicon-ok"></i> Test Connection', 
                    ['class' => 'btn btn-success']) }}
        </div>
</div> 
