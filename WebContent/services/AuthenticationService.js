/// <reference path="../resources/typings/angularjs/angular.d.ts"/>

'use strict';

app.factory('AuthService', ['$http', function ($http) {
	return {
		signIn: function (scope) {
			$http.post('localhost/Pedal-to-Play/Server/AuthenticationService.php', scope.user)
				.then(
					// Sucess
					function (response) {
						console.log("Request sucess: " + response.data);
						if (response.data !== false) {
							scope.user = response.data;
							scope.feedback = "Login realizado com sucesso.";
						} else {
							scope.feedback = "Login inválido.";	
						}						
					},
					// Fail 
					function (error) {
						console.log(error);
						scope.feedback = "[Login] Falha ao tentar conectar com o serviço.";
					});
		},		
		signUp: function (scope) {
			console.log("Sing Up");
		},
		isEmailAlreadyUsed: function (email) {
			return false;
		}
	}
}]);