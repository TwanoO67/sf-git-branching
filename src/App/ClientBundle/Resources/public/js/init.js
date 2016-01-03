var app = angular.module('App', ['ngRoute']);
var afficheAlerte = function (type, titre, message){
    contenu = '<div class="alert alert-'+type+' alert-dismissable">';
    contenu += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    if(titre != '')
        contenu += '<strong>'+titre+'</strong> ';
    contenu += message;
    contenu += '</div>';

    jQuery('#zone_alert').html(contenu);
};
//-------------------------------------------------------------------------
app.config(['$interpolateProvider', '$routeProvider', '$locationProvider', function ($interpolateProvider, $routeProvider, $locationProvider ) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
  //-----------------------------------
  $routeProvider.when('/tag', {
    templateUrl: 'subview/tag.html',
    controller: 'subviewController'
  }).when('/remote', {
    templateUrl: 'subview/remote.html',
    controller: 'subviewController'
  })/*.when('/home/a', {
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
    controller: 'subviewBranchController'
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

app.controller('subviewBranchController', ['$scope' , 'ngBootbox', function ($scope, $ngBootbox) {
  //recuperation de variable depuis php
  $scope.repo_path = repo_path;
  $scope.url_ajax =  url_ajax;

  $scope.changeBranche = function(branche){
    $ngBootbox.confirm("Etes-vous sûr de vouloir changer le dépot courant sur la branche <strong>"+branche+"</strong> ?")
    .then(function() {

        $http({
          method: 'GET',
          url: url_ajax,
          dataType: 'json',
          data: {
              action: 'checkout',
              repo: repo_path,
              branche: branche,
          }
        }).then(function successCallback(response) {
          if(response.data.code == 'success'){
              //afficheAlerte('success',"Checkout","Le changement de branche à fonctionné!");
              document.location.reload();
          }
          else{
              afficheAlerte('danger',"Checkout","Le changement de branche à fait une erreur!<br/>Vérifier le status du depot!");
              console.log(response.data);
          }
        }, function errorCallback(response) {
            afficheAlerte('danger',"Checkout","Le changement de branche à fait une erreur!");
            console.log(response.data);
      });

    }, function() {
        console.log('Confirm dismissed!');
    });
  }

  $scope.supprimeBranche = function(branche){

        bootbox.confirm("Etes-vous sûr de vouloir supprimer la branche <strong>"+branche+"</strong> ?",
         function(result) {
              if(result){
                jQuery.ajax(url_ajax,{
                        dataType: 'json',
                        data: {
                            action: 'delete',
                            repo: repo_path,
                            branche: branche,
                        },
                        success: function(data, textStatus, jqXHR){
                            if(data.code == 'success'){
                                //afficheAlerte('success',"Checkout","Le changement de branche à fonctionné!");
                                document.location.reload();
                            }
                            else{
                                afficheAlerte('danger',"Delete","La suppression de branche à fait une erreur!");
                                console.log(data);
                            }
                        },
                        error: function(jqXHR,textStatus, errorThrown){
                            afficheAlerte('danger',"Delete","La suppression de branche à fait une erreur!");
                            console.log(jqXHR.responseText);
                        }

                    }
                );
            }
        });

    }

}]);

app.controller('subviewController', ['$scope', function ($scope) {
  //$scope.subtitle = "Subtitle SlideA from Angular";
  $scope.test = function(a){
    alert(a);
  }
}]);
