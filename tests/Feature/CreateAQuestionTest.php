<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('shoul be able create a new question bigger than 255 characters', function () {
    //Arrange :: Preparar

    $user = User::factory()->create();
    actingAs($user);

    //Act ::  Agir

    $request = post(route('question.store'), [
        'question'    => str_repeat('*', 260) . '?',
        'outro-campo' => 'okokokok',
    ]);

    //Assent Verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);

});

it('should check if ends with questions mark ?', function () {

    //Arrange :: Preparar

    $user = User::factory()->create();
    actingAs($user);

    //Act ::  Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),

    ]);

    //Assent Verificar
    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question ? It is missing the question mark in the end.']);
    assertDatabaseCount('questions', 0);

});

it('Should have at least 10 characters', function () {

    //Arrange :: Preparar

    $user = User::factory()->create();
    actingAs($user);

    //Act ::  Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    //Assent Verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);

});
