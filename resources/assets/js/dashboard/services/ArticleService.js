angular.module('ArticleService',[]).factory('Article',['$resource',
    function($resource){
        return $resource('article/:articleId',{
            articleId:'@id'
        },{
            update:{
                method:'PUT'
            }
        });
    }
]);