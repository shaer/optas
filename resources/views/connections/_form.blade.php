<div class="panel-body">
    
    <div class="alert alert-danger alert-dismissable inFormErrors" role="alert" style="display:none" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>  
        <ul></ul>
    </div>
    
    <!-- New Connection Form -->
    <div class="form-group">
            {{ Form::label('name', 'Connection Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
        </div>
    <div class="form-group">
            <label for="connection-type">Connection Type</label>
            {{ Form::select('connection_type_id', $connection_types, null, ['class' => 'form-control', 'placeholder' => 'Select Type']) }}
            <small class="text-danger hidden"></small>
        </div>
    <div class="form-group">
            {{ Form::label('host', 'Host') }}
            {{ Form::text('host', null, ['class' => 'form-control']) }}
            <small class="text-danger hidden"></small>
        </div>
    <div class="form-group">
            {{ Form::label('user', 'Username') }}
            {{ Form::text('user', null, ['class' => 'form-control' ]) }}
            <small class="text-danger hidden"></small>
        </div>
    <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
            <div class="hidden editPassword">
                <input type="checkbox" class="editPassCb"> Edit Password
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
