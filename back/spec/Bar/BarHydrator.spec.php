<?php
namespace Bar;

describe('BarHydrator', function() {
    beforeEach(function() {
        $this->barHydrator = new BarHydrator();
    });

    it('should extract a bar', function() {
        $bar = (new Bar())
            ->setId(1)
            ->setName('Un bar à Evry')
            ->setAddress('3 rue André Lalande');

        $data = $this->barHydrator->extract($bar);

        expect($data)->toEqual([
            'id' => 1,
            'name' => 'Un bar à Evry',
            'address' => '3 rue André Lalande',
        ]);
    });

    it('should extract a list of bars', function() {
        $bars = [
            (new Bar())
            ->setId(1)
            ->setName('Un bar à Evry')
            ->setAddress('3 rue André Lalande')
            ->addKeywords(['AAA']),
            (new Bar())
            ->setId(2)
            ->setName('Un bar à Grigny')
            ->setAddress('3 rue de l\'Elephant')
            ->addKeyword('AAA')
        ];

        $data = $this->barHydrator->extractAll($bars);

        expect($data)->toEqual([
            [
                'id' => 1,
                'name' => 'Un bar à Evry',
                'address' => '3 rue André Lalande',
                'keywords' => ['AAA']
            ],
            [
                'id' => 2,
                'name' => 'Un bar à Grigny',
                'address' => '3 rue de l\'Elephant',
                'keywords' => ['AAA']
            ]
        ]);
    });
});
