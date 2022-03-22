<?php

use App\Product;
use Illuminate\Database\Seeder;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // OJO aqui se usa el seeder de products para llamar el factory de Category.
    public function run()
    {
        // 26 0:0
        /* otra forma mas sofisticada de poblar datos en sig bloque
            factory(Category::class,5)->create();
            factory(Product::class,100)->create();
            factory(ProductImage::class,200)->create();
        */
 
            // 28 0:0
            // 1.- creamos 5 categorias
            $categories = factory(Category::class, 4)->create();

            // 2.- para cada categoria se aplica la funcion each() asignandole 20
            //      nuevos productos.
            $categories->each(function($category){
                // el metodo make() crea los objetos solo en memoria sin salvarlos a la base.
                $products = factory(Product::class,5)->make();
                // ojo el saveMany() es x q se salva mas de una producto.
                $category->products()->saveMany($products);
                
                // 3.- para cada producto asignando a una categoria se aplica funcion each()
                //      para asignarle imagenes.
                $products->each(function($p){
                    $images = factory(ProductImage::class,3)->make();
                    // ojo el saveMany() es x q se salva mas de una imagen.
                    $p->images()->saveMany($images);
                });
            });


    }// end run()
}
