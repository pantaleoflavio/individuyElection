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

            // Searching in the Rankings table
            $stmt = $conn->prepare("SELECT 'Ranking' as type, id_ranking as id, ranking_name as name, description FROM list_ranking WHERE ranking_name LIKE ? OR description LIKE ?");
            $stmt->execute([$searchTerm, $searchTerm]);
            $results['rankings'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Searching in the Wrestlers table
            $stmt = $conn->prepare("SELECT 'Wrestler' as type, id_wrestler as id, name, country FROM wrestlers WHERE name LIKE ? OR country LIKE ?");
            $stmt->execute([$searchTerm, $searchTerm]);
            $results['wrestlers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Searching in the Tag Team table
            $stmt = $conn->prepare("SELECT 'Tag Teams' as type, id_tag_team as id, name, country FROM tag_teams WHERE name LIKE ? OR country LIKE ?");
            $stmt->execute([$searchTerm, $searchTerm]);
            $results['tag teams'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            // Log error or handle it as per your error handling policy
            error_log('PDOException in SearchEngine::searchSite: ' . $e->getMessage());
            return [];
        }
    }

}
?>