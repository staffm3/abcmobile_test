<?php
$data = [
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'New York',
        'lat' => '40.7127753',
        'lng' => '-74.0059728',
    ],
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'Los Angeles',
        'lat' => '34.0522342',
        'lng' => '-118.2436849',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Manila',
        'lat' => '14.5995124',
        'lng' => '120.9842195',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Cebu',
        'lat' => '10.3156993',
        'lng' => '123.8854377',
    ]
];
class CSV
{
    private $array;
    public function __construct(array $array)
    {
        $this->array = $array;
    }
    private function drawCSVKeys()
    {
        $CSVText = "";
        $i = 0;
        $keys = array_keys($this->array[0]);
        foreach ($keys as $_ => $key) {
            $line = str_replace("_", " ", ucfirst($key));
            $line .= $i == count($keys) - 1
                ? " \n"
                : ", ";
            $CSVText .= $line;
            $i++;
        }
        return $CSVText;
    }
    private function drawCSVValues($CSVText)
    {
        $keys = array_keys($this->array[0]);
        foreach ($this->array as $_ => $country) {
            $j = 0;
            $line = "";
            foreach (array_values($keys) as $value) {
                $line .= !str_contains($country[$value], " ")
                    ? $country[$value]
                    : '"' . $country[$value] . '"';
                $line .= ($j != count($keys) - 1) ? ", " : "\n";
                $j++;
            }
            $CSVText .= $line;
        }
        return $CSVText;
    }
    private function drawCSV()
    {
        return $this->drawCSVValues($this->drawCSVKeys());
    }
    public function printCSV(): string|bool
    {
        if (count($this->array) == 0) {
            print("Array has no elements!");
            return false;
        }
        return $this->drawCSV();
    }
}
$CSV = new CSV($data);
echo "<pre>";
echo $CSV->printCSV();
echo "</pre>";