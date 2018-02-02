var app = angular.module('myApp', []);

/* $http ajax calls really belongs in a service, 
but I'll be using them inside the controller for this demo */ 

app.controller('mainCtrl', function($scope, $http) {
  /*$http.get('path/to/json').then(function(data) {
    $scope.questions = data;
  });*/
  //inputting json directly for this example
  $scope.questions = [        
    {userName:"person1",	title:"Title1",question:"What are the questions in the exam?"},
    {userName:"person2",	title:"Title2", question:"What are the questions in the exam1?"},
	{userName:"person3",	title:"Title3", question:"What are the questions in the exam2?"},
	{userName:"person4",	title:"Title4", question:"What are the questions in the exam3?"},
  ];
});