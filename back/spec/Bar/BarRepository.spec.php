<?php
namespace Bar;

describe('BarRepository', function() {
    it('should fetch all bars', function() {
        $barRepository = new BarRepository(new MockPDO(), new BarHydrator());

        $bars = $barRepository->fetchAll();

        expect(sizeof($bars))->toBe(2);

        expect($bars[0]->getId())->toBe(1);
        expect($bars[0]->getName())->toBe('Un bar à Evry');
        expect($bars[0]->getAddress())->toBe('3 rue André Lalande');
        // expect($bars[0]->getKeywords())->toBe(['AAA']);

        expect($bars[1]->getId())->toBe(2);
        expect($bars[1]->getName())->toBe('Un bar à Grigny');
        expect($bars[1]->getAddress())->toBe('3 rue de l\'Elephant');
    });
});

class MockPDO {
    public function query() {
        return $this;
    }
    public function fetchAll() {
        return [
            (new Bar())
            ->setId(1)
            ->setName('Un bar à Evry')
            ->setAddress('3 rue André Lalande'),
            // ->addKeyword('AAA'),
            (new Bar())
            ->setId(2)
            ->setName('Un bar à Grigny')
            ->setAddress('3 rue de l\'Elephant')
        ];
    }
}
