
var PatientSearch = angular.module("patientSearchModule", []);

var patientSearchCtrlr = function($scope){

   $scope.patientCount = 15;
   $scope.patientList = patientList;
}

PatientSearch.controller("patientSearchController", patientSearchCtrlr);
