document.getElementById('ajouter').addEventListener('click', function(event) {
    event.preventDefault();

    var index = document.getElementById('exercice_collection').children.length;

    // Créer un nouvel élément de formulaire pour un nouvel exercice
    var newExerciceForm = document.createElement('div');
    newExerciceForm.innerHTML = document.getElementById('exercice_prototype').dataset.prototype.replace(/__name__/g, index);
    document.getElementById('exercice_collection').appendChild(newExerciceForm);

    // Mettre à jour le prototype pour le prochain nouvel exercice
    document.getElementById('exercice_prototype').dataset.prototype = document.getElementById('exercice_prototype').dataset.prototype.replace(/__name__/g, index + 1);
});

document.getElementById('formExercice').addEventListener('submit', function(event) {
    // Soumettre le formulaire
});