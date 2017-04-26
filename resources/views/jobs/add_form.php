<md-dialog class="autoResize" aria-label="Create New Job">
  <form>
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
      <md-tabs md-dynamic-height md-border-bottom>
        <md-tab label="Definition">
          <md-content class="md-padding" layout-gt-sm="row">
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Name</label>
                    <input md-maxlength="30" required name="name" ng-model="job.name" />
                </md-input-container>
                <md-input-container class="md-block" flex-gt-sm>
                    <label>Namespace</label>
                    <input md-maxlength="30" required name="namespace" ng-model="job.namespace" />
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
          <div class="md-padding">
            <md-content layout-gt-xs="row">
                <md-input-container class="md-block" flex-gt-xs>
                  <label>Select an Action to Add</label>
                    <md-select ng-model="job_action" ng-change="showActionsPopup()">
                      <md-option ng-value="1">Database Action</md-option>
                  </md-select>
                </md-input-container>
              </md-content>
              <md-content>
                <md-list ng-cloak ng-show="job.actions.length != 0">
                  <md-subheader class="md-no-sticky">Current Actions:</md-subheader>
                  <md-list-item ng-repeat="action in job.actions">
                    <p> {{ action.name }} </p>
                    <md-menu class="md-secondary">
                      <md-button class="md-icon-button">
                        <md-icon md-svg-icon="/assets/images/edit.svg"></md-icon>
                      </md-button>
                      <md-menu-content width="4">
                        <md-menu-item>
                          <md-button ng-click="showActionsPopup(action)">
                            Settings
                          </md-button>
                        </md-menu-item>
                        <md-menu-item>
                          <md-button>
                            Delete
                          </md-button>
                        </md-menu-item>
                      </md-menu-content>
                    </md-menu>
                  </md-list-item>
                </md-list>
              </md-content>
            </div>
        </md-tab>
        <md-tab label="Scheduling">
          <md-content class="md-padding">
            <p>Integer turpis erat, porttitor vitae mi faucibus, laoreet interdum tellus. Curabitur posuere molestie dictum. Morbi eget congue risus, quis rhoncus quam. Suspendisse vitae hendrerit erat, at posuere mi. Cras eu fermentum nunc. Sed id ante eu orci commodo volutpat non ac est. Praesent ligula diam, congue eu enim scelerisque, finibus commodo lectus.</p>
          </md-content>
        </md-tab>
      </md-tabs>
    </md-dialog-content>

    <md-dialog-actions layout="row">
      <md-button ng-click="answer('not useful')">
        Cancel
      </md-button>
      <span flex></span>
      <md-button ng-click="answer('useful')" style="margin-right:20px;" >
        Save
      </md-button>
    </md-dialog-actions>
  </form>
</md-dialog>

