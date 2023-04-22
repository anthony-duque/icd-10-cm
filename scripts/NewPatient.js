var NewPatientModule = angular.module("NewPatientModule", []);

var NewPatientController = function($scope, $http){

   var patient = {
      firstName : 'Enter First Name',
      lastName : 'Enter Last Name',
      gender : '',
      birthDate : ''
   };

   $scope.patient = patient;

   $http.delete('Restful.php', JSON.stringify(patient))
         .then(function(response) {
                  if (response.data)
                     console.log("Post Data Submitted Successfully!");
                     console.log(response.data);
               },
               function(response) {
                  console.log("Service does not Exists");
                  console.log(response.status);
                  console.log(response.statusText);
                  console.log(response.headers());
               }
         );   // .then()
}

NewPatientModule.controller("NewPatientController", NewPatientController);
