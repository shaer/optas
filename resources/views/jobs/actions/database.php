<md-dialog aria-label="Create New Job">
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2>Add Database Action</h2>
        <span flex></span>
        <md-button class="md-icon-button" ng-click="addAction.cancel()">
          <md-icon md-svg-src="/assets/images/close.svg" aria-label="Close dialog" ></md-icon>
        </md-button>
      </div>
    </md-toolbar>
     <md-dialog-content style="min-width:500px; max-width:800px;max-height:810px; ">
        <form name="addDbActionForm">
            <md-content class="md-padding">
                <md-input-container class="md-block">
                    <label>Action Title</label>
                    <input type="text" name="name" md-maxlength="150" required ng-model="addAction.action.name">
                    <div class="error_message" ng-show="addDbActionForm.name.$invalid && addAction.showFieldErrors">This field is required!</div>
                </md-input-container>
                <md-input-container class="md-block">
                    <label>Select Database Connection</label>
                    <md-select name="connection_id" required ng-model="addAction.action.triggerable.connection_id">
                        <md-option ng-repeat="(key, connection) in addAction.connections" ng-value="key">{{connection}}</md-option>
                    </md-select>
                    <div class="error_message" ng-show="addDbActionForm.connection_id.$invalid && addAction.showFieldErrors">This field is required!</div>
                </md-input-container>
                <md-input-container class="md-block">
                    <md-checkbox name="tos" ng-true-value="'T'" ng-false-value="'F'" ng-model="addAction.action.triggerable.is_csv">
                        Export output as CSV
                    </md-checkbox>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Query</label>
                    <textarea name="query" required ng-model="addAction.action.triggerable.query"></textarea>
                    <div class="error_message" ng-show="addDbActionForm.query.$invalid && addAction.showFieldErrors">This field is required!</div>
                </md-input-container>
            </md-content>
        </form>
    </md-dialog-content>
    
    <md-dialog-actions layout="row">
      <md-button ng-click="addAction.cancel()">
        Cancel
      </md-button>
      <span flex></span>
      <md-button ng-click="addAction.save(addDbActionForm.$valid)" style="margin-right:20px;" >
        Save
      </md-button>
    </md-dialog-actions>
</md-dialog>