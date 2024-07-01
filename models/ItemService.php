<?php
require_once 'SupabaseClient.php';

class ItemService
{
    private $supabase;

    public function __construct($url, $key)
    {
        $this->supabase = new SupabaseClient($url, $key);
    }

    public function formatData($data)
    {
        return date('d/m/Y', strtotime($data));
    }

    //$requestUrl = "$url/rest/v1/estoque_laboratorio?select=id,nome_item,laboratorio,criado_em,classificacao,caminho_imagem,grupo_residuo,localizacao,descricao&st=eq.1";

    public function getAllItems()
    {
        $items = [];
        $response = $this->supabase->get("estoque_laboratorio?select=id,nome_item,laboratorio,criado_em,classificacao,caminho_imagem,grupo_residuo,localizacao,descricao&st=eq.1&order=id.desc");

        if ($response) {
            foreach ($response as $row) {
                $item = new StockItem();
                $item->id = $row["id"];
                $item->itemName = $row["nome_item"];
                $item->laboratory = $row["laboratorio"];
                $item->date = $row["criado_em"];
                $item->classification = $row["classificacao"];
                $item->imagePath = $row["caminho_imagem"];
                $item->residueGroup = $row["grupo_residuo"];
                $item->location = $row["localizacao"];
                $item->description = $row["descricao"];
                $items[] = $item;
            }
        } else {
            error_log("Erro ao consultar dados do Supabase.");
        }

        return $items;
    }

    public function getItemById($id)
    {
        try {
            $response = $this->supabase->get("estoque_laboratorio?id=eq.$id");

            if ($response) {
                $row = $response[0];

                $item = new StockItem();
                $item->setId($row['id']);
                $item->setItemName($row['nome_item']);
                $item->setLaboratory($row['laboratorio']);
                $item->setDate($row['criado_em']);
                $item->setQuantity($row['classificacao']);
                $item->setResidueGroup($row['grupo_residuo']);
                $item->setDescription($row['descricao']);
                $item->setLocation($row['localizacao']);
                $item->setImagePath($row['caminho_imagem']);

                return $item;
            } else {
                error_log("Item não encontrado para o ID: $id");
                return null;
            }
        } catch (Exception $e) {
            error_log('Erro ao buscar item por ID: ' . $e->getMessage());
            return null;
        }
    }

    public function updateImagePath($id, $imagePath)
    {
        try {
            $query = "UPDATE estoque_laboratorio SET caminho_imagem = :imagePath WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar caminho da imagem" . $e);
        }
    }

    public function insertContacts(StockItem $item)
    {
        try {
            $query = "INSERT INTO estoque_laboratorio(nome, laboratorio, quantidade, data, reagente, grupo_residuo, data_coleta, descricao, nome_item) VALUES (:name, :laboratory, :quantity, :date, :reagent, :residueGroup, :pickupDate, :description, :itemName)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':name', $item->getName());
            $stmt->bindValue(':laboratory', $item->getLaboratory());
            $stmt->bindValue(':quantity', $item->getQuantity());
            $stmt->bindValue(':date', $item->getDate());
            $stmt->bindValue(':reagent', $item->getReagent());
            $stmt->bindValue(':residueGroup', $item->getresidueGroup());
            $stmt->bindValue(':pickupDate', $item->getPickupDate());
            $stmt->bindValue(':description', $item->getDescription());
            $stmt->bindValue(':itemName', $item->getItemName());
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir" . $e);
        }
    }


    public function updateContact(StockItem $item)
    {
        $data = [
            'nome_item' => $item->getItemName(),
            'laboratorio' => $item->getLaboratory(),
            'criado_em' => $item->getDate(),
            'grupo_residuo' => $item->getResidueGroup(),
            'localizacao' => $item->getLocation(),
            'descricao' => $item->getDescription(),
            'caminho_imagem' => $item->getImagePath(),
        ];

         // Log the data being sent for update
        error_log("Data being sent for update: " . json_encode($data));

        $endpoint = "estoque_laboratorio?id=eq." . $item->getId();
        $response = $this->supabase->put($endpoint, $data);

        if (!$response) {
            error_log("Erro ao atualizar o item no Supabase.");
        }
    }
    public function removeItem($id)
    {
        try {
            $data = [
                'st' => 2
            ];
    
            $response = $this->supabase->put("estoque_laboratorio?id=eq.$id", $data);
    
            if (isset($response['code'])) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $exception) {
            error_log('Exception: ' . $exception->getMessage());
            return false;
        }
    }

    public function filterResidueGroup($residue)
    {
        $mapping = [
            'soh' => 0,
            'sonh' => 1,
            'sopp' => 2,
            'aquaso' => 3,
            'aquosocromo' => 4,
            'aquosocianeto' => 5,
            'solido' => 6
        ];

        if (isset($mapping[$residue])) {
            $position = $mapping[$residue];
            $listResidue = ['SOH', 'SOñH', "SOPP", 'Aquoso sem cromo e cianeto', 'Aquoso com cromo', 'Aquoso com cianeto', 'Sólido'];
            return $listResidue[$position];
        } else {
            return "Valor inválido";
        }
    }

    public function filterLaboratory($laboratory)
    {
        $mapping = [
            'lab1' => 0,
            'lab2' => 1,
            'lab3' => 2,
            'lab4' => 3,
            'lab5' => 4,
            'lab6' => 5,
            'lab7' => 6,
            'lab8' => 7,
            'lab9' => 8,
            'lab10' => 9,
            'lab11' => 10,
            'salaCoor' => 11,
            'sala101' => 12,
            'sala101A' => 13,
            'sala102' => 14,
            'sala104' => 15,
            'sala111' => 16,
        ];

        if (isset($mapping[$laboratory])) {
            $position = $mapping[$laboratory];
            $laboratorys = ['Laboratório 1', 'Laboratório 2', 'Laboratório 3', 'Laboratório 4', 'Laboratório de Espectrofotometria', 'Laboratório de Potenciometria', 'Laboratório de Cromatografia', 'Laboratório de Microbiologia', 'Laboratório de Polímeros', 'Laboratório de Pesquisa', 'Laboratório de Preparo', 'Sala de Coordenação', 'Sala de Aula – 101', 'Sala de Professores – 101A', 'Sala de Professores – 102', 'Sala de Aula – 104', 'Sala de Aula – 111'];
            return $laboratorys[$position];
        } else {
            return "Lab";
        }
    }

    public function searchContacts($searchValue)
    {
        try {
            // Monta o filtro para buscar por nome_item contendo $searchValue
            $filter = "nome_item.ilike.*$searchValue*";
    
            // Executa a consulta usando o SupabaseClient
            $response = $this->supabase->get("estoque_laboratorio", [
                'select' => '*',
                'filter' => $filter,
                'st' => 'eq.1'
            ]);
    
            if ($response) {
                return $response['data'];
            } else {
                error_log("Erro ao realizar a pesquisa no Supabase.");
                return [];
            }
        } catch (Exception $e) {
            error_log('Erro na consulta: ' . $e->getMessage());
            return [];
        }
    }

}
