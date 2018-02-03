var route= angular.mode('myApp', ['ngRoute'] );

//configure our routes
route.config(function($routeProvider){
	$routeProvider

	//route for the home page
	.when('/',{
		templateUrl:'../home_page/homepage.html',
		controller: 'mainCtrl';		
	})
	//route for the about page
	.when('/about',{
		templateUrl:'../home_page/about.html',
		controller: 'aboutCtrl';		
	})
	//route for the favorites page
	.when('/favorites',{
		templateUrl:'../home_page/favorites.html',
		controller: 'favoritesCtrl';		
	})
	//route for the home page
	.when('/myquestions',{
		templateUrl:'../home_page/myquestions.html',
		controller: 'questionsCtrl';		
	});
});
//the controllers
route.controller('mainCtrl',function($scope)){

});

route.controller('aboutCtrl',function($scope)){
$scope.AboutMessage= "This is the about page";
});

route.controller('favoritesCtrl',function($scope)){
$scope.FavoriteMessage= "This is the favorites page";
});

route.controller('questionsCtrl',function($scope)){
$scope.QuestionMessage= "This is the my questions page";
});
