<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{country}/{city}', name: 'app_weather', requirements: ['id' => '\d+'])]
    public function city(
        #[MapEntity(mapping: ['country' => 'country', 'city' => 'city'])]
        Location $location,
        MeasurementRepository $repository,
    ): Response
    {
        $measurements = $repository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurement' => $measurements,
        ]);
    }
}
