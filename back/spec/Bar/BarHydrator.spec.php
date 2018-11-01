<?php
namespace Bar;

describe('BarHydrator', function() {
    beforeEach(function() {
        $this->barHydrator = new BarHydrator();
    });

    it('should extract a list of bars', function() {
        $bars = [
            (new Bar())
            ->setId(1)
            ->setName('Un bar à Evry')
            ->setAddress('3 rue André Lalande')
            ->addKeywords(['toto', 'tata', 'tutu'])
            ->setRating('4.5')
            ->setLng('4.43')
            ->setLat('9.12')
            ->setPhoto('photo'),
            (new Bar())
            ->setId(2)
            ->setName('Un bar à Grigny')
            ->setAddress('3 rue de l\'Elephant')
            ->addKeywords(['bobo', 'baba', 'bubu'])
            ->setRating('1.3')
            ->setLng('1.298')
            ->setLat('5.285')
            ->setPhoto('otherPhoto')
        ];

        $data = $this->barHydrator->extractAll($bars);

        expect($data)->toEqual([
            [
                'id' => 1,
                'name' => 'Un bar à Evry',
                'address' => '3 rue André Lalande',
                'keywords' => ['toto', 'tata', 'tutu'],
                'rating' => '4.5',
                'photoreference' => 'photo',
                'lat' => '9.12',
                'lng' => '4.43'
            ],
            [
                'id' => 2,
                'name' => 'Un bar à Grigny',
                'address' => '3 rue de l\'Elephant',
                'keywords' => ['bobo', 'baba', 'bubu'],
                'rating' => '1.3',
                'photoreference' => 'otherPhoto',
                'lat' => '5.285',
                'lng' => '1.298'
            ]
        ]);
    });
});
