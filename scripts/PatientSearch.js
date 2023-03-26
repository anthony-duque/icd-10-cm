
var PatientSearch = angular.module("patientSearchModule", []);

var patientSearchCtrlr = function($scope){

   $scope.patientCount = 15;
   $scope.patientList = patientList;

      // function that looks for a value in a list
   function search(source, searchField, searchValue) {

      var results = [];

      for (var i=0 ; i < source.list.length ; i++)
      {
          if (source.list[i][searchField] == searchVal) {
              results.push(source.list[i]);
          }
      }

      /// equivalent forEach version
      /*
      source forEach((record) => {
         if(record[searchField] == searchVal){
            results.push(record);
         }

      });
      */

       return results;
   }   // function search()

}

PatientSearch.controller("patientSearchController", patientSearchCtrlr);
