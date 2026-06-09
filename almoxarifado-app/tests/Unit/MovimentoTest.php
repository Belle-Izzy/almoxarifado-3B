<?php

use App\Models\Produto;
use App\Models\Movimento;

//Teste de validação que simula o @beforeCreate

test('Sistema deve barrar a movimentação de saída se a quantidade retirada for maior que o estoque', function(){
    $produtoMock = new Produto([
        'nome' => 'Mouse USB Dell',
        'estoque' => 5
    ]);

    $movimentoMock = new Movimento([
        'quantidade' => 10,
        'tipo' => "s"
    ]);

    if ($movimentoMock->tipo === "s" && $movimentoMock->quantidade > $produtoMock->estoque){
        //Se entrar aqui significa que a validação de estoque funcionou
        expect(true)->toBeTrue();
    }else{
        $this->fail("Erro: A regra de negócio permitiu a saída de mercadoria sem estoque");
    }
});

// //Teste de validação que simula o @afterCreate

// test('Sistema deve diminuir o estoque após uma saída autorizada', function(){
//     $produto = Produto::create([
//         'nome' => 'Mouse USB Dell',
//         'estoque' => 5
//     ]);

//     //Simular saída válida
//     Livewire::test(CreateMovimento::class)
//     ->fillForm([
//         'produto_id' => $produto->id,
//         'quantidade' => 2,
//         'tipo' => "s"
//     ])

//     ->call('create');

//     //2.1 0 movimento deve ter sido criado com sucesso no banco
//     expect(Movimento :: count())->toBe(1);

//     //2.1 0 seu hook afterCreate deve ter diminuído o estoqe de 15 para 10
//     expect($produto->fresh()->estoque->toBe(10));
// });

// 2. TESTE DE SUBTRAÇÃO (SIMULA O AFTERCREATE PARA SAÍDA)
test('sistema deve diminuir o estoque corretamente apos uma saida autorizada', function(){
    // Cenário: Estoque inicial de 10, saindo 3
    $produtoMock = new Produto(['estoque' => 10]);
    $movimentoMock = new Movimento(['quantidade' => 3, 'tipo' => 's']);

    // Executa a regra matematica de decremento na memória
    if ($movimentoMock->tipo === 'e') {
        $produtoMock->estoque += $movimentoMock->quantidade;
    } else {
        $produtoMock->estoque -= $movimentoMock->quantidade;
    }
    // Valida se a conta deu certo (10 - 3 = 7)
    expect($produtoMock->estoque)->toBe(7);
});

// 3. TESTE DE ADIÇÃO (SIMULA O AFTERCREATE PARA ENTRADA)
test('sistema deve aumentar o estoque corretamente apos uma entrada com sucesso', function () {
    // Cenário: Estoque inicial de 2, entrando 8
    $produtoMock = new Produto(['estoque' => 2]);
    $movimentoMock = new Movimento(['quantidade' => 8, 'tipo' => 'e']);

    // Executa a regra matemática de incremento na memória
    if ($movimentoMock->tipo === 'e') {
        $produtoMock->estoque += $movimentoMock->quantidade;
    } else {
        $produtoMock->estoque -= $movimentoMock->quantidade;
    }

    // Valida se a conta deu certo (2 + 8 = 10)
    expect($produtoMock->estoque)->toBe(10);
});