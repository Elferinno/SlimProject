<?php

namespace App\Services;

use App\models\Sector;
use PDO;
use PDOException;
use Respect\Validation\Validator as v;

class SectorService implements SectorServiceInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getSectors(): array
    {
        $sectors = [];
        $stmt = $this->pdo->prepare('SELECT * FROM sectors');
        $stmt->execute();
        foreach ($stmt as $row) {
            $id = $row['ID'];
            $title = $row['Title'];

            $sectors[] = new Sector($id, $title);
        }
        return $sectors;
    }
    public function getSectorIDsByNames(array $sectorNames): array
    {
        try {
            $query = "SELECT ID FROM sectors WHERE Title IN 
                             (" . implode(',', array_fill(0, count($sectorNames), '?')) . ")";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($sectorNames);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo "Error accessing database: " . $e->getMessage();
            return [];
        }
    }
    public function saveSectorForm(string $userId, array $sectorIds, bool $terms): void
    {
        $valuePlaceholders = [];
        $sql = "INSERT INTO user_sector (User_id, Sector_id, AgreeTerms) VALUES ";

        foreach ($sectorIds as $sectorId) {
            $sectorId = (int)$sectorId;
            $valuePlaceholders[] = "('$userId', '$sectorId', '$terms')";
        }
        $sql .= implode(", ", $valuePlaceholders);

        $this->pdo->query($sql);
    }
    public function deleteUserSectors(string $userId): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM user_sector WHERE User_id = :id');
        $stmt->bindValue(':id', $userId);
        $stmt->execute();
    }

    public function validateInputs(string $name, array $sectors, string $terms): array
    {
        $errorMsg = [];

        if (!v::notEmpty()->alpha()->validate($name)) {
            $errorMsg[] = "Name must be a non-empty string containing only letters.";
        }

        if (!v::notEmpty()->each(v::stringType())->validate($sectors)) {
            $errorMsg[] = "Choose at least one sector /
             Sectors must be a non-empty array containing only string values.";
        }

        if (strlen(trim($name)) < 3 || strlen($name) > 25) {
            $errorMsg[] = "Name must be at between 3 and 25 characters long";
        }

        if (!v::notEmpty()->alpha()->validate($terms)) {
            $errorMsg[] = "Name must be a non-empty string containing only letters.";
        }

        if ($terms != "on") {
            $errorMsg[] = "Agree to terms to proceed!";
        }

        return $errorMsg;
    }
}
