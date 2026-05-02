<?php
class Producto {


private  PDO $db;

public function __construct(PDO $db)
{
    $this->db = $db;
}

// Método para obtener todos los accesorios de los carros
public function getAll():array{
    $stmt = $this->db->query("SELECT id, nombre, precio, cantidadStock, estado from productos");
    return $stmt->fetchAll();  

}

public function findById(int $id): ?array{
    $stmt = $this->db->prepare("SELECT id, nombre, precio, cantidadStock, estado from productos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

// Método para crear un nuevo accesorio
public function create (array $data):bool{
    $stmt=$this->db->prepare("INSERT INTO productos (nombre, precio, cantidadStock, estado) VALUES (:nombre, :precio, :cantidadStock, 1)");
return $stmt->execute([
    ':nombre' => $data['nombre'],
    ':precio' => $data['precio'],
    ':cantidadStock' => $data['cantidadStock']
]);


}


//función para eliminar un usuario por su ID
public function delete(int $id):bool{
    $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}   


//Función para actualizar un usuario existente
function update(int $id, array $data):bool
{
    $stmt = $this->db->prepare("UPDATE productos SET nombre = :nombre, precio = :precio, cantidadStock = :cantidadStock, estado = 1 WHERE id = :id");
    return $stmt->execute([
        ':id' => $id,
        ':nombre' => $data['nombre'],
        ':precio' => $data['precio'],
        ':cantidadStock' => $data['cantidadStock']
    ]);
}







}



?>