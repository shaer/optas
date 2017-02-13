    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{ url('connection') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="connection-name" class="col-sm-3 control-label">Connection Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="connection-name" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label for="connection-type" class="col-sm-3 control-label">Connection Type</label>

                <div class="col-sm-6">
                    <input type="text" name="connection_type_id" id="connection-type" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label for="host" class="col-sm-3 control-label">Host</label>

                <div class="col-sm-6">
                    <input type="text" name="host" id="host" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username</label>

                <div class="col-sm-6">
                    <input type="text" name="username" id="username" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label for="Password" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-6">
                    <input type="password" name="Password" id="Password" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Connection
                    </button>
                </div>
            </div>
            
        </form>