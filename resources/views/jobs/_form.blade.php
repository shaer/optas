<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href=".definition-tab">Definition</a></li>
        <li><a data-toggle="tab" href=".actions-tab">Actions</a></li>
        <li><a data-toggle="tab" href=".scheduling-tab">Scheduling</a></li>
        <li><a data-toggle="tab" href=".triggers-tab">Triggers</a></li>
    </ul>
    <div class="panel-body">
        <div class="tab-content">
            <div class="definition-tab tab-pane fade in active">
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
            </div>
            <div class="actions-tab tab-pane fade in">
                <div class="form-group input-group">
                    {{ Form::select('action_selector', $action_types, null, ['class' => 'form-control load_action', 'placeholder' => 'Select Action Type']) }}
                    <span class="input-group-btn"><button class="btn btn-success addNewAction" type="button"><i class="glyphicon glyphicon-plus"></i></button></span>
                </div>
                <div class="panel-group accordion">
                    
                </div>
            </div>
            <div class="scheduling-tab tab-pane fade in">
                scheduling
            </div>
            <div class="triggers-tab tab-pane fade in">
                triggers
            </div>
        </div>
        
        <div class="form-group">
            {{ Form::button('<i class="glyphicon glyphicon-ok"></i> Save Job', 
                        ['class' => 'btn btn-primary','type' => 'submit']) }}
        </div>
    </div>
</div>
