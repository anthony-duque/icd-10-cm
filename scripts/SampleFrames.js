SampleFrameModule = angular.module("SampleFrameModule", []);

const apiURL = "http://localhost/icd-10-cm/ReadCodesFromDB.php";

var SampleFrameController = function($scope, $http){

   //$scope.icdCodes
   $scope.GetCodes = function(){
      return $http.get(apiURL)
                  .then(function(response){
                     $scope.codes = '';
                     $scope.codes = response.data;
                  });
   }  // GetCodes()
   $scope.message = "something";

}  // SampleFrameController()

SampleFrameModule.controller("SampleFrameController", SampleFrameController);
