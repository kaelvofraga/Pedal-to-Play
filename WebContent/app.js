/// <reference path="resources/typings/angularjs/angular.d.ts"/>

'use strict';

var app = angular.module('Pedal2Play', ['ui.router', 'ngMd5', 'ngStorage']);

app.controller('MainController', ['$scope', function ($scope) {
  $scope.appName = 'Pedal-to-Play';
  $scope.SERVER_BASE_URL = 'http://localhost/Pedal-to-Play/Server/';
}]);

app.config(function ($stateProvider, $urlRouterProvider, $httpProvider) {

  $stateProvider.state('auth', {
      url: "/auth",
      templateUrl: "partials/authentication.html",
      controller: "AuthController",
      controllerAs: "authCtrl"
   });
   
  $urlRouterProvider.otherwise("/auth");
   
  $httpProvider.interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {
    return {
      'request': function (config) {
        config.headers = config.headers || {};
        if ($localStorage.user) {
          config.headers.Authorization = $localStorage.user;
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