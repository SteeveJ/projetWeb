"use strict";
$(document).ready(function(){
    // on cache la section questions
    $('#questions').toggle();
    $('#response').toggle();

    /**
     * bubbling
     */
    const topics = $('#topics');

    /**
     * On crée l'évènement clic des futures bouton
     * de la div #topics qui seront ajouté après
     * le chargement des questions.
     */
    topics.on('mousedown', function(event) {
        // On récupère l'id du sujet (bubbling) (vanilla)
        const idTopic = event.target.getAttribute("data-id");
        // On affiche le titre du sujte
        $('#topic').html(event.target.getAttribute("data-name"));
        // On récupère les question du topic et on charge le jeu
        loadQuestion(idTopic).then(function(q){
            setQuestionsOfTopic(q);
            topics.toggle();
            $('#questions').toggle();
            initGame();
        });

    });

    $("#next").on('mousedown', function () {
        $('#questions').toggle();
        $('#response').toggle();
        nextQuestion();
    });

    /**
     * Chargement des questions de manière asynchrone
     */
    loadTopics().then(function(q){
        // On compte le nombre de propriété de l'objet
        const numberElement = q.length;
        console.log(numberElement);
        /**
         * On affiche les sujets des questions dans la div de #topics
         */
        for(let i = 0; i < numberElement; i++) {
            topics.append(
                "<button type='button' class='btn btn-primary btn-block' data-id='"+
                q[i].id_topic
                +"' data-name='" +
                q[i].name+"'>"+
                q[i].name
                +"</button>"
            );
        }
        //loadMap();
    }); // Fin du bloc de chargement des question
});