<?php include 'includes/header.php'; ?>
<?php
// Database connection
include 'config/db.php';

// Fetch diseases from database
$query = "SELECT * FROM diseases";
$result = $conn->query($query);
?>

<section class="articles">
    <h2>Makala na Taarifa za Magonjwa</h2>
    <div class="article-cards">
        <?php
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '
                <div class="article-card">
                    <img src="images/'.$row['image'].'" alt="'.$row['name'].'">
                    <h3>'.$row['name'].'</h3>
                    <p>'.$row['description'].'</p>
                    <h4>Dalili:</h4>
                    <p>';
                        // Fetch symptoms for this disease
                        $symQuery = "SELECT s.name FROM symptoms s 
                                     JOIN disease_symptoms ds ON s.id = ds.symptom_id
                                     WHERE ds.disease_id = ".$row['id'];
                        $symResult = $conn->query($symQuery);
                        $symptoms = [];
                        if($symResult->num_rows > 0){
                            while($symRow = $symResult->fetch_assoc()){
                                $symptoms[] = $symRow['name'];
                            }
                        }
                        echo implode(", ", $symptoms);
                    echo '</p>
                    <h4>Mbinu za Kujikinga:</h4>
                    <p>'.$row['prevention'].'</p>
                    <h4>Ushauri:</h4>
                    <p>'.$row['advice'].'</p>
                </div>
                ';
            }
        } else {
            echo '<p>Hakuna magonjwa yaliyopatikana bado.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>