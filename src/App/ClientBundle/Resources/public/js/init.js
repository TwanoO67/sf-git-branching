var app = angular.module('App', ['ngRoute']);
requirejs(['/lib/scripts/bootbox.js'],function(elem){
  window.bootbox = elem;
});

var afficheAlerte = function (type, titre, message){
    contenu = '<div class="alert alert-'+type+' alert-dismissable">';
    contenu += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    if(titre != '')
        contenu += '<strong>'+titre+'</strong> ';
    contenu += message;
    contenu += '</div>';

    jQuery('#zone_alert').html(contenu);
};

function nettoieBranchName(name){
  if(name.indexOf("refs/heads/") !== -1){
    var tab = name.split("refs/heads/");
    name = tab[1];
  }
  return name;
}

function contactWebService(dataTab,successFct,errorFct){
  console.log('Appel Ajax aux webservices');
  jQuery.ajax({
      method: 'POST',
      url: url_ajax,
      dataType: 'json',
      data: dataTab,
      success: successFct,
      error: errorFct
  });
}

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

app.controller('subviewBranchController', function ($scope, $http) {
  //recuperation de variable depuis php
  $scope.repo_path = repo_path;
  $scope.url_ajax =  url_ajax;

  $scope.changeTag = function(tag){
    window.bootbox.confirm("Etes-vous sûr de vouloir changer le dépot courant sur le tag <strong>"+tag+"</strong> ?",
    function(retour) {
      if(retour){

        contactWebService(
          {
            action: 'checkout',
            repo_path: $scope.repo_path,
            branche: tag,
          },
          function(response) {
            if(response.code == 'ok'){
                //afficheAlerte('success',"Checkout","Le changement de branche à fonctionné!");
                document.location.reload();
            }
            else{
                afficheAlerte('danger',"Checkout","Le changement de tag à fait une erreur!<br/>Vérifier le status du depot!");
                console.log(response.data);
            }
          },
          function(response) {
            afficheAlerte('danger',"Checkout","Le changement de tag à fait une erreur!");
            console.log(response);
          }
      );

    }


    });

  }

  $scope.pull = function(){
        contactWebService(
          {
            action: 'pull',
            repo_path: $scope.repo_path,
          },
          function(response) {
            if(response.code == 'ok'){
                //afficheAlerte('success',"Checkout","Le changement de branche à fonctionné!");
                document.location.reload();
            }
            else{
                afficheAlerte('danger',"Checkout","Le pull à fait une erreur!<br/>Vérifier le status du depot!");
                console.log(response.data);
            }
          },
          function(response) {
            afficheAlerte('danger',"Checkout","Le pull à fait une erreur!");
            console.log(response);
          }
      );
  }

  $scope.changeBranche = function(branche){
    var cleaned_branch = nettoieBranchName(branche);
    window.bootbox.confirm("Etes-vous sûr de vouloir changer le dépot courant sur la branche <strong>"+cleaned_branch+"</strong> ?",
    function(retour) {
      if(retour){

        contactWebService(
          {
            action: 'checkout',
            repo_path: $scope.repo_path,
            branche: cleaned_branch,
          },
          function(response) {
            if(response.code == 'ok'){
                //afficheAlerte('success',"Checkout","Le changement de branche à fonctionné!");
                document.location.reload();
            }
            else{
                afficheAlerte('danger',"Checkout","Le changement de branche à fait une erreur!<br/>Vérifier le status du depot!");
                console.log(response.data);
            }
          },
          function(response) {
            afficheAlerte('danger',"Checkout","Le changement de branche à fait une erreur!");
            console.log(response);
          }
      );

    }


    });

  }

  $scope.supprimeBranche = function(branche){
        var cleaned_branch = nettoieBranchName(branche);
        window.bootbox.confirm("Etes-vous sûr de vouloir supprimer la branche <strong>"+cleaned_branch+"</strong> ?",
        function(result) {
              if(result){

                contactWebService({
                    action: 'delete',
                    repo_path: $scope.repo_path,
                    branche: cleaned_branch,
                  },
                 function(response) {
                    if(response.code == 'ok'){
                        //afficheAlerte('success',"Checkout","Le changement de branche à fonctionné!");
                        document.location.reload();
                    }
                    else{
                        afficheAlerte('danger',"Delete","La suppression de branche à fait une erreur!");
                        console.log(response.data);
                    }
                  },
                  function(response) {
                    afficheAlerte('danger',"Delete","La suppression de branche à fait une erreur!");
                    console.log(response);
                }
              );

            }
        });

    }

});

app.controller('subviewController', ['$scope', function ($scope) {
  //$scope.subtitle = "Subtitle SlideA from Angular";
  $scope.test = function(a){
    alert(a);
  }
}]);
