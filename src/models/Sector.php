<?php

namespace App\models;

class Sector
{
    private ?int $id;
    private string $sectorTitle;

    public function __construct(?int $sectorId, string $sectorTitle)
    {
        $this->id = $sectorId;
        $this->sectorTitle = $sectorTitle;
    }

    /**
     * @return string
     */
    public function getSectorTitle(): string
    {
        return $this->sectorTitle;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return "Sector ID: " . $this->id . ", Sector Name: " . $this->sectorTitle;
    }

    public function getSectorIndentation(): string
    {
        $sectors = [
            'Manufacturing' => 0,
            'Construction materials' => 1,
            'Electronics and Optics' => 1,
            'Food and Beverage' => 1,
            'Bakery and confectionery products' => 2,
            'Beverages' => 2,
            'Fish and fish products' => 2,
            'Meat and meat products' => 2,
            'Milk and dairy products' => 2,
            'Sweets and snack food' => 2,
            'Furniture' => 1,
            'Bathroom/sauna' => 2,
            'Bedroom' => 2,
            'Children’s room' => 2,
            'Kitchen' => 2,
            'Living room' => 2,
            'Office' => 2,
            'Other (Furniture)' => 2,
            'Outdoor' => 2,
            'Project furniture' => 2,
            'Machinery' => 1,
            'Machinery components' => 2,
            'Machinery equipment/tools' => 2,
            'Manufacture of machinery' => 2,
            'Maritime' => 1,
            'Aluminium and steel workboats' => 2,
            'Boat/Yacht building' => 2,
            'Ship repair and conversion' => 2,
            'Metal structures' => 2,
            'Repair and maintenance service' => 2,
            'Metalworking' => 1,
            'Construction of metal structures' => 2,
            'Houses and buildings' => 2,
            'Metal products' => 2,
            'Metal works' => 2,
            'CNC-machining' => 3,
            'Forgings, Fasteners' => 3,
            'Gas, Plasma, Laser cutting' => 3,
            'MIG, TIG, Aluminum welding' => 3,
            'Plastic and Rubber' => 1,
            'Packaging' => 2,
            'Plastic goods' => 2,
            'Plastic processing technology' => 2,
            'Blowing' => 3,
            'Moulding' => 3,
            'Plastics welding and processing' => 3,
            'Plastic profiles' => 2,
            'Printing' => 1,
            'Advertising' => 2,
            'Book/Periodicals printing' => 2,
            'Labelling and packaging printing' => 2,
            'Textile and Clothing' => 1,
            'Clothing' => 2,
            'Textile' => 2,
            'Wood' => 1,
            'Wooden building materials' => 2,
            'Wooden houses' => 2,
            'Other' => 0,
            'Creative industries' => 1,
            'Energy technology' => 1,
            'Environment' => 1,
            'Service' => 0,
            'Business services' => 1,
            'Engineering' => 1,
            'Information Technology and Telecommunications' => 1,
            'Data processing, Web portals, E-marketing' => 2,
            'Programming, Consultancy' => 2,
            'Software, Hardware' => 2,
            'Telecommunications' => 2,
            'Tourism' => 1,
            'Translation services' => 1,
            'Transport and Logistics' => 1,
            'Air' => 2,
            'Rail' => 2,
            'Road' => 2,
            'Water' => 2
        ];
        return str_repeat('&nbsp;', $sectors[$this->getSectorTitle()] * 4);
    }
}
