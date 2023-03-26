
var PatientSearch = angular.module("patientSearchModule", []);

var patientSearchCtrlr = function($scope){

   $scope.patientCount = 15;
}

PatientSearch.controller("patientSearchController", patientSearchCtrlr);
