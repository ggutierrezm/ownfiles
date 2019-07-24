 <!--
 24 Jul 2019
 Copyright (c) 2019, Guillermo Gutierrez Morote
 Released under the GPL license
 http://www.gnu.org/copyleft/gpl.html
-->
<div class="setup-content" ng-app="upload">   
	<div class="upload-form">
		<form method="post" ng-model="content" ng-controller="uploader" ng-submit="upload()">
			<div class="form-group">
   				<input type="file" select-ng-files ng-model="fileArray" name="files[]" multiple>
    			<code><table ng-show="fileArray.length">
    			<tr><td>Name</td><td>Date</td><td>Size</td><td>Type</td><tr>
    			<tr ng-repeat="file in fileArray">
      			<td>{{file.name}}</td>
      			<td>{{file.lastModified | date  : 'MMMdd,yyyy'}}</td>
      			<td>{{file.size | filesize : 2 }}</td>
      			<td>{{file.type}}</td>      
    			</tr>   
    			</table></code>  	          
          <div ng-show="uploading" class="spinner">
            <img src="img/spinner.gif" />
          </div>
  			</div>                
        
		</form>    

	</div>	
  
</div>
