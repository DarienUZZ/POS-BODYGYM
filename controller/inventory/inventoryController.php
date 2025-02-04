<?php

require_once '../model/inventory/inventoryModel.php';

class InventoryController
{

    public function getInventory()
    {
        $inventoryModel = new InventoryModel();
        return $inventoryModel->getInventory();
    }

    public function insertInventory($inventoryData)
    {
        if (
            empty($inventoryData['productId']) ||
            empty($inventoryData['quantity']) ||
            empty($inventoryData['date']) ||
            empty($inventoryData['time'])
        ) {
            return [
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ];
        }

        // Insertar en el inventario
        $inventoryModel = new InventoryModel();
        return $inventoryModel->insertInventory(
            $inventoryData['productId'],
            $inventoryData['quantity'],
            $inventoryData['date'],
            $inventoryData['time']
        );
    }


    public function getProducts()
    {
        $inventoryModel = new InventoryModel();
        $products = $inventoryModel->getProducts();

        if ($products) {
            return [
                'success' => true,
                'data' => $products
            ];
        } else {
            return [
                'success' => false,
                'message' => 'No se encontraron productos'
            ];
        }
    }
}
