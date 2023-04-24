var NewPatientModule = angular.module("NewPatientModule", []);

var NewPatientController = function($scope, $http){

   $scope.patient = {
      firstName : 'Enter First Name',
      lastName : 'Enter Last Name',
      gender : '',
      birthDate : '',
      mrn : 'Enter MRN'
   };

   $scope.SendData = function(patient){
      $http.post('./php/Patient.php?id=100', JSON.stringify(patient))
            .then(function(response) {
                     if (response.data){
                        console.log("Post Data Submitted Successfully!");
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
   }     // SendData()
}  // NewPatientController()

NewPatientModule.controller("NewPatientController", NewPatientController);
