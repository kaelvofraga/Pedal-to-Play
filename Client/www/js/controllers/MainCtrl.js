/// <reference path="../../libs/typings/angularjs/angular.d.ts"/>

(function () { 
  'use strict';
  
  angular.module('Pedal2Play')
    .controller('MainController', ['AuthService', '$rootScope', '$state', 'localStorageService',
      function (AuthService, $rootScope, $state, localStorageService) {

        $rootScope.appName = 'Pedal-to-Play';
        $rootScope.SERVER_BASE_URL = 'http://pedal2play.kaelfraga.com/';
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

        $rootScope.$on('$routeChangeStart', function (event, next, current) {
          angular.element('.navmenu').offcanvas('hide');
        });
        
        $rootScope.$on('$stateChangeStart',
          function (event, toState, toParams, fromState, fromParams) {
            if ((localStorageService.get('user') === null) && (toState.name !== 'auth')) {
              event.preventDefault();
              $state.go('auth');
            }
          })
      }]);
})();