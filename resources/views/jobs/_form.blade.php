<div class="panel-body">
    <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('namespace', 'Namespace') }}
            {{ Form::text('namespace', null, ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('is_automated', 'Manual Execution?') }}
            {{ Form::checkbox('is_automated', 'T', ['class' => 'form-control', 'required' => 'required']) }}
            <small class="text-danger hidden"></small>
    </div>
    <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea ('description', null, ['class' => 'form-control']) }}
            <small class="text-danger hidden"></small>
    </div>
    
    <div class="form-group">
        {{ Form::button('<i class="glyphicon glyphicon-ok"></i> Save Role', 
                    ['class' => 'btn btn-primary','type' => 'submit']) }}
    </div>
</div>