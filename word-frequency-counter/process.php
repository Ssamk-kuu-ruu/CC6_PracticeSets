<?php

$stop_words = array(
    'a', 'about', 'above', 'after', 'again', 'against', 'all', 'am', 'an', 'and', 'any', 'are', 'aren\'t', 'as',
    'at', 'be', 'because', 'been', 'before', 'being', 'below', 'between', 'both', 'but', 'by', 'can', 'cannot', 'could',
    'did', 'does', 'doesn\'t', 'don\'t', 'down', 'each', 'few', 'for', 'from', 'had', 'has', 'haven\'t', 'have', 'having',
    'he', 'he\'ll', 'he\'s', 'here', 'here\'s', 'hers', 'herself', 'how', 'how\'s', 'i', 'i\'ll', 'i\'ve', 'i\'d', 'in',
    'is', 'isn\'t', 'it', 'it\'s', 'its', 'it\'s,', 'just', 'let', 'me', 'more', 'my', 'myself', 'no', 'nor', 'not', 'of',
    'on', 'or', 'other', 'ought', 'our', 'ours', 'ourselves', 'out', 'over', 'own', 'same', 'than', 'that', 'that\'s', 'the',
    'theirs', 'themselves', 'then', 'there', 'there\'s', 'these', 'they', 'they\'ll', 'they\'re', 'they\'ve', 'this', 'those',
    'through', 'to', 'too', 'under', 'until', 'up', 'very', 'was', 'wasn\'t', 'we', 'we\'ll', 'we\'re', 'we\'ve', 'were',
    'weren\'t', 'what', 'what\'s', 'what\'ll', 'what\'d', 'when', 'when\'s', 'when\'ll', 'when\'d', 'where', 'where\'s',
    'where\'ll', 'where\'d', 'which', 'which\'s', 'who', 'who\'s', 'who\'ll', 'who\'d', 'whom', 'whom\'s', 'why', 'why\'s',
    'why\'ll', 'why\'d', 'with', 'won\'t', 'you', 'you\'ll', 'you\'re', 'you\'ve', 'you\'re', 'your', 'yourself', 'yourselves'
);

function calculateWordFrequency($inputText, $stop_words, $sortOrder, $limit) {
    $words = preg_split('/\s+/', strtolower($inputText));
    $words = array_map(function($word) {
        return preg_replace('/[^a-z]/', '', $word);
    }, $words);

    $filteredWords = array_diff($words, $stop_words);
    $filteredWords = array_filter($filteredWords);

    $wordCounts = array_count_values($filteredWords);

    if ($sortOrder === 'desc') {
        arsort($wordCounts);
    } else {
        asort($wordCounts);
    }

    return array_slice($wordCounts, 0, $limit, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputText = $_POST['text'];
    $sortOrder = $_POST['sort'];
    $limit = intval($_POST['limit']);

    $result = calculateWordFrequency($inputText, $stop_words, $sortOrder, $limit);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Results</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Word Frequency Results</h1>
    <a href="index.php">Go back</a>
    
    <?php if (isset($result)): ?>
        <table border="1">
            <tr>
                <th>Word</th>
                <th>Frequency</th>
            </tr>
            <?php foreach ($result as $word => $count): ?>
                <tr>
                    <td><?= htmlspecialchars($word) ?></td>
                    <td><?= $count ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No results to display. Please make sure the form is submitted correctly.</p>
    <?php endif; ?>
</body>
</html>
