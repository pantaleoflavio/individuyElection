<?php
namespace App\Core;

use App\Core\DB;
use PDO;
use PDOException;

class SearchEngine extends DB {
 /**
     * Executes a search query across multiple tables.
     * 
     * @param string $query The search term.
     * @return array Results from the search.
     */
    public function searchSite($query) {

        $results = [];
        $searchTerm = "%$query%";

        try {
            $conn = $this->connect();

            // Searching in the Federations table
            $stmt = $conn->prepare("SELECT 'Federation' as type, id_federation as id, name, description FROM federations WHERE name LIKE ? OR description LIKE ?");
            $stmt->execute([$searchTerm, $searchTerm]);
            $results['federations'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Searching in the Categories table
            $stmt = $conn->prepare("SELECT 'Category' as type, category_id as id, name FROM categories WHERE name LIKE ?");
            $stmt->execute([$searchTerm]);
            $results['categories'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Searching in the Rankings table
            $stmt = $conn->prepare("SELECT 'Ranking' as type, id_ranking as id, ranking_name as name, description FROM list_ranking WHERE ranking_name LIKE ? OR description LIKE ?");
            $stmt->execute([$searchTerm, $searchTerm]);
            $results['rankings'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            // Log error or handle it as per your error handling policy
            error_log('PDOException in SearchEngine::searchSite: ' . $e->getMessage());
            return [];
        }
    }

}
?>