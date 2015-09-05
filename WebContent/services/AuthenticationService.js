/// <reference path="../resources/typings/angularjs/angular.d.ts"/>

'use strict';

app.factory('AuthService', ['$http', '$localStorage', '$location', function ($http, $localStorage, $location) {
	
	var sucessCallback = function (scope, response, messageOut) {
		console.log("Request sucess: " + response.data);
		if (response.data !== false) {
			scope.user = {};
			scope.user = angular.copy(response.data);
			$localStorage.user = angular.copy(scope.user);
		} else {
			scope.feedback = messageOut;
		}
	}
	
	var errorCallback = function (scope, error) {
		console.log(error);
		scope.feedback = "Falha ao tentar conectar com o servidor.";
	}	
	
	return {		
		signIn: function (scope) {
			$http.post(scope.SERVER_BASE_URL+'signIn', scope.user)
				.then(
					function (response) {
						sucessCallback(scope, response, "Usuário ou senha incorretos.");						
					},
					function (error) {
						errorCallback(scope, error);
					});
		},		
		signUp: function (scope) {
			$http.post(scope.SERVER_BASE_URL + 'signUp', scope.user)
				.then(
					function (response) {
						sucessCallback(scope, response, "Dados para cadastro inválidos.");						
					},
					function (error) {
						errorCallback(scope, error);
					});
		},
		isEmailAlreadyUsed: function (email) {
			return false;
		},
		logout: function(user) {
            user = {};
			delete $localStorage.token;
			$location.path('/auth');
        }
	}
}]);