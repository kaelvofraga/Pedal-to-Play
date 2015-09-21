/// <reference path="../../libs/typings/angularjs/angular.d.ts"/>

(function () { 
  'use strict';
  
  angular.module('homeControllers', [])
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
          console.log('Latitude: '              + position.coords.latitude          + '\n' +
                      'Longitude: '             + position.coords.longitude         + '\n' +
                      'Altitude: '              + position.coords.altitude          + '\n' +
                      'Accuracy: '              + position.coords.accuracy          + '\n' +
                      'Altitude Accuracy: '     + position.coords.altitudeAccuracy  + '\n' +
                      'Heading: '               + position.coords.heading           + '\n' +
                      'Speed: '                 + position.coords.speed             + '\n' +
                      'Timestamp: '             + position.timestamp                + '\n');
        });
      }, 1000);
      
      $scope.$on('$destroy', function () {
        clearInterval(intervalId);
      });      
    }]);
})();