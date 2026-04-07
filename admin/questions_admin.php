<?php
include 'includes/header.php';
$result = $conn->query("SELECT q.id,q.question,a.answer,u.name AS username FROM questions q JOIN users u ON q.user_id=u.id LEFT JOIN answers a ON q.id=a.question_id");

while($row=$result->fetch_assoc()){
    echo "<b>User:</b> ".$row['username']."<br>";
    echo "<b>Q:</b> ".$row['question']."<br>";
    if($row['answer']){
        echo "<b>A:</b> ".$row['answer']."<br>";
    } else {
        echo "<form method='POST' action='reply_question.php'>
                <input type='hidden' name='qid' value='".$row['id']."'>
                <textarea name='answer' placeholder='Andika jibu hapa'></textarea>
                <button type='submit'>Tuma Jibu</button>
              </form>";
    }
    echo "<hr>";
}
?>