SampleFrameModule = angular.module("SampleFrameModule", []);

const apiURL = "http://localhost/icd-10-cm/php/ReadCodesFromDB.php";

var SampleFrameController = function($scope, $http){

   $scope.icdCodes = icdCodes;      // icdCodes is defined in getCodes.js
                                    // Note: should be converted into a
                                    //    angular factory eventually

   $scope.PatientCodes = patientCodes;

/*
   $scope.GetCodes = function(){
      return $http.get(apiURL)
                  .then(function(response){
                     $scope.codes = '';
                     $scope.codes = response.data;
                  });
   }  // GetCodes()
*/


   $scope.message = "something";

}  // SampleFrameController()

SampleFrameModule.controller("SampleFrameController", SampleFrameController);
