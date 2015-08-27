/// <reference path="resources/typings/angularjs/angular.d.ts"/>

'use strict';

var app = angular.module('Pedal2Play', ['ui.router', 'ngMd5']);

app.controller('MainController', ['$scope', function ($scope) {
  $scope.appName = 'Pedal-to-Play';
}]);

app.config(function ($stateProvider, $urlRouterProvider) {
  //
  // For any unmatched url, redirect to /love
  $urlRouterProvider.otherwise("/auth");
  //
  // Now set up the states
  $stateProvider
    .state('auth', {
      url: "/auth",
      templateUrl: "partials/authentication.html",
      controller: "AuthController",
      controllerAs: "authCtrl"
    });
});