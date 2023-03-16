var stuSrcAPI = "https://clinicaltables.nlm.nih.gov/api/icd10cm/v3/search?sf=code,name&terms=";

$scope.GetStudents = function(fwdBwd){    // Button functionality to fetch students

    var strAPI = stuSrcAPI + $scope.keyWord;

    return $http.get(strAPI)
               .then(function(response){
                    $scope.codes = '';
                    $scope.codes = response.data;
               });
