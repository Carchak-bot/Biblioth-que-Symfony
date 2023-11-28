$(document).ready(function() {
    // Fonction pour trier les livres par auteur
    $('#authorTri').change(function() {
        var selectedAuthor = $(this).val();
        console.log('Tri par auteur:', selectedAuthor);

        // Masquer tous les livres
        $('.livre').hide();

        // Afficher uniquement les livres de l'auteur sélectionné
        $('.livre[data-auteur="' + selectedAuthor + '"]').show();

        $('#categoryTri').val('none');
    $('#dateTri').val('none');
    $('#titreTri').val('none');
    });

    // Créer une liste unique d'auteurs
    var uniqueAuthors = {};
    $('.livre').each(function() {
        var author = $(this).data('auteur');
        uniqueAuthors[author] = true;
    });

    // Remplir le sélecteur d'auteurs
    var authorSelect = $('#authorTri');
    authorSelect.empty();
    authorSelect.append('<option value="none" selected disabled hidden>-- Please choose an option --</option>');
    for (var author in uniqueAuthors) {
        authorSelect.append('<option value="' + author + '">' + author + '</option>');
    }

    // Fonction pour trier les livres par catégorie
    $('#categoryTri').change(function() {
        var selectedCategory = $(this).val();
        console.log('Tri par catégorie:', selectedCategory);

        $('.livre').hide();
        $('.livre[data-categorie="' + selectedCategory + '"]').show();

        $('#authorTri').val('none');
        $('#dateTri').val('none');
        $('#titreTri').val('none');

    });

    // Fonction pour trier les livres par date
    $('#dateTri').change(function() {
        var selectedDate = $(this).val();
        console.log('Tri par date:', selectedDate);

        $('.livre').hide();
        $('.livre[data-date="' + selectedDate + '"]').show();

        $('#authorTri').val('none');
        $('#categoryTri').val('none');
        $('#titreTri').val('none');
    });

    // Fonction pour trier les livres par titre
    $('#titreTri').change(function() {
        var selectedTitle = $(this).val();
        console.log('Tri par titre:', selectedTitle);

        $('.livre').hide();
        $('.livre[data-titre="' + selectedTitle + '"]').show();

        $('#authorTri').val('none');
        $('#categoryTri').val('none');
        $('#dateTri').val('none');
    });

    // Créer une liste unique de catégories
    var uniqueCategories = {};
    $('.livre').each(function() {
        var category = $(this).data('categorie');
        uniqueCategories[category] = true;
    });

    // Remplir le sélecteur de catégories
    var categorySelect = $('#categoryTri');
    categorySelect.empty();
    categorySelect.append('<option value="none" selected disabled hidden>-- Please choose an option --</option>');
    for (var category in uniqueCategories) {
        categorySelect.append('<option value="' + category + '">' + category + '</option>');
    }

    // Créer une liste unique de dates
    var uniqueDates = {};
    $('.livre').each(function() {
        var date = $(this).data('date');
        uniqueDates[date] = true;
    });

    // Remplir le sélecteur de dates
    var dateSelect = $('#dateTri');
    dateSelect.empty();
    dateSelect.append('<option value="none" selected disabled hidden>-- Please choose an option --</option>');
    for (var date in uniqueDates) {
        dateSelect.append('<option value="' + date + '">' + date + '</option>');
    }

    // Créer une liste unique de titres
    var uniqueTitles = {};
    $('.livre').each(function() {
        var title = $(this).data('titre');
        uniqueTitles[title] = true;
    });

    // Remplir le sélecteur de titres
    var titleSelect = $('#titreTri');
    titleSelect.empty();
    titleSelect.append('<option value="none" selected disabled hidden>-- Please choose an option --</option>');
    for (var title in uniqueTitles) {
        titleSelect.append('<option value="' + title + '">' + title + '</option>');
    }
});
