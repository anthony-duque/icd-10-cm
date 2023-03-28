
    // Create the module
var modHelloWorld = angular.module('HelloWorldModule', []);

    // Controller function
var helloWorldCtrlr = function ($scope, $http){

   $scope.icdCodes = icdCodes;

    $scope.message = "Hello World!";
    $scope.keywordsUsed = [];
    var patient = {
        mrn: "1056481663642",
        firstName : "David",
        lastName : "Miscavige",
        birthDate:   "01/23/1965",
        gender : "M"
    };

    $scope.patient = patient;

    var stuSrcAPI = 'https://clinicaltables.nlm.nih.gov/api/icd10cm/v3/search?sf=code,name&terms=';

    $scope.GetCodes = function(){    // Button functionality to fetch students

      //$scope.keyWord = "cancer";
        var strAPI = stuSrcAPI + $scope.keyWord;
        $scope.keywordsUsed.push($scope.keyWord)
        return $http.get(strAPI)
                .then(function(response){
                        $scope.codes = '';
                        $scope.codes = response.data;
                });
        }

}
    // Register the controller function with the module
    modHelloWorld.controller("HelloWorldController", helloWorldCtrlr);
