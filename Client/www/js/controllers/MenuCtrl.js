/// <reference path='../../libs/typings/angularjs/angular.d.ts'/>

(function () { 
  'use strict';
  
  angular.module('Pedal2Play')
    .controller('MenuController', ['AuthService', '$scope', '$state', '$window', 'localStorageService',
                          function (AuthService, $scope, $state, $window, localStorageService) {
        
        $scope.navbarTitle = $state.current.data. pageTitle;

        this.menuItens = [
          {
            name: 'Home',
            icon: 'fa fa-home',
            action: function () {
              $state.go('app.home');
            }
          },
          {
            name: 'Logout',
            icon: 'fa fa-sign-out',
            action: function () {
              angular.element('#logoutModal').modal('show');                 
            }
          }
        ];
        
        $scope.doLogout = function() {
          angular.element('#logoutModal').modal('hide');
          angular.element('body').removeClass('modal-open');
          angular.element('.modal-backdrop').remove();
          AuthService.logout();
        };
        
        angular.element('.navmenu').offcanvas({'toggle': false});
        
        angular.element('.navmenu').on('show.bs.offcanvas', function (e) {
          angular.element('#menuContainer').addClass('blur');
        })
        
        angular.element('.navmenu').on('hide.bs.offcanvas', function (e) {
          angular.element('#menuContainer').removeClass('blur');
        })        
        
        $scope.$on('$stateChangeStart',
          function (event, toState, toParams, fromState, fromParams) {  
            angular.element('.navmenu').offcanvas('hide');
            
            if ((localStorageService.get('user') === null) && (toState.name !== 'auth')) {
              event.preventDefault();
              $state.go('auth');
            }
         });          
          
        angular.element($window).bind('resize', function () {
          angular.element('.navmenu').offcanvas('hide');
          $scope.$apply();
        });        
      }]);
})();