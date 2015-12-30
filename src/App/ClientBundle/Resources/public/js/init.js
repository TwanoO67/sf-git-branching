var app = angular.module('App', ['ngRoute']);
//-------------------------------------------------------------------------
app.config(['$interpolateProvider', '$routeProvider', '$locationProvider', function ($interpolateProvider, $routeProvider, $locationProvider ) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
  //-----------------------------------
  $routeProvider/*.when('/home/a', {
    templateUrl: 'modules/slideA.html',
    controller: 'homeSlideAController'
  }).when('/home/b', {
    templateUrl: 'modules/slideB.html',
    controller: 'homeSlideBController'
  }).when('/home/intro', {
    templateUrl: 'templates/intro.html',
    controller: 'introController'
  })*/.when('/status', {
    templateUrl: 'subview/status.html',
    controller: 'subviewController'
  }).when('/branche', {
    templateUrl: 'subview/branche.html',
    controller: 'subviewController'
  }).when('/log', {
    templateUrl: 'subview/log.html',
    controller: 'subviewController'
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
app.controller('subviewController', ['$scope', function ($scope) {
  //$scope.subtitle = "Subtitle SlideA from Angular";
  $scope.afficheAlerte = function (type, titre, message){
      contenu = '<div class="alert alert-'+type+' alert-dismissable">';
      contenu += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
      if(titre != '')
          contenu += '<strong>'+titre+'</strong> ';
      contenu += message;
      contenu += '</div>';

      jQuery('#zone_alert').html(contenu);
  };
}]);
