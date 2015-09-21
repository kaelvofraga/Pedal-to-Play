/// <reference path="../libs/typings/angularjs/angular.d.ts"/>

(function () { 
  'use strict';

  angular.module('Pedal2Play', ['ui.router', 'ngMd5', 'ngStorage', 'ngTouch', 
                                'authControllers', 'mainControllers'])
   
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
        controller: 'MainController',
        controllerAs: 'mainCtrl'
      })
      .state('app.home', {
        url: '/home',
        templateUrl: 'partials/menu.home.html'  
      });
    
    $urlRouterProvider.otherwise('/app/home');
    
    $httpProvider.interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {
      return {
        'request': function (config) {
          config.headers = config.headers || {};
          if ($localStorage.user) {
            config.headers.Authorization = angular.toJson($localStorage.user);
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