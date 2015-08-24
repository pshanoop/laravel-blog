app.controller('DashboardController',function($scope,$http,Article){

    //Pagination configuration
    $scope.maxSize = 5;
    $scope.numPerPage = 5;
    $scope.currentPage = '1';


    $scope.isEdit = false;
    $scope.isError= false;

    $scope.newarticle = {}; // Edit/New panel model
    $scope.curArticle = {}; // Currently selected article model
    $scope.errors = [];

    //Load all articles.
    Article.query(function(data){
        $scope.articles = data;
    },function(error){
        console.log(error);
        alert('Loading data failed.');
    });

    //Shows validation errors
    function errorHandler(error){
        $scope.isError=true; //Show validator error
        angular.forEach(error.data,function(key,value){
            $scope.errors.push(value + ': ' + key);
        });
    }

    //Open New panel
    $scope.newArticle   = function(article){
        $scope.isEdit=true;
        $scope.isError=false;
        //Initialize with Article resource
        $scope.newarticle = new Article();
    };

    //Open Edit panel with data on edit button click
    $scope.editArticle  = function(article){
        $scope.isEdit=true;
        $scope.isError=false;
        // Store selected data for future use
        $scope.curArticle = article;
        //Copy data to panel
        $scope.newarticle = angular.copy(article);
    };

    //Update and New article
    $scope.addArticle = function(article){

        //TODO error handling on requests
        //Check if update or new
        if($scope.curArticle.id){
            //Send put resource request
            article.$update(function(data){
                // Update values to selected article
                angular.extend($scope.curArticle,$scope.curArticle,data);
                //Hide edit/new panel
                $scope.isEdit = false;
            },errorHandler);

        }else{
            //Send post resource request
            article.$save(function(data){
                //Add newly add article to articles json
                $scope.articles.push(data);

                //Hide edit/new panel
                $scope.isEdit = false;
            },errorHandler);
        }
        //Remove old values
        //$scope.newarticle = new Article();
    };

    //Delete button
    $scope.deleteArticle = function(article){
        if(confirm('Are you sure ?')){
            article.$delete(function(data){
                alert(data.msg);

                //Get selected article index then remove from articles json
                var curIndex = $scope.articles.indexOf(article);
                $scope.articles.splice(curIndex,1);
            },function(error){
                alert('Item not deleted');
                console.log(error);
            });

        }
    };

    //Cancel panel button
    $scope.cancelArticle = function(article){
        $scope.isEdit=false;
        $scope.isError=false;

        //Remove old values
        $scope.newarticle= new Article();
    };

});