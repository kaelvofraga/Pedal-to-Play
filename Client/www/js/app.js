/// <reference path="../libs/typings/angularjs/angular.d.ts"/>

(function () { 
  'use strict';

  angular.module('Pedal2Play', [
    'ui.router', 
    'ngMd5', 
    'LocalStorageModule', 
    'ngTouch'
  ]) 
  
  .controller('MainController', ['$rootScope', function ($rootScope){    
    $rootScope.appName = 'Pedal-to-Play';
    $rootScope.SERVER_BASE_URL = 
        //'http://localhost/Pedal-to-Play/Server/'; /* Development */
        'http://pedal2play.kaelfraga.com/'; /* Production */   
  }])
    
  .config(function ($stateProvider, $urlRouterProvider, $httpProvider) {
  
    $stateProvider
      .state('auth', {
          url: '/auth',
          templateUrl: 'partials/authentication.html',
          controller: 'AuthController',
          controllerAs: 'authCtrl'
      })
      .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'partials/menu.html',
        controller: 'MenuController',
        controllerAs: 'menuCtrl'
      })
      .state('app.home', {
        url: '/home',
        templateUrl: 'partials/menu.home.html',
        controller: 'HomeController',
        controllerAs: 'homeCtrl',
        data: { pageTitle: 'Pedal-to-Play' }         
      });
    
    $urlRouterProvider.otherwise('/app/home');
    
    $httpProvider.interceptors.push(['$q', '$location', 'localStorageService', function ($q, $location, localStorageService) {
      return {
        'request': function (config) {
          config.headers = config.headers || {};
          if (localStorageService.get('user')) {
            config.headers.Authorization = angular.toJson(localStorageService.get('user'));
            config.withCredentials = true;
          }
          return config;
        },
        'responseError': function (response) {
          if (response.status === 401) {
            $location.path('/auth');
          }
          return $q.reject(response);
        }
      };
    }]);    
  });
})();