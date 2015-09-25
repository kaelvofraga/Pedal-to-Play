/// <reference path="../../libs/typings/angularjs/angular.d.ts"/>

(function () { 
  'use strict';
  
  angular.module('Pedal2Play')
    .controller('HomeController', ['$scope', 'GeoService', function ($scope, GeoService) 
    {
      var intervalId = setInterval(function () {
        GeoService.getCurrentPosition(function (position) {
          $scope.position = [
            { name: 'Latitude: ', value: position.coords.latitude },
            { name: 'Longitude: ', value: position.coords.longitude },
            { name: 'Altitude: ', value: position.coords.altitude },
            { name: 'Accuracy: ', value: position.coords.accuracy },
            { name: 'Altitude Accuracy: ', value: position.coords.altitudeAccuracy },
            { name: 'Heading: ', value: position.coords.heading },
            { name: 'Speed: ', value: position.coords.speed },
            { name: 'Timestamp: ', value: position.coords.timestamp }
          ];
        });
      }, 1000);
      
      $scope.$on('$destroy', function () {
        clearInterval(intervalId);
      });      
    }]);
})();