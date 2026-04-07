<?php include 'includes/header.php'; ?>
<?php
include 'config/db.php';
session_start();

$successMsg = '';
$errorMsg = '';

// 🔹 Generate captcha first time tu au baada ya success
if(!isset($_SESSION['captcha_answer'])){
    $a = rand(1,10);
    $b = rand(1,10);
    $_SESSION['captcha_answer'] = $a + $b;
    $_SESSION['captcha_question'] = "Je, ni kiasi gani $a + $b ?";
}

if(isset($_POST['send_message'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    $captcha = intval($_POST['captcha']);

    // 🔹 Check captcha BEFORE regenerating it
    if($captcha !== $_SESSION['captcha_answer']){
        $errorMsg = "Captcha sio sahihi. Tafadhali jaribu tena.";
    } elseif(!empty($name) && !empty($email) && !empty($message)){
        // Save to database
        $insert = "INSERT INTO messages (name, email, message, created_at) 
                   VALUES ('$name', '$email', '$message', NOW())";
        if($conn->query($insert)){
            // Send email to admin
            $to = "admin@healthawareness.local"; // badilisha kama ni real email
            $subject = "Ujumbe Mpya Kutoka $name";
            $body = "Jina: $name\nEmail: $email\nUjumbe:\n$message";
            $headers = "From: no-reply@healthawareness.local";
            @mail($to, $subject, $body, $headers);

            $successMsg = "Ujumbe wako umetumwa kwa mafanikio. Tutakujibu hivi karibuni!";

            // 🔹 Regenerate captcha ONLY after success
            $a = rand(1,10);
            $b = rand(1,10);
            $_SESSION['captcha_answer'] = $a + $b;
            $_SESSION['captcha_question'] = "Je, ni kiasi gani $a + $b ?";
        } else {
            $errorMsg = "Tatizo limetokea. Tafadhali jaribu tena.";
        }
    } else {
        $errorMsg = "Tafadhali jaza mashamba yote.";
    }
}
?>

<section class="contact">
    <h2>Wasiliana Nasi</h2>
    <p>Una maswali au unahitaji ushauri wa afya? Tuma ujumbe wako hapa chini:</p>

    <?php if($successMsg): ?>
        <div class="alert success"><?php echo $successMsg; ?></div>
    <?php endif; ?>
    <?php if($errorMsg): ?>
        <div class="alert error"><?php echo $errorMsg; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Jina Lako:</label>
        <input type="text" name="name" placeholder="Jina lako" required>

        <label>Email:</label>
        <input type="email" name="email" placeholder="Email yako" required>

        <label>Ujumbe:</label>
        <textarea name="message" placeholder="Andika ujumbe wako hapa..." required></textarea>

        <label>Captcha:</label>
        <input type="text" name="captcha" placeholder="<?php echo $_SESSION['captcha_question']; ?>" required>

        <button type="submit" name="send_message" class="btn">Tuma Ujumbe</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>