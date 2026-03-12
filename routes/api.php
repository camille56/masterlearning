<?php

use Illuminate\Support\Facades\Route;

//Peut renvoyer de l'html directement ou du json
//return "<h1>Blog</h1>";
//['article'=>"article 1"];

Route::get('/', function () {
    return view('welcome');
});


Route::get('/blog', function () {
    return "<h1>Blog</h1>";
})->name('blog');

/**
 * Route de test
 */
//On peut récuperer un paramètre DE TYPE \Illuminate\Http\Request
Route::get("/blog/{id}", function (\Illuminate\Http\Request $request) {
    //On peut lui demander plein de chose à Request:
    //$return= "Article numer: ". $request->$id;
    //ou lui demander l'ensemble des paramètres  de l'url sous forme de tableau:
    $return = $request->all();
    $nom=$return["nom"];
    //Ou on peut demander a request un input en particulier avec une valeur par defaut si null;
    $nom2=$request->input("nom", "jacky");
    //donc voir la doc de Request!

    return $return;
});

/**
 * Route avec slug et id
 * Pour récuperer le slug et l'id d'une url on va les définir en paramètre de la fonction
 * On pourrait également récupérer un paramètre de l'url en passant Request dans les param de la fonction comme
 * pour l'exemple précédent et l utiliser dans le tableau $return.
 */

Route::get("/blogtest/{slug}-{id}", function (string $slug, string $id) {
    //on va retourner directement un json pour cet exemple:
    $return=[
        "slug"=>$slug,
        "id"=>$id
    ];
    return $return; //affiche json slug: "coucou" id: "2" avec l'url: http://127.0.0.1:8000/blogtest/coucou-2

    //On peut également ajouter des contraintes sur les paramètres avec une regex
    //exemple ici, l'id sera forcement un nombre et le slug forcement une chaine de caractère en minuscule
})->where(['id' => '[0-9]+', 'slug' => '[a-z]+']);

/**
 * Si on souhaite à partir d'un blog, redirigier vers un article en particulier,
 * Soit on peut le faire en dur comme la premiere méthode
 * Soit on peut utiliser un lien nommé comme la seconde méthode
 */
Route::get("/blogTEstTest", function (string $slug, string $id  ) {
    //Méthode numéro1
//    $return=[
//        "link"=>/blog/".$slug."/".$id;
//    ];
    //méthode 2 plus efficace
    return [
//        "link"=>\route("blog", ); //ici on peut faire référence à la route nommée "blog" définie sur notre premiere route

        //ici on appelle sa propore route donc inutile masi c ets pour l'exemple du seconde paramètre qui ets un tableua contenant les paramètre utile
        "link"=>\route("blog.show", ["slug"=>$slug, "id"=>$id])

    ];
})->name("blog.show");


/**
 * On peut utiliser des préfix pour regrouper des routes qui ont une partie d'url en commun
 * Cela permet de ne pas répéter la partie "blog" dans chaque route
 */
Route::prefix('superblog')->group(function () {
    //on regroupera les differentes routes dans cette fonction callback
    Route::get("/{id}",function ( string $id) {
        return "l'url de cette route est /superblog/".$id;
    });
});

/**
 * On peut aussi ajouter des préfix sur les name des routes pour les regrouper
 * On reprend l exemple du superblog
 *
 * Le nom de la route sera labelleroute.show et on pourra faire référence à cette route avec ce nom dans les liens nommés
 */
Route::prefix('superblog')->name("labelleroute.")->group(function () {
    //on regroupera les differentes routes dans cette fonction callback
    Route::get("/{id}",function ( string $id) {
        return "l'url de cette route est /superblog/".$id;
    });
})->name("show");
