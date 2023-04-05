var ICDcodeTreeModule = angular.module("ICDcodeTreeModule", []);

var ICDcodeTreeController = function($scope){
   $scope.message = "icd";
   $scope.icd_codes = icd_codes.children;
};

ICDcodeTreeModule.controller("ICDcodeTreeController", ICDcodeTreeController);
