
var PatientSearch = angular.module("patientSearchModule", []);

var patientSearchCtrlr = function($scope){

   $scope.patientCount = 15;
   $scope.patientList = patientList;
   $scope.sortField = "+MRN";

   $scope.SortPatients = function(sortBy){

      switch($scope.sortOrder){

         case '+':
            $scope.sortOrder = '-';
            break;

         case '-':
            $scope.sortOrder = '+';
            break;

         default:
            $scope.sortOrder = '+';
            break;

      } // switch()

      $scope.sortField = $scope.sortOrder + sortBy;
   }  // SortPatients()

}  // patientSearchCtrlr()

PatientSearch.controller("patientSearchController", patientSearchCtrlr);
