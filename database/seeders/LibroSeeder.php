<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;

class LibroSeeder extends Seeder
{
    public function run()
    {
        $libros = [
            ["titulo" => "Cien años de soledad", "autor" => "Gabriel García Márquez", "imagen" => "https://covers.openlibrary.org/b/id/8235116-L.jpg"],
            ["titulo" => "1984", "autor" => "George Orwell", "imagen" => "https://covers.openlibrary.org/b/id/7222246-L.jpg"],
            ["titulo" => "El principito", "autor" => "Antoine de Saint-Exupéry", "imagen" => "https://covers.openlibrary.org/b/id/5546156-L.jpg"],
            ["titulo" => "Orgullo y prejuicio", "autor" => "Jane Austen", "imagen" => "https://covers.openlibrary.org/b/id/8091365-L.jpg"],
            ["titulo" => "Matar a un ruiseñor", "autor" => "Harper Lee", "imagen" => "https://covers.openlibrary.org/b/id/8317813-L.jpg"],
            ["titulo" => "Los miserables", "autor" => "Victor Hugo", "imagen" => "https://covers.openlibrary.org/b/id/8282150-L.jpg"],
        ];

        foreach ($libros as $libro) {
            Libro::create($libro);
        }
    }
}
