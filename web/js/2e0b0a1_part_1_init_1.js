var app = angular.module('App', ['ngRoute']);
//-------------------------------------------------------------------------
app.config(['$interpolateProvider', '$routeProvider', '$locationProvider', function ($interpolateProvider, $routeProvider, $locationProvider ) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
  //-----------------------------------
  $routeProvider.when('/home/a', {
    templateUrl: 'modules/slideA.html',
    controller: 'homeSlideAController'
  }).when('/home/b', {
    templateUrl: 'modules/slideB.html',
    controller: 'homeSlideBController'
  }).when('/home/intro', {
    templateUrl: 'templates/intro.html',
    controller: 'introController'
  }).when('/status', {
    templateUrl: 'subview/status.html',
    controller: 'pageController'
  }).otherwise({
    redirectTo: '/status'
  });
  $locationProvider.hashPrefix('!');
}]);
//-------------------------------------------------------------------------
app.controller('appController', ['$scope', '$location', function ($scope, $location) {
  /* test */
  $scope.container = angular.element(document.querySelector('#container'));
  $scope.gotoView = function (view) {
    $location.path('/' + view);
  };
}]);
app.controller('pageController', ['$scope', function ($scope) {
  //$scope.subtitle = "Subtitle SlideA from Angular";
}]);
app.controller('homeSlideAController', ['$scope', function ($scope) {
  $scope.subtitle = "Subtitle SlideA from Angular";
}]);
app.controller('homeSlideBController', ['$scope', function ($scope) {
  $scope.subtitle = "Subtitle SlideB from Angular";
}]);
app.controller('introController', ['$scope', function ($scope) {
  $scope.title = title;
  $scope.subtitle = "Text from Symfony to Angular";
  $scope.text = "intro";
}]);
