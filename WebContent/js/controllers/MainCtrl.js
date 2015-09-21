/// <reference path="../../libs/typings/angularjs/angular.d.ts"/>

(function () { 
  'use strict';
  
  angular.module('mainControllers', ['authServices'])
  .controller('MainController', ['AuthService', '$rootScope', '$state', '$localStorage', 
                        function (AuthService, $rootScope, $state, $localStorage) {
    
    $rootScope.appName = 'Pedal-to-Play';
    $rootScope.SERVER_BASE_URL = 'http://localhost/Pedal-to-Play/Server/';    
    $rootScope.navbarTitle = $rootScope.appName;
    
    this.menuItens = [
      {
        name: "Home",
        action: function () {
          $state.go('app.home');
        }
      },
      {
        name: "Logout",
        action: function () {
          AuthService.logout();
        }
      }
    ];
        
    angular.element('.navmenu').offcanvas({'toggle': false});
    
    $rootScope.$on('$routeChangeStart', function (event, next, current) {
        angular.element('.navmenu').offcanvas('hide');    
    });
    
    $rootScope.$on("$locationChangeStart", function (event, next, current) {
        if ($localStorage.user === undefined) {
          event.preventDefault();
          $state.go('auth'); 
        } 
    });
    
    $rootScope.showPushMenu = function(){
      angular.element('.navmenu').offcanvas('show');
    };
  }])
  
})();