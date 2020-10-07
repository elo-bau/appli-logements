<?php


namespace App\Models\Forms;

use App\Entity\Logement;
use Symfony\Component\Validator\Constraints as Assert;

class LogementCreateForm
{
    /**
     * @var string $name
     * @Assert\NotNull(message="The name attribute cannot be null")
     */
    public string $name;
    /**
     * @var float $price
     * @Assert\NotNull()
     * @Assert\GreaterThan(value="0")
     */
    public float $price;

    public static function toLogement(LogementCreateForm $form) {
        $logement = new Logement();
        $logement->setName($form->name);
        $logement->setPrice($form->price);

        return $logement;
    }
}

?>