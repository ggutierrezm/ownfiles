<div class="setup-content" ng-app="setup" >
	<div class="setup-form">
		<form method="post" ng-controller="content" ng-submit="change_user()">
			<div class="form-group">
				<label for="email">Write your new email:</label>
				<input type="email" class="form-control login" id="email" placeholder="Enter email" name="user" ng-model="user" required>
				<button type="button" class="btn btn-default btn-sm" ng-click="change_user()">
					<span class="glyphicon glyphicon-envelope"></span> Change my email
				</button>
			</div>	
			<div class="form-group">
				<label for="pwd">New Password:</label>
				<input type="password" class="form-control login" id="pwd" placeholder="Enter password" name="password" ng-model="password" required>		
				<label for="pwd">Repeat new password:</label>
				<input type="password" class="form-control login" id="pwd" placeholder="Repeat password" name="repeat_password" ng-model="repeat_password" required>		

				<button type="button" class="btn btn-default btn-sm" ng-click="change_password()">
					<span class="glyphicon glyphicon-lock"></span> Change my password
				</button>		        
				<div ng-show="hasErrors"><span class="glyphicon glyphicon-alert"></span> {{message}}</div>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-default btn-sm" ng-click="delete_account()">
					<span class="glyphicon glyphicon-remove"></span> Remove my account
				</button>
			</div>
		</form>
	</div>
</div>