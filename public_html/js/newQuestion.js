var app = angular.module('newQuestion', ['ngTagsInput']);

/* $http ajax calls really belongs in a service, 
but I'll be using them inside the controller for this demo */ 

app.controller('questionController', function($scope, $http) {
    $scope.question_title="";
    $scope.content="";
    $scope.tags=[];
    $scope.allowSubmit = function(){
      return $scope.question_title.length==0 && $scope.content.length==0;
    }
});