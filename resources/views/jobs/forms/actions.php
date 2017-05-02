<div class="show_form_errors">
    <ul>
        <li ng-repeat="error in formErrors">{{error[0]}}</li>
    </ul>
</div>
<md-content layout-gt-xs="row">
    <md-input-container class="md-block" flex-gt-xs>
        <label>Select an Action to Add</label>
        <md-select ng-model="$parent.new_action_type" ng-change="showActionsPopup()">
            <md-option ng-repeat="(key, action_type) in actionTypes" ng-value="key">{{action_type}}</md-option>
        </md-select>
    </md-input-container>
</md-content>
<md-content>
    <md-list ng-cloak ng-show="job.actions.length > 0">
        <md-header class="md-no-sticky">Current Actions:</md-header>
        <md-list-item ng-repeat="action in job.actions" ng-class="{'show_error' : action.hasError }">
            <md-icon md-svg-icon="/assets/images/database.svg"></md-icon>
            <p> {{ action.name }} </p>
            <md-menu class="md-secondary">
                <md-button class="md-icon-button">
                    <md-icon md-svg-icon="/assets/images/edit.svg"></md-icon>
                </md-button>
                <md-menu-content width="4">
                    <md-menu-item>
                        <md-button ng-click="showActionsPopup(action)">Settings</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ng-click="deleteAction($index)">Delete</md-button>
                    </md-menu-item>
                </md-menu-content>
            </md-menu>
        </md-list-item>
    </md-list>
</md-content>