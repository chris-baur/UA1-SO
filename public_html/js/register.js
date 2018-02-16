var app = angular.module('myRegister', []);

/* $http ajax calls really belongs in a service, 
but I'll be using them inside the controller for this demo */ 

app.controller('myCtrl', function($scope, $http) {
  $scope.accounts = [];
  
  $scope.newAccount=function(){
	  $scope.accounts.push({'username':$scope.userName, 
							'password': $scope.password, 
							'answer1':$scope.answer1,
							'answer2':$scope.answer2,
							'gender':$scope.gender.value});
		// Writing it to the server
		//		
		var dataObj = JSON.stringify({
				username:$scope.userName, 
				password: $scope.password, 
				answer1:$scope.answer1,
				answer2:$scope.answer2,
				gender:$scope.gender
		});	
		console.log(dataObj);
		$http.post('data.JSON', dataObj). success(function(data, status, headers, config) {
        // this callback will be called asynchronously
        // when the response is available
        console.log(data);
      }).
      error(function(data, status, headers, config) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
      });;
		
		// Making the fields empty
		//
		$scope.userName='';
		$scope.password='';
		$scope.answer1='';
		$scope.answer2='';
		$scope.gender='';		
	};
});