// API Endpoint URL
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
// Fetch API Data
$response = @file_get_contents($url);

// Error Handling
if ($response === false) {
    die("Error: Unable to fetch data from the API.");
}

// Decode JSON Response
$data = json_decode($response, true);
if (!isset($data['records'])) {
    die("Error: Invalid data format.");
}

// Extract Records
$records = $data['records'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationalities</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1>University of Bahrain: Student Nationalities</h1>
        <?php if (count($records) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nationality</th>
                        <th>Enrollment Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?= htmlspecialchars($record['record']['fields']['nationality'] ?? 'Unknown') ?></td>
                            <td><?= htmlspecialchars($record['record']['fields']['count'] ?? '0') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No data available to display.</p>
        <?php endif; ?>
    </main>
</body>
</html>
