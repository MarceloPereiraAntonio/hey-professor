<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all the questions', function () {
    //Arrange :: Preparar
    //Criar algumas perguntas
    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();
    actingAs($user);
    //Act ::  Agir
    //acessar a rota

    $response = get(route('dashboard'));

    //Assent Verificar
    // verificar se a lista de perguntas esta sendo mostradas

    /** @var Question $q  */
    foreach($questions as $q) {

        $response->assertSee($q->question);
    }

});
