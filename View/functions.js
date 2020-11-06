$(function(){
    //controler la présence de l'élément .confirm
    if($('.confirm').length > 0){
        $('.confirm').on('click',function(){
            return (confirm('Etes-vous certain(e) de vouloirsupprimer cet employé ?'));

        });
    }


});




