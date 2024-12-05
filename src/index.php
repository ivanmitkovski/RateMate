<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RateMate</title>
    <link rel="icon" type="image/x-icon" href="../imgs/star-icon.png">
    <link href="./output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="font-rateFont">
    <nav class="px-10 py-4 bg-cyan-50 flex justify-between items-center">
        <a class="transition-all duration-400 font-light text-2xl hover:scale-105" href="./index.php">RateMate⭐</a>
        <h2 class="italic">„Rate Your Colleagues, with Ease!🪄“</h2>
    </nav>
    <section class="px-10 bg-purple-50 py-10">
        <form action="" method="">
            <div class="flex justify-between mt-2 gap-4">
                <div id=" vote-as" class="w-1/2 h-[400px] rounded-xl px-6 py-4 shadow-xl bg-white flex flex-col">
                    <h3 class="text-center text-5xl font-extrabold">Vote As👨‍💻</h3>
                    <label for="voter" class="text-xs mb-0.5">Choose Employee*</label>
                    <select name="voter" id="voter" size="1" class="px-1 py-2 rounded-lg shadow-sm mb-4 border-2">
                        <option value="">Alice Burton - Software Engineer</option>
                        <option value="">John Doe - QA Tester</option>
                        <option value="">Jack Smith - Python Developer</option>
                        <option value="">Bob Willson - Software Engineer</option>
                    </select>
                    <label for="rating" class="text-xs mb-0.5">Give a Rating from <b>1</b> to <b>5</b>*</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" class="px-1 py-1 rounded-lg shadow-sm mb-4 border-2">
                    <label for="comment" class="text-xs mb-0.5">Leave a comment*</label>
                    <textarea name="comment" id="comment" rows="4" cols="35" class="shadow-sm px-1 py-1 rounded-lg text-sm border-2" placeholder="type here.."></textarea>

                </div>
                <div id="vote-for" class="w-1/2 h-[400px] bg-white shadow-xl rounded-xl px-6 py-4 flex flex-col">
                    <h3 class="text-center text-5xl font-extrabold">Vote For 👩‍💻</h3>
                    <label for="nominee" class="text-xs mb-0.5">Choose Employee*</label>
                    <select name="nominee" id="nominee" size="1" class="px-1 py-2 rounded-lg shadow-sm mb-4 border-2">
                        <option value="">Alice Burton - Software Engineer</option>
                        <option value="">John Doe - QA Tester</option>
                        <option value="">Jack Smith - Python Developer</option>
                        <option value="">Bob Willson - Software Engineer</option>
                    </select>

                    <label for="category" class="text-xs mb-0.5">Choose Category*</label>
                    <select name="category" id="category" size="1" class="px-1 py-2 rounded-lg shadow-sm border-2">
                        <option value="">Category 1</option>
                        <option value="">Category 2</option>
                        <option value="">Category 3</option>
                        <option value="">Category 4</option>

                    </select>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="transition-all duration-300 w-32 h-16 bg-blue-500 text-xl text-white font-semibold rounded-md shadow-md hover:bg-blue-600">VOTE!</button>
            </div>
        </form>
    </section>
    <section class="py-5 bg-slate-50">
        <h2 class="text-center text-5xl font-extrabold mb-5">Winners by Category</h2>
        <div id="results-container" class="flex justify-between px-10 mt-2 gap-1">
            <div id="makes-work-fun" class="transition-all duration-200 border bg-white w-1/4 px-1 py-2 h-[150px] rounded-md shadow-md hover:shadow-lg">
                <h3 class="text-center font-light italic text-xl">„Makes Work Fun“</h3>
                <p id="first-place" class="font-semibold">🥇 John Doe - Software Engineer - 5.0</p>
                <p id="second-place">🥈 Alice Burton - QA Tester - 4.7</p>
                <p id="third-place">🥉</p>
                <div class="text-center">
                    <button class="transition-all duration-200 bg-green-400 hover:bg-green-500 px-1 rounded-sm text-white font-medium">Generate Certificate🎓</button>
                </div>
            </div>
            <div id="team-player" class="transition-all duration-200 border bg-white w-1/4 px-1 py-2 h-[150px] rounded-md shadow-md hover:shadow-lg">
                <h3 class="text-center font-light italic text-xl">„Team Player“</h3>
                <p id="first-place" class="font-semibold">🥇</p>
                <p id="second-place">🥈</p>
                <p id="third-place">🥉</p>
                <div class="text-center">
                    <button class="transition-all duration-200 bg-green-400 hover:bg-green-500 px-1 rounded-sm text-white font-medium">Generate Certificate🎓</button>
                </div>
            </div>
            <div id="culture-champion" class="transition-all duration-200 border bg-white w-1/4 px-1 py-2 h-[150px] rounded-md shadow-md hover:shadow-lg">
                <h3 class="text-center font-light italic text-xl">„Culture Champion“</h3>
                <p id="first-place" class="font-semibold">🥇</p>
                <p id="second-place">🥈</p>
                <p id="third-place">🥉</p>
                <div class="text-center">
                    <button class="transition-all duration-200 bg-green-400 hover:bg-green-500 px-1 rounded-sm text-white font-medium">Generate Certificate🎓</button>
                </div>
            </div>
            <div id="difference-maker" class="transition-all duration-200 border bg-white w-1/4 px-1 py-2 h-[150px] rounded-md shadow-md hover:shadow-lg">
                <h3 class="text-center font-light italic text-xl">„Difference Maker“</h3>
                <p id="first-place" class="font-semibold">🥇</p>
                <p id="second-place">🥈</p>
                <p id="third-place">🥉</p>
                <div class="text-center">
                    <button class="transition-all duration-200 bg-green-400 hover:bg-green-500 px-1 rounded-sm text-white font-medium">Generate Certificate🎓</button>
                </div>
            </div>
        </div>
        <div id="top-3-voters-container" class="px-10 mt-4">
            <h3 class="text-center text-3xl font-extrabold mb-4">TOP-3 Voters</h3>
            <div id="top-3-voters" class="flex justify-between gap-10">
                <div class="w-1/3 px-1 py-2 text-center bg-white rounded-md">🥇John</div>
                <div class="w-1/3 px-1 py-2 text-center bg-white rounded-md">🥈Alice</div>
                <div class="w-1/3 px-1 py-2 text-center bg-white rounded-md">🥉Jack</div>
            </div>
        </div>
        <div id="mvp-container" class="mt-14 flex flex-col items-center">
            <h3 class="text-center text-5xl font-extrabold text-yellow-400 mb-6">The All-Time Champion Colleague, The MVP 🏆</h3>
            <div id="mvp" class="blur-0 transition-all duration-200 border text-center py-3 bg-white w-4/6 rounded-xl shadow-md hover:shadow-lg">
                <p class="text-4xl font-bold mb-4">IVAN MITKOVSKI - SOFTWARE ENGINEER - 5.0</p>
                <button class="transition-all duration-200 bg-green-400 hover:bg-green-500 px-1 rounded-sm text-white font-medium">Generate Certificate🏆</button>
            </div>
        </div>
    </section>
</body>

</html>