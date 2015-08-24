/// <reference path="../resources/typings/angularjs/angular.d.ts"/>

'use strict';

app.factory('AuthService', ['$http', function ($http) {
	return {
		signIn: function (scope) {
			console.log("Sing In");
			/*$http.post('localhost/Pedal-to-Play/Server/AuthenticationService.php', scope.user)
				.then(
					// Sucess
					function (response) {
						console.log("Request sucess: " + response.data);
						//scope.user = response.data;
						scope.feedback = "Login realizado com sucesso.";
					},
					// Fail 
					function (error) {
						console.log(error);
						scope.feedback = "Falha ao tentar realizar o login.";
					});*/
		},		
		signUp: function (scope) {
			console.log("Sing Up");
		},
		isEmailAlreadyUsed: function (email) {
			return false;
		}
	}
}]);