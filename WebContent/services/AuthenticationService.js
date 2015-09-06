/// <reference path="../resources/typings/angularjs/angular.d.ts"/>

'use strict';

app.factory('AuthService', ['$rootScope', '$http', '$localStorage', '$location', '$q', 
				   function ($rootScope, $http, $localStorage, $location, $q) {
	
	var sucessCallback = function (scope, response, messageOut) {
		if (response.data !== false) {
			scope.user = {};
			scope.user = angular.copy(response.data);
			$localStorage.user = angular.copy(scope.user);
		} else {
			scope.errorMessage = messageOut;
		}
	}
	
	var errorCallback = function (scope, error) {
		console.log(error);
		scope.errorMessage = "Falha ao tentar conectar com o servidor.";
	}	
	
	return {		
		signIn: function (scope) {
			$http.post($rootScope.SERVER_BASE_URL+'signIn', scope.user)
				.then(
					function (response) {
						sucessCallback(scope, response, "Usuário ou senha incorretos.");						
					},
					function (error) {
						errorCallback(scope, error);
					});
		},		
		signUp: function (scope) {
			$http.post($rootScope.SERVER_BASE_URL + 'signUp', scope.user)
				.then(
					function (response) {
						sucessCallback(scope, response, "Dados para cadastro inválidos.");						
					},
					function (error) {
						errorCallback(scope, error);
					});
		},
		isValidEmail: function (email) {
			return $http.get($rootScope.SERVER_BASE_URL + 'validateEmail/' + email)
				.then(
					function (response) {
						if (response.data) {
							return true;
						}
						return $q.reject();
					},
					function (error) {
						console.log(error);
						return $q.reject();
					});
		},
		logout: function(user) {
            user = {};
			delete $localStorage.token;
			$location.path('/auth');
        }
	}
}]);