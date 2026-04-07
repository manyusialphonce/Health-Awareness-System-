<?php include 'includes/header.php'; ?>
<?php
include 'config/db.php';

// Handle form submission
$results = [];
$userSymptoms = $_POST['symptoms'] ?? [];

if(isset($_POST['check_symptoms']) && !empty($userSymptoms)){
    // Convert array to comma-separated string
    $symptomIds = implode(",", array_map('intval', $userSymptoms));

    // Fetch all diseases
    $diseaseQuery = "SELECT * FROM diseases";
    $diseaseResult = $conn->query($diseaseQuery);

    if($diseaseResult->num_rows > 0){
        while($disease = $diseaseResult->fetch_assoc()){
            // Fetch symptoms for this disease
            $dsQuery = "SELECT s.id, s.name FROM symptoms s
                        JOIN disease_symptoms ds ON s.id = ds.symptom_id
                        WHERE ds.disease_id = ".$disease['id'];
            $dsResult = $conn->query($dsQuery);
            $diseaseSymptoms = [];
            while($dsRow = $dsResult->fetch_assoc()){
                $diseaseSymptoms[] = $dsRow['id'];
            }

            // Calculate matching percentage
            $matchCount = count(array_intersect($userSymptoms, $diseaseSymptoms));
            $totalSymptoms = count($diseaseSymptoms);
            $matchPercent = round(($matchCount / $totalSymptoms) * 100);

            if($matchCount > 0){
                $results[] = [
                    'disease' => $disease,
                    'match' => $matchPercent,
                    'symptoms' => $diseaseSymptoms
                ];
            }
        }
    }
}

// Fetch all symptoms for form
$symQuery = "SELECT * FROM symptoms ORDER BY name";
$symResult = $conn->query($symQuery);
?>

<section class="symptom-checker">
    <h2>Chunguza Dalili Zako</h2>
    <p class="guidance">Tafadhali chagua dalili zote unazohisi sasa. Kwa kila ugonjwa unaoendana na dalili zako, utapata asilimia ya uwezekano.</p>

    <form method="POST" action="">
        <div class="symptoms-list">
            <?php
            if($symResult->num_rows > 0){
                while($sym = $symResult->fetch_assoc()){
                    echo '<label title="Chagua ikiwa una dalili ya '.$sym['name'].'">
                            <input type="checkbox" name="symptoms[]" value="'.$sym['id'].'"> '.$sym['name'].'
                          </label>';
                }
            } else {
                echo '<p>Hakuna dalili zilizopo.</p>';
            }
            ?>
        </div>
        <button type="submit" name="check_symptoms" class="btn">Angalia Magonjwa</button>
    </form>

    <?php if(isset($_POST['check_symptoms'])): ?>
        <div class="results">
            <h3>Matokeo Yako:</h3>
            <?php if(!empty($results)): ?>
                <?php foreach($results as $res): 
                    $disease = $res['disease'];
                    $matchPercent = $res['match'];
                ?>
                    <div class="disease-result">
                        <h4><?php echo $disease['name']; ?> (Uwezekano: <?php echo $matchPercent; ?>%)</h4>
                        <p><strong>Dalili:</strong>
                        <?php
                        $dsNames = [];
                        foreach($res['symptoms'] as $symId){
                            $symRow = $conn->query("SELECT name FROM symptoms WHERE id=$symId")->fetch_assoc();
                            $dsNames[] = $symRow['name'];
                        }
                        echo implode(", ", $dsNames);
                        ?>
                        </p>
                        <p><strong>Mbinu za Kujikinga:</strong> <?php echo $disease['prevention']; ?></p>
                        <p><strong>Ushauri:</strong> <?php echo $disease['advice']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Hakuna magonjwa yanayolingana na dalili ulizochagua. Tafadhali jaribu tena.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>