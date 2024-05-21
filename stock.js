function MAJstock() {
    var form = document.querySelector("form");
    var formData = new FormData(form);

    // Envoyer les données de la commande à passer_commande.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "passer_commande.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Stock mis à jour avec succès !");
        } else {
            console.error("Erreur lors de la mise à jour du stock :", xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error("Erreur lors de la mise à jour du stock : La requête n'a pas pu être effectuée.");
    };
    xhr.send(formData);
}
