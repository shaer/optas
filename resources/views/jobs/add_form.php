<md-dialog class="autoResize" aria-label="Create New Job">
  <form name="jobForm">
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2>Create New Job</h2>
        <span flex></span>
        <md-button class="md-icon-button" ng-click="cancel()">
          <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
        </md-button>
      </div>
    </md-toolbar>
    <md-dialog-content style="min-width:500px; max-width:800px;max-height:810px; ">
      <md-tabs md-dynamic-height md-border-bottom  md-selected="activeTab">
        <md-tab label="Definition">
          <div class="md-paddingshow_form_errors">
            <ul>
              <li ng-repeat="error in formErrors">{{error[0]}}</li>
            </ul>
          </div>
          <md-content class="md-padding" layout-gt-sm="row">
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Name</label>
                    <input md-maxlength="150" required name="name" ng-model="job.name" />
                    <div class="error_message" ng-show="jobForm.name.$invalid && showFieldErrors">This field is required!</div>
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Namespace</label>
                    <input md-maxlength="150" required name="namespace" ng-model="job.namespace" />
                    <div class="error_message" ng-show="jobForm.namespace.$invalid && showFieldErrors">This field is required!</div>

                </md-input-container>
          </md-content>
          <md-content class="md-padding">
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Job Description</label>
                    <textarea name="description" ng-model="job.description"></textarea>
                </md-input-container>
          </md-content>
        </md-tab>
        <md-tab label="Actions">
         <md-content ng-include="'/app/jobs/partials/actions.html'" class="md-padding"></md-content>
        </md-tab>
        <md-tab label="Scheduling">
            <md-content ng-include="'/app/jobs/partials/scheduler.html'" class="md-padding"></md-content>
        </md-tab>
      </md-tabs>
    </md-dialog-content>

    <md-dialog-actions layout="row">
      <md-button ng-click="cancel()">
        Cancel
      </md-button>
      <span flex></span>
      <md-button ng-click="save(jobForm.$valid)" style="margin-right:20px;" >
        Save
      </md-button>
    </md-dialog-actions>
  </form>
</md-dialog>

