<!--
24 Jul 2019
Copyright (c) 2019, Guillermo Gutierrez Morote
Released under the GPL license
http://www.gnu.org/copyleft/gpl.html
-->
<div ng-app="myfiles" ng-controller="content" class="content">
  <table ng-show="hasData">
    <thead>
      <tr> 
       <td>File name</td>
       <td>Creation</td>
       <td></td>  	  
     </tr>
   </thead>
   <tbody>
    <tr ng-repeat="file in files track by $index" >    
     <td align="center">{{file.name}}</td>
     <td align="center">{{file.creation}}</td><td><a ng-click="download(file.name)">
      <span class="glyphicon glyphicon-play-circle"></span></a> <a ng-click="remove(file.name)"><span class="glyphicon glyphicon-remove-circle"></span></a></td>  	  
    </tr>
  </tbody>
  </table>  
  <div ng-show="noData" class="content">
    <h1><i class="glyphicon glyphicon-info-sign"></i> Sorry, there are no files associated with you yet!</h1>
    <p>
      <a class="btn btn-info btn-lg" ng-click="refresh()">
       <i class="glyphicon glyphicon-refresh"></i> Refresh
     </a>
   </p> 
  </div>
  <div ng-repeat="(op_key, op_value) in operations track by $index">  		
      <div ng-repeat="(par_key, par_value) in op_value track by $index">
       <div ng-repeat="(key, value) in par_value track by $index" class="operation_group">          
        <div ng-repeat="(conf_key, conf_value) in value track by $index" ng-if="conf_key!='description'" class="parameter">
         <label>{{conf_key}}</label><input type="text" id="{{conf_key}}" placeholder="{{conf_value}}" ng-model="conf_key_value">
        </div>  				
      
        </div>
      </div>
  </div>
    <a href="{{link}}" target="_blank" class="download"><label>{{name}}</label></a>
</div>