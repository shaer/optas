<md-dialog aria-label="Create New Job">
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2>Add Database Action</h2>
        <span flex></span>
        <md-button class="md-icon-button" ng-click="cancel()">
          <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
        </md-button>
      </div>
    </md-toolbar>
     <md-dialog-content style="min-width:500px; max-width:800px;max-height:810px; ">
        <md-content class="md-padding">
            <md-input-container class="md-block">
                <label>Action Title</label>
                <input type="text" name="query" ng-model="triggerable.name">
            </md-input-container>
            <md-input-container class="md-block">
                <label>Select Database Connection</label>
                <md-select ng-model="triggerable.connection_id">
                    <md-option ng-value="1">Database 1</md-option>
                    <md-option ng-value="1">Database 2</md-option>
                    <md-option ng-value="1">Database 3</md-option>
                </md-select>
            </md-input-container>
            <md-input-container class="md-block">
                <md-checkbox name="tos" ng-model="triggerable.is_csv">
                    Export output as CSV
                </md-checkbox>
            </md-input-container>
            <md-input-container class="md-block" flex-gt-sm>
                <label>Query</label>
                <textarea name="query" ng-model="triggerable.query"></textarea>
            </md-input-container>
        </md-content>

    </md-dialog-content>
    
    <md-dialog-actions layout="row">
      <md-button ng-click="addAction.cancel()">
        Cancel
      </md-button>
      <span flex></span>
      <md-button ng-click="addAction.save(triggerable)" style="margin-right:20px;" >
        Save
      </md-button>
    </md-dialog-actions>
</md-dialog>