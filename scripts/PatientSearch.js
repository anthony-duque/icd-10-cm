
var PatientSearch = angular.module("patientSearchModule", []);

var patientSearchCtrlr = function($scope, $http){

   $scope.patientCount = 15;
   //$scope.patientList = patientList;
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

   $scope.GetPatients = function(){
      $http.get('./php/Patient.php')
            .then(function(response) {
                     if (response.data){
                        console.log("Patient Records fetched successfully!");
                        $scope.patientList = response.data;
                        console.log(response.data);
                     }
                  },
                  function(response) {
                     console.log("Service does not Exists");
                     console.log(response.status);
                     console.log(response.statusText);
                     console.log(response.headers());
                  }
            );   // .then()
   }     // GetPatients()

   $scope.GetPatients();

}  // patientSearchCtrlr()

PatientSearch.controller("patientSearchController", patientSearchCtrlr);
