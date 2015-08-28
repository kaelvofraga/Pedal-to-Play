/// <reference path="../resources/typings/angularjs/angular.d.ts"/>

'use strict';

app.controller('AuthController', ['AuthService', '$scope', 'md5', function (AuthService, $scope, md5) {
  $scope.isRegistering = false;
  $scope.user = {};
  $scope.confirmPassword;
  $scope.temporaryPassword;
  $scope.feedback = '';

  this.changeOperation = function () {
    $scope.isRegistering = !$scope.isRegistering;
    $scope.authForm.$setPristine();
    $scope.authForm.$setUntouched();
    $scope.user.password = "";
    $scope.confirmPassword = "";
    $scope.temporaryPassword = "";
  }

  this.signUser = function () {
    $scope.user.password = md5.createHash($scope.temporaryPassword);
    if ($scope.isRegistering) {
      AuthService.signUp($scope); //call register service
    } else {
      AuthService.signIn($scope); //call login service
    }
  }
}]);

app.directive('passwordValidator', function () {
  return {
    require: 'ngModel',
    link: function (scope, elm, attrs, ctrl) {
      ctrl.$validators.comparePasswords = function (modelValue, viewValue) {
        if (ctrl.$isEmpty(modelValue)) {
          // consider empty models to be valid
          return true;
        }
        if (scope.user.password === modelValue) {
          return true;
        }
        return false;
      };
    }
  };
});

app.directive('emailValidator', ['AuthService', function (AuthService) {
  return {
    require: 'ngModel',
    link: function (scope, elm, attrs, ctrl) {
      ctrl.$validators.isEmailAlreadyUsed = function (modelValue, viewValue) {
        if (ctrl.$isEmpty(modelValue)) {
          // consider empty models to be valid
          return true;
        }
        return !AuthService.isEmailAlreadyUsed(modelValue);
      };
    }
  };
}]);