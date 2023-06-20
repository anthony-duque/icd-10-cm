var NewPatientModule = angular.module("NewPatientModule", []);

var NewPatientController = function($scope, $http){

   $scope.patient = {
      firstName : '',
      lastName : '',
      gender : '',
      birthDate : '',
      mrn : ''
   };

   $scope.SendData = function(patient){
      $http.post('./php/Patient.php', JSON.stringify(patient))
            .then(function(response) {
                     if (response.data){
                        console.log("Patient Record created successfully!");
                        alert("Patient Record created!");
                        window.location.href = 'PatientSearch.html';
                        //console.log(response.data);
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
