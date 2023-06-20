SampleFrameModule = angular.module("SampleFrameModule", []);

const apiURL = "http://localhost/icd-10-cm/php/ReadCodesFromDB.php";

var SampleFrameController = function($scope, $http){

   $scope.icdCodes = icdCodes;      // icdCodes is defined in getCodes.js
                                    // Note: should be converted into a
                                    //    angular factory eventually

   $scope.PatientCodes = patientCodes;
   $scope.dataStillLoading = true;

   $scope.GetCodes = function(){
      return $http.get(apiURL)
                  .then(function(response){
                     $scope.icdCodes = '';
                     $scope.icdCodes = response.data;
                  })
                  .finally(function(){
                     $scope.dataStillLoading = false;
                  });
   }  // GetCodes()

   //$scope.GetCodes();

}  // SampleFrameController()

SampleFrameModule.controller("SampleFrameController", SampleFrameController);
