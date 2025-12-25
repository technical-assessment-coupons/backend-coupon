<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 0;

        $logos = [
            'https://www.svgrepo.com/show/353800/google-ads.svg',
            'https://upload.wikimedia.org/wikipedia/commons/8/88/Logo_neutral_de_Petr%C3%B3leos_Mexicanos_%28desde_1988%29.svg',
            'https://thumbs.dreamstime.com/b/meta-facebook-nuevos-vectores-de-logotipo-aislados-en-fondo-blanco-233359129.jpg',
            'https://thumbs.dreamstime.com/b/editorial-del-logo-de-uber-ilustrativo-sobre-fondo-blanco-icono-logotipo-vectores-logos-iconos-conjunto-medios-sociales-banner-210443791.jpg',
            'https://thumbs.dreamstime.com/b/didi-logo-editorial-ilustrativo-sobre-fondo-blanco-icono-vectorial-logotipos-iconos-conjunto-redes-sociales-banner-plano-vectores-210442544.jpg',
            'https://www.joopbox.com/wp-content/uploads/2017/12/aws-logo.png',
            'https://thumbs.dreamstime.com/b/ryzen-logo-editorial-ilustrativo-sobre-fondo-blanco-icono-vectorial-logotipos-conjunto-redes-sociales-banner-plano-vectores-svg-208332845.jpg',
            'https://www.cosmopol.com.mx/wp-content/uploads/2022/06/monkey_papas_cosmologos.jpg',
            'https://www.kindpng.com/picc/m/745-7453251_little-caesars-pizza-little-caesars-pizza-logo-png.png',
            'https://1000marcas.net/wp-content/uploads/2020/01/LG-simbolo-600x338.jpg',
        ];

        $images = [
            'https://agenciawinners.com/wp-content/uploads/2020/05/google-ads.jpg',
            'https://www.onexpo.com.mx/NOTICIAS/GASOLINERAS-DE-PEMEX-ESTA-ES-LA-ESTRATEGIA-QUE-INC_SyRQt/images/GASOLINERAS-DE-PEMEX-ESTA-ES-LA-ESTRATEGIA-QUE-INC_SyRQt.jpg',
            'https://network-king.net/wp-content/uploads/2023/05/AdobeStock_482385584_Editorial_Use_Only-769x415.jpeg',
            'https://turbologo.com/articles/wp-content/uploads/2019/12/Uber-car.png',
            'https://www.hoytamaulipas.net/lafoto/124714/DiDi-registra-conductores-en-Ciudad-Victoria.jpg',
            'https://cloudfront-us-east-1.images.arcpublishing.com/infobae/NI657F5TPRB4FIENQSWP6GZHZQ.webp',
            'https://i.blogs.es/e7ce7c/amd-tech-day-ryzen-9-4000h/650_1200.jpg',
            'https://monkeypapas.com/wp-content/uploads/2023/02/suc-foto3.webp',
            'https://www.laizquierdadiario.mx/IMG/arton147256.jpg',
            'https://imagenes.eleconomista.com.mx/files/webp_768_768/uploads/2018/09/24/66e47dba49c21.jpeg',
        ];

        $logo  = $logos[$index % count($logos)];
        $image = $images[$index % count($images)];

        $index++;
        return [
            'logo'  => $logo,
            'nombre' => $this->faker->company(),
            'promo' => $this->faker->sentence(),
            'imagen' => $image,
        ];
    }
}
