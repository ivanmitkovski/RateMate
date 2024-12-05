<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RateMate</title>
    <link rel="icon" type="image/x-icon" href="../imgs/star-icon.png">
    <link href="./styles.css" rel="stylesheet"> <!-- Link to the custom CSS file -->
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
        <form action="" method="" id="vote-form">
            <div class="form-container" id="form-container">
                <div id="vote-as" class="form-card">
                    <h3 class="form-title" id="vote-as-title">Vote As👨‍💻</h3>
                    <label for="voter" class="input-label" id="voter-label">Choose Employee*</label>
                    <select name="voter" id="voter" class="input-field">
                        <option value="">Alice Burton - Software Engineer</option>
                        <option value="">John Doe - QA Tester</option>
                        <option value="">Jack Smith - Python Developer</option>
                        <option value="">Bob Willson - Software Engineer</option>
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
                        <option value="">Alice Burton - Software Engineer</option>
                        <option value="">John Doe - QA Tester</option>
                        <option value="">Jack Smith - Python Developer</option>
                        <option value="">Bob Willson - Software Engineer</option>
                    </select>
                    <label for="category" class="input-label" id="category-label">Choose Category*</label>
                    <select name="category" id="category" class="input-field">
                        <option value="">Category 1</option>
                        <option value="">Category 2</option>
                        <option value="">Category 3</option>
                        <option value="">Category 4</option>
                    </select>
                </div>
            </div>
            <div class="submit-container" id="submit-container">
                <button class="submit-btn" id="submit-btn">VOTE!</button>
            </div>
        </form>
    </section>

    <section class="results-section" id="results-section">
        <h2 class="results-title" id="results-title">Winners by Category</h2>
        <div class="results-container" id="results-container">
            <!-- "Makes Work Fun" Card -->
            <div id="makes-work-fun" class="result-card">
                <h3 class="result-title" id="makes-work-fun-title">„Makes Work Fun“</h3>
                <p id="first-place" class="result-text">🥇 John Doe - Software Engineer - 5.0</p>
                <p id="second-place" class="result-text">🥈 Alice Burton - QA Tester - 4.7</p>
                <p id="third-place" class="result-text">🥉</p>
                <div class="generate-btn-container" id="generate-btn-container">
                    <button class="generate-btn" id="generate-btn">Generate Certificate🎓</button>
                </div>
            </div>
            <!-- "Team Player" Card -->
            <div id="team-player" class="result-card">
                <h3 class="result-title" id="team-player-title">„Team Player“</h3>
                <p id="first-place-team" class="result-text">🥇</p>
                <p id="second-place-team" class="result-text">🥈</p>
                <p id="third-place-team" class="result-text">🥉</p>
                <div class="generate-btn-container" id="generate-btn-team">
                    <button class="generate-btn" id="generate-btn-team">Generate Certificate🎓</button>
                </div>
            </div>
            <!-- "Culture Champion" Card -->
            <div id="culture-champion" class="result-card">
                <h3 class="result-title" id="culture-champion-title">„Culture Champion“</h3>
                <p id="first-place-culture" class="result-text">🥇</p>
                <p id="second-place-culture" class="result-text">🥈</p>
                <p id="third-place-culture" class="result-text">🥉</p>
                <div class="generate-btn-container" id="generate-btn-culture">
                    <button class="generate-btn" id="generate-btn-culture">Generate Certificate🎓</button>
                </div>
            </div>
            <!-- "Difference Maker" Card -->
            <div id="difference-maker" class="result-card">
                <h3 class="result-title" id="difference-maker-title">„Difference Maker“</h3>
                <p id="first-place-diff" class="result-text">🥇</p>
                <p id="second-place-diff" class="result-text">🥈</p>
                <p id="third-place-diff" class="result-text">🥉</p>
                <div class="generate-btn-container" id="generate-btn-diff">
                    <button class="generate-btn" id="generate-btn-diff">Generate Certificate🎓</button>
                </div>
            </div>
        </div>
    </section>

    <section class="top-voters-section" id="top-voters-section">
        <h3 class="top-voters-title" id="top-voters-title">TOP-3 Voters</h3>
        <div class="top-voters-container" id="top-voters-container">
            <div class="top-voter" id="top-voter-1">🥇John</div>
            <div class="top-voter" id="top-voter-2">🥈Alice</div>
            <div class="top-voter" id="top-voter-3">🥉Jack</div>
        </div>
    </section>

    <section class="mvp-section" id="mvp-section">
        <h3 class="mvp-title" id="mvp-title">The All-Time Champion Colleague, The MVP 🏆</h3>
        <div id="mvp" class="mvp-card">
            <p class="mvp-text" id="mvp-text">IVAN MITKOVSKI - SOFTWARE ENGINEER - 5.0</p>
            <button class="generate-btn" id="generate-mvp-btn">Generate Certificate🏆</button>
        </div>
    </section>
</body>

</html>
