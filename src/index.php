<?php
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Category.php';
require_once __DIR__ . '/classes/Employee.php';
require_once __DIR__ . '/classes/Vote.php';
require_once __DIR__ . '/classes/VoteHandler.php';

$database = new Database();
$db = $database->connect();

$employee = new Employee($db);
$category = new Category($db);
$vote = new Vote($db);

$voteHandler = new VoteHandler($db);

$employees = $employee->getAllEmployees();
$categories = $category->getAllCategories();

$vote_status = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-vote'])) {

    $voteHandler->setFormData($_POST);

    $vote_status = $voteHandler->handleFormSubmission();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RateMate</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js" defer></script>
    <link rel="icon" type="image/x-icon" href="../imgs/star-icon.png">
    <link href="./styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="font-main">
    <nav class="navbar">
        <p class="logo" href="./index.php" id="logo">RateMate⭐</p>
        <h2 class="tagline" id="tagline">„Rate Your Colleagues, with Ease!🪄“</h2>
    </nav>

    <section class="form-section" id="form-section">
        <form method="POST" action="index.php" id="vote-form">
            <div class="form-container" id="form-container">
                <div id="vote-as" class="form-card">
                    <h3 class="form-title" id="vote-as-title">Vote As👨‍💻</h3>
                    <label for="voter" class="input-label" id="voter-label">Choose Employee*</label>
                    <select name="voter" id="voter" class="input-field">
                        <?php
                        while ($emp = $employees->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$emp['employee_id']}'>{$emp['first_name']} {$emp['last_name']}</option>";
                        }
                        ?>
                    </select>
                    <label for="rating" class="input-label" id="rating-label">Give a Rating from <b>1</b> to <b>5</b>*</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" class="input-field">
                    <label for="comment" class="input-label" id="comment-label">Leave a comment*</label>
                    <textarea name="comment" id="comment" rows="4" class="textarea" placeholder="type here.."></textarea>
                </div>

                <div id="vote-for" class="form-card">
                    <h3 class="form-title" id="vote-for-title">Vote For 👩‍💻</h3>
                    <label for="nominee" class="input-label" id="nominee-label">Choose Employee*</label>
                    <select name="nominee" id="nominee" class="input-field">
                        <?php
                        $employees->execute();
                        while ($emp = $employees->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$emp['employee_id']}'>{$emp['first_name']} {$emp['last_name']}</option>";
                        }
                        ?>
                    </select>
                    <label for="category" class="input-label" id="category-label">Choose Category*</label>
                    <select name="category" id="category" class="input-field">
                        <?php
                        while ($cat = $categories->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="submit-container" id="submit-container">
                <button class="submit-btn" id="submit-btn" type="submit" name="submit-vote">VOTE!</button>
                <?php if (!empty($vote_status)) { ?>
                    <p><?= $vote_status; ?></p>
                <?php } ?>
            </div>
        </form>

    </section>

    <!-- Results Section -->
    <section class="results-section" id="results-section">
        <h2 class="results-title" id="results-title">Winners by Category</h2>
        <div class="results-container" id="results-container">
            <div class="results-container" id="results-container">
                <!-- "Makes Work Fun" Card -->
                <div id="makes-work-fun" class="result-card">
                    <h3 class="result-title" id="makes-work-fun-title">„Makes Work Fun“</h3>
                    <?php
                    $category = 1;
                    $winners = $vote->getCategoryWinners($category);
                    ?>
                    <span class='winner-data' data-name='<?php echo $winners[0]['full_name']; ?>' data-title='<?php echo $winners[0]['job_title']; ?>' data-rating='<?php echo round($winners[0]['average_rating'], 1); ?>'></span>

                    <p id="first-place-makes-work-fun" class="result-text">
                        <?php echo isset($winners[0]) ? '🥇 ' . $winners[0]['full_name'] . " - " . $winners[0]['job_title'] . " - " . round($winners[0]['average_rating'], 1) : '🥇 No votes yet'; ?>
                    </p>
                    <p id="second-place-makes-work-fun" class="result-text">
                        <?php echo isset($winners[1]) ? '🥈 ' . $winners[1]['full_name'] . " - " . $winners[1]['job_title'] . " - " . round($winners[1]['average_rating'], 1) : '🥈 No votes yet'; ?>
                    </p>
                    <p id="third-place-makes-work-fun" class="result-text">
                        <?php echo isset($winners[2]) ? '🥉 ' . $winners[2]['full_name'] . " - " . $winners[2]['job_title'] . " - " . round($winners[2]['average_rating'], 1) : '🥉 No votes yet'; ?>
                    </p>
                    <div class="generate-btn-container" id="generate-btn-container">
                        <button class="generate-btn" id="generate-btn-makes-work-fun" <?php echo (empty($winners[0])) ? 'disabled' : ''; ?>>Generate Certificate🎓</button>
                    </div>
                </div>

                <!-- "Team Player" Card -->
                <div id="team-player" class="result-card">
                    <h3 class="result-title" id="team-player-title">„Team Player“</h3>
                    <?php
                    $category = 2;
                    $winners = $vote->getCategoryWinners($category);
                    ?>
                    <span class='winner-data' data-name='<?php echo $winners[0]['full_name']; ?>' data-title='<?php echo $winners[0]['job_title']; ?>' data-rating='<?php echo round($winners[0]['average_rating'], 1); ?>'></span>

                    <p id="first-place-team" class="result-text">
                        <?php echo isset($winners[0]) ? '🥇 ' . $winners[0]['full_name'] . " - " . $winners[0]['job_title'] . " - " . round($winners[0]['average_rating'], 1) : '🥇 No votes yet'; ?>
                    </p>
                    <p id="second-place-team" class="result-text">
                        <?php echo isset($winners[1]) ? '🥈 ' . $winners[1]['full_name'] . " - " . $winners[1]['job_title'] . " - " . round($winners[1]['average_rating'], 1) : '🥈 No votes yet'; ?>
                    </p>
                    <p id="third-place-team" class="result-text">
                        <?php echo isset($winners[2]) ? '🥉 ' . $winners[2]['full_name'] . " - " . $winners[2]['job_title'] . " - " . round($winners[2]['average_rating'], 1) : '🥉 No votes yet'; ?>
                    </p>
                    <div class="generate-btn-container" id="generate-btn-team">
                        <button class="generate-btn" id="generate-btn-team" <?php echo (empty($winners[0])) ? 'disabled' : ''; ?>>Generate Certificate🎓</button>
                    </div>
                </div>

                <!-- "Culture Champion" Card -->
                <div id="culture-champion" class="result-card">
                    <h3 class="result-title" id="culture-champion-title">„Culture Champion”</h3>
                    <?php
                    $category = 3;
                    $winners = $vote->getCategoryWinners($category);
                    ?>
                    <span class='winner-data' data-name='<?php echo $winners[0]['full_name']; ?>' data-title='<?php echo $winners[0]['job_title']; ?>' data-rating='<?php echo round($winners[0]['average_rating'], 1); ?>'></span>

                    <p id="first-place-culture" class="result-text">
                        <?php echo isset($winners[0]) ? '🥇 ' . $winners[0]['full_name'] . " - " . $winners[0]['job_title'] . " - " . round($winners[0]['average_rating'], 1) : '🥇 No votes yet'; ?>
                    </p>
                    <p id="second-place-culture" class="result-text">
                        <?php echo isset($winners[1]) ? '🥈 ' . $winners[1]['full_name'] . " - " . $winners[1]['job_title'] . " - " . round($winners[1]['average_rating'], 1) : '🥈 No votes yet'; ?>
                    </p>
                    <p id="third-place-culture" class="result-text">
                        <?php echo isset($winners[2]) ? '🥉 ' . $winners[2]['full_name'] . " - " . $winners[2]['job_title'] . " - " . round($winners[2]['average_rating'], 1) : '🥉 No votes yet'; ?>
                    </p>
                    <div class="generate-btn-container" id="generate-btn-culture">
                        <button class="generate-btn" id="generate-btn-culture" <?php echo (empty($winners[0])) ? 'disabled' : ''; ?>>Generate Certificate🎓</button>
                    </div>
                </div>

                <!-- "Difference Maker" Card -->
                <div id="difference-maker" class="result-card">
                    <h3 class="result-title" id="difference-maker-title">„Difference Maker“</h3>
                    <?php
                    $category = 4;
                    $winners = $vote->getCategoryWinners($category);
                    ?>
                    <span class='winner-data' data-name='<?php echo $winners[0]['full_name']; ?>' data-title='<?php echo $winners[0]['job_title']; ?>' data-rating='<?php echo round($winners[0]['average_rating'], 1); ?>'></span>

                    <p id="first-place-difference-maker" class="result-text">
                        <?php echo isset($winners[0]) ? '🥇 ' . $winners[0]['full_name'] . " - " . $winners[0]['job_title'] . " - " . round($winners[0]['average_rating'], 1) : '🥇 No votes yet'; ?>
                    </p>
                    <p id="second-place-difference-maker" class="result-text">
                        <?php echo isset($winners[1]) ? '🥈 ' . $winners[1]['full_name'] . " - " . $winners[1]['job_title'] . " - " . round($winners[1]['average_rating'], 1) : '🥈 No votes yet'; ?>
                    </p>
                    <p id="third-place-difference-maker" class="result-text">
                        <?php echo isset($winners[2]) ? '🥉 ' . $winners[2]['full_name'] . " - " . $winners[2]['job_title'] . " - " . round($winners[2]['average_rating'], 1) : '🥉 No votes yet'; ?>
                    </p>
                    <div class="generate-btn-container" id="generate-btn-diff">
                        <button class="generate-btn" id="generate-btn-diff" <?php echo (empty($winners[0])) ? 'disabled' : ''; ?>>Generate Certificate🎓</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Voters Section -->
    <section class="top-voters-section" id="top-voters-section">
        <h3 class="top-voters-title" id="top-voters-title">TOP-3 Voters</h3>
        <div class="top-voters-container" id="top-voters-container">
            <?php
            $top3 = $vote->getTopVoters();
            $topVoters = $top3->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="top-voter" id="top-voter-1"><?php echo isset($topVoters[0]) ? '🥇 ' . ($topVoters[0]['full_name']) . " - " . "voted {$topVoters[0]['vote_count']} times" : '🥇 No votes yet' ?></div>
            <div class="top-voter" id="top-voter-2"><?php echo isset($topVoters[1]) ? '🥈 ' . ($topVoters[1]['full_name']) . " - " . "voted {$topVoters[1]['vote_count']} times" : '🥈 No votes yet' ?></div>
            <div class="top-voter" id="top-voter-2"><?php echo isset($topVoters[2]) ? '🥉 ' . ($topVoters[2]['full_name']) . " - " . "voted {$topVoters[2]['vote_count']} times" : '🥉 No votes yet' ?></div>


        </div>
    </section>

    <!-- MVP Section -->
    <section class="mvp-section" id="mvp-section">
        <h3 class="mvp-title" id="mvp-title">The All-Time Champion Colleague, The MVP 🏆</h3>
        <div id="mvp" class="mvp-card">
            <?php
            $mvp = $vote->getAllTimeBestColleague();
            ?>
            <p class="mvp-text" id="mvp-text">
                <?php
                if (is_null($mvp)) {
                    echo '🏆No votes yet';
                } else {
                    echo $mvp['full_name'] . " - " . $mvp['job_title'] . " " . round($mvp['average_rating'], 1);
                }
                ?>
            </p>

            <!-- Hidden span for storing the data -->
            <span id="mvp-data" style="display:none;">
                <?php
                if (!is_null($mvp)) {
                    echo $mvp['full_name'] . '|' . $mvp['job_title'] . '|' . round($mvp['average_rating'], 1);
                } else {
                    echo 'No MVP data available';
                }
                ?>
            </span>

            <button class="generate-btn" id="generate-mvp-btn">Generate Certificate🏆</button>
        </div>

    </section>
</body>

</html>