// 24 Jul 2019
// Copyright (c) 2019, Guillermo Gutierrez Morote
// Released under the GPL license
// http://www.gnu.org/copyleft/gpl.html
angular.module('register', []).controller('validate', ['$scope', '$http',
  function($scope, $http) {      
    $scope.submit = function() {
      if ($scope.password != $scope.repeat_password) {
        $scope.hasErrors = true;
        $scope.message = 'Password does not match';  
        return false;
      }
      hashPassword($scope.password).then((hash) => {          
        var data = $.param({ user: $scope.user, password: hash });
        var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
        var request = $http.post('api/adduser.php', data, config).then(
          function successCallback(response) {            
            $scope.hasErrors = false;
            window.location.href = "main.php?target=mydevices";
          }, 
          function errorCallback(response) {
            $scope.hasErrors = true;
            $scope.message = response.data[1];
          });
      });
    }
  }
  ]);

//Just to not send the password in plain, it will be properly hashed and salted in server side
var hashPassword = function hashString(str, algo = "SHA-256") {
  let strBuf = new TextEncoder('utf-8').encode(str);
  return crypto.subtle.digest(algo, strBuf)
  .then(hash => {
    window.hash = hash;
      // here hash is an arrayBuffer, 
      // so we'll connvert it to its hex version
      let result = '';
      const view = new DataView(hash);
      for (let i = 0; i < hash.byteLength; i += 4) {
        result += ('00000000' + view.getUint32(i).toString(16)).slice(-8);
      }
      return result;
    });
}

angular.module('login', []).controller('validate', ['$scope', '$http',
  function($scope, $http) {               
    $scope.hasErrors = false;
    $scope.submit = function() {   
      hashPassword($scope.password).then((hash) => {          
        var data = $.param({ user: $scope.user, password: hash });
        var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
        var request = $http.post('api/login.php', data, config).then(
          function successCallback(response) {
            $scope.hasErrors = false;
            window.location.href = "main.php?target=upload";
          }, 
          function errorCallback(response) {
            $scope.hasErrors = true;
            console.log(response.data);
            $scope.message = response.data[1];            

          });
      });
    }
  }
  ]);

angular.module('setup', []).controller('content', ['$scope', '$http',
  function($scope, $http) {
    $scope.change_user = function() {       
      if (typeof $scope.user === 'undefined'){
        $scope.hasErrors = true;
        $scope.message = 'Empty user aren\'t allowed';  
        return false;  
      }
      var data = $.param({ user: $scope.user });
      var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
      var request = $http.post('api/changeuser.php', data, config).then(
        function successCallback(response) {         
          console.log(response);
        }, 
        function errorCallback(response) {
          console.log(response);
        });
    }

    $scope.change_password = function() { 
      if (typeof $scope.password === 'undefined'){
        $scope.hasErrors = true;
        $scope.message = 'Empty passwords aren\'t allowed';  
        return false;  
      }
      if ($scope.password != $scope.repeat_password) {
        $scope.hasErrors = true;
        $scope.message = 'Password does not match';  
        return false;
      }
      $scope.hasErrors = false;
      hashPassword($scope.password).then((hash) => {      
        var data = $.param({ password: hash });
        var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
        var request = $http.post('api/changepassword.php', data, config).then(
          function successCallback(response) {         
            console.log(response);
          }, 
          function errorCallback(response) {
            console.log(response);
          });
      });
    }

    $scope.delete_account = function() {       
      var data = $.param({ });
      var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
      var request = $http.post('api/deleteaccount.php', data, config).then(
        function successCallback(response) {         
           window.location.href = "logout.php";
        }, 
        function errorCallback(response) {
          console.log(response);
        });
    }

  }
]);

angular.module('myfiles', []).controller('content', ['$scope', '$http',
  function($scope, $http) {                 
    $scope.refresh = function() { 
      $scope.apiRequested = false;  
      $scope.hasErrors = false;  
      var data = $.param({ });
      var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
      var request = $http.post('api/myfiles.php', data, config).then(
        function successCallback(response) {
          if (Object.keys(response.data.files).length > 0){
            $scope.hasData = true;          
          }
          else{
            $scope.hasData = false;
          }
          $scope.noData = !$scope.hasData;
          $scope.files = response.data.files;           
        }, 
        function errorCallback(response) {
          console.log(response);
        });
    }
            
    

    $scope.download = function(name) {   
      var data = $.param({ name: name });
      var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
      var request = $http.post('api/download.php', data, config).then(
        function successCallback(response) {
          console.log(response.data.link)
          window.open(response.data.link, '_blank');
        }, 
        function errorCallback(response) {
          console.log(response);
          $scope.link = '';
          $scope.name = '';
          $scope.showLink = false;  
        });      
    }

    $scope.remove = function(name) {   
      $scope.apiRequested = false;
      var data = $.param({ name: name });
      if (!confirm('Delete file?'))
      {
        return;
      }
      var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
      var request = $http.post('api/remove.php', data, config).then(
        function successCallback(response) {
          $scope.refresh();
        }, 
        function errorCallback(response) {
          console.log(response);
        });      
    }    
  $scope.refresh();
  }]);

var upload = angular.module('upload', []);

upload.service('uploader', ['$scope', '$http', function ($scope, $http) {
  this.uploadFiles = function(files){
    console.log(files);
  }
}]);

upload.directive('selectNgFiles', function() {
  return {
    require: 'ngModel',
    link: function postLink(scope,elem,attrs,ngModel) {
      elem.on("change", function(e) {
        var files = elem[0].files;
        ngModel.$setViewValue(files);
        console.log('upload files...');
        scope.upload(files);      
      })
    }
  }  
});

upload.controller('uploader', ['$scope', '$http', function($scope, $http){
    
    $scope.upload = function(files) {                 
        var crlf = "\r\n";                               
        for (var i = 0; i < files.length; i++)
        {
                    
          var file = files[i];          
          var config = {   
            transformRequest: angular.identity,        
            headers : {'Content-Type': undefined}
          };
          var data = new FormData();   
          data.append('file', file) 
          $scope.uploading = true;
          var request = $http.post('api/upload.php', data, config).then(
          function successCallback(response) {         
            console.log(response);
            $scope.uploading = false;
          }, 
          function errorCallback(response) {
            console.log(response);
            $scope.uploading = false;
          });   
        }        
        
    };
    
}]);


upload.filter( 'filesize', function () {    
  return function(bytes, precision) {
    if (isNaN(parseFloat(bytes)) || !isFinite(bytes)) return '-';
    if (typeof precision === 'undefined') precision = 1;
    var units = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB'],
      number = Math.floor(Math.log(bytes) / Math.log(1024));
    return (bytes / Math.pow(1024, Math.floor(number))).toFixed(precision) +  ' ' + units[number];
  }
});


