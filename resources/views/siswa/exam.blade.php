<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $exam->nama_ujian }} - SIPANDAI</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #b3262d;
            --primary-dark: #911d24;
            --primary-light: #f9e7e8;
            --text: #252525;
            --text-soft: #444;
            --muted: #777;
            --muted-light: #9a9a9a;
            --border: #e2e2df;
            --border-light: #eeeeeb;
            --white: #ffffff;
            --bg: #faf8f6;
            --green: #22a06b;
            --green-light: #e9f7f0;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            height: 70px;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 45px;
            box-shadow: 0 3px 15px rgba(80, 40, 40, .05);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border-light);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand img {
            width: 34px;
            height: 34px;
            object-fit: contain;
            display: block;
            border: none;
            background: transparent;
            box-shadow: none;
        }

        .logo {
            color: var(--primary);
            font-family: Arial, sans-serif;
            font-weight: 800;
            font-size: 20px;
            letter-spacing: -0.6px;
            line-height: 1;
        }

        .exam-info {
            text-align: right;
        }

        .exam-info strong {
            display: block;
            font-size: 14px;
            color: var(--text);
        }

        .exam-info span {
            color: var(--muted);
            font-size: 12px;
        }

        /* =========================
           CONTAINER
        ========================= */

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 25px 50px;
        }

        /* =========================
           LAYOUT
        ========================= */

        .exam-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 25px;
            align-items: start;
        }

        /* =========================
           KARTU SOAL
        ========================= */

        .question-card-wrapper {
            background: var(--white);
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(80, 40, 40, .05);
            overflow: hidden;
            border: 1px solid var(--border-light);
        }

        .question-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 25px;
            border-bottom: 1px solid var(--border-light);
            flex-wrap: wrap;
            gap: 12px;
        }

        .soal-no {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: bold;
            color: var(--text);
        }

        .soal-no-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 14px;
        }

        .exam-timer-bar {
            display: inline-flex;
            border-radius: 10px;
            overflow: hidden;
        }

        .exam-timer-bar .label {
            background: #e7e5e1;
            color: #5f5a56;
            padding: 9px 16px;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .exam-timer-bar #examTimer {
            background: var(--primary);
            color: white;
            padding: 9px 18px;
            font-size: 14px;
            font-weight: bold;
        }

        .exam-timer-bar #examTimer.low {
            background: #c53030;
        }

        .question-card {
            display: none;
            padding: 30px;
        }

        .question-card.active {
            display: block;
        }

        .question-text {
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 25px;
            color: var(--text);
        }

        /* =========================
           OPTIONS
        ========================= */

        .option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 11px;
            margin-bottom: 11px;
            cursor: pointer;
            transition: .2s;
            background: var(--white);
        }

        .option:hover {
            border-color: var(--primary);
            background: #fffafa;
        }

        .option:has(input:checked) {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .option input {
            width: 17px;
            height: 17px;
            accent-color: var(--primary);
            flex-shrink: 0;
        }

        .option label {
            width: 100%;
            cursor: pointer;
            font-size: 14px;
            line-height: 1.5;
            color: var(--text-soft);
        }

        .option label strong {
            color: var(--primary);
            margin-right: 5px;
        }

        /* =========================
           NAVIGASI SOAL
        ========================= */

        .question-navigation {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            gap: 12px;
        }

        .nav-btn {
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--text);
            padding: 12px 22px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: .15s;
        }

        .nav-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .nav-btn:active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .next-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .next-btn:active {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }

        .nav-btn:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        /* =========================
           KOLOM KANAN
        ========================= */

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .number-panel {
            background: var(--white);
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(80, 40, 40, .06);
            position: sticky;
            top: 95px;
            border: 1px solid var(--border-light);
        }

        .number-panel h3 {
            font-size: 16px;
            margin-bottom: 6px;
            color: var(--text);
        }

        .number-panel p {
            font-size: 12px;
            color: var(--muted-light);
            margin-bottom: 18px;
        }

        .number-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 9px;
        }

        .number-btn {
            height: 42px;
            border: 1px solid var(--border);
            background: #f5f4f1;
            color: #637386;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .number-btn.answered {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }

        .number-btn.active {
            box-shadow: 0 0 0 2px var(--primary) inset;
            border-color: var(--primary);
            color: var(--primary);
        }

        .number-btn:hover {
            transform: translateY(-1px);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* =========================
           LEGEND
        ========================= */

        .legend {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid var(--border-light);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #687789;
            margin-bottom: 8px;
        }

        .legend-box {
            width: 15px;
            height: 15px;
            border-radius: 4px;
            background: #f5f4f1;
            border: 1px solid var(--border);
        }

        .legend-box.green {
            background: var(--green);
            border-color: var(--green);
        }

        /* =========================
           EMPTY
        ========================= */

        .empty {
            background: var(--white);
            border-radius: 18px;
            padding: 40px;
            text-align: center;
            color: var(--muted);
            box-shadow: 0 5px 20px rgba(80, 40, 40, .05);
            border: 1px solid var(--border-light);
        }

        /* =========================
           TAB WARNING
        ========================= */

        .tab-warning {
            display: none;
            position: fixed;
            top: 85px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            background: #fff0f0;
            color: #c53030;
            padding: 14px 22px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .12);
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            border: 1px solid #f2cccc;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .exam-layout {
                grid-template-columns: 1fr;
            }

            .right-column {
                order: -1;
            }

            .number-panel {
                position: static;
            }

            .number-grid {
                grid-template-columns: repeat(8, 1fr);
            }
        }

        @media (max-width: 650px) {

            .navbar {
                padding: 0 20px;
            }

            .brand img {
                width: 30px;
                height: 30px;
            }

            .logo {
                font-size: 18px;
            }

            .exam-info {
                display: none;
            }

            .container {
                margin-top: 20px;
                padding: 0 15px 40px;
            }

            .question-card,
            .question-topbar,
            .number-panel {
                padding: 18px;
            }

            .question-text {
                font-size: 15px;
            }

            .number-grid {
                grid-template-columns: repeat(5, 1fr);
            }

            .question-navigation {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         TAB WARNING
    ========================= -->

    <div id="tabWarning" class="tab-warning">
        Kamu meninggalkan halaman ujian.
        <br>
        Jawaban sedang dikirim...
    </div>

    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="navbar">

        <div class="brand">

            <img
                src="{{ asset('images/logo.jpg') }}"
                alt="Logo SMKN 2"
            >

            <span class="logo">
                SIPANDAI
            </span>

        </div>

        <div class="exam-info">

            <strong>
                {{ $exam->nama_ujian }}
            </strong>

            <span>
                {{ $exam->mata_pelajaran }} • {{ $exam->kelas }}
            </span>

        </div>

    </nav>

    <!-- =========================
         CONTENT
    ========================= -->

    <main class="container">

        <!-- =========================
             LAYOUT UJIAN
        ========================= -->

        <div class="exam-layout">

            <!-- =========================
                 BAGIAN SOAL
            ========================= -->

            <div class="question-area">

                <form
                    action="{{ route('siswa.exam.submit', $exam) }}"
                    method="POST"
                    id="examForm"
                >

                    @csrf

                    @if($exam->questions->count() > 0)

                        <div class="question-card-wrapper">

                            <!-- TOPBAR: SOAL NO. + SISA WAKTU -->

                            <div class="question-topbar">

                                <div class="soal-no">

                                    <span>
                                        SOAL NO.
                                    </span>

                                    <span
                                        class="soal-no-badge"
                                        id="soalNoBadge"
                                    >
                                        1
                                    </span>

                                </div>

                                <div class="exam-timer-bar">

                                    <span class="label">
                                        Sisa Waktu
                                    </span>

                                    <span
                                        id="examTimer"
                                        data-durasi-menit="{{ $exam->durasi }}"
                                    >
                                        00:00:00
                                    </span>

                                </div>

                            </div>

                            @foreach($exam->questions as $index => $question)

                                <div
                                    class="question-card {{ $index === 0 ? 'active' : '' }}"
                                    data-question="{{ $index }}"
                                >

                                    <!-- PERTANYAAN -->

                                    <div class="question-text">
                                        {{ $question->pertanyaan }}
                                    </div>

                                    <!-- PILIHAN A -->

                                    <div class="option">

                                        <input
                                            type="radio"
                                            id="q{{ $question->id }}_a"
                                            name="jawaban[{{ $question->id }}]"
                                            value="A"
                                        >

                                        <label for="q{{ $question->id }}_a">
                                            <strong>A.</strong>
                                            {{ $question->opsi_a }}
                                        </label>

                                    </div>

                                    <!-- PILIHAN B -->

                                    <div class="option">

                                        <input
                                            type="radio"
                                            id="q{{ $question->id }}_b"
                                            name="jawaban[{{ $question->id }}]"
                                            value="B"
                                        >

                                        <label for="q{{ $question->id }}_b">
                                            <strong>B.</strong>
                                            {{ $question->opsi_b }}
                                        </label>

                                    </div>

                                    <!-- PILIHAN C -->

                                    <div class="option">

                                        <input
                                            type="radio"
                                            id="q{{ $question->id }}_c"
                                            name="jawaban[{{ $question->id }}]"
                                            value="C"
                                        >

                                        <label for="q{{ $question->id }}_c">
                                            <strong>C.</strong>
                                            {{ $question->opsi_c }}
                                        </label>

                                    </div>

                                    <!-- PILIHAN D -->

                                    <div class="option">

                                        <input
                                            type="radio"
                                            id="q{{ $question->id }}_d"
                                            name="jawaban[{{ $question->id }}]"
                                            value="D"
                                        >

                                        <label for="q{{ $question->id }}_d">
                                            <strong>D.</strong>
                                            {{ $question->opsi_d }}
                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                        <!-- NAVIGASI -->

                        <div class="question-navigation">

                            <button
                                type="button"
                                class="nav-btn prev-btn"
                                id="prevButton"
                                onclick="previousQuestion()"
                            >
                                Soal Sebelumnya
                            </button>

                            <button
                                type="button"
                                class="nav-btn next-btn"
                                id="nextButton"
                                onclick="handleNextOrSubmit()"
                            >
                                Soal Selanjutnya
                            </button>

                        </div>

                    @else

                        <div class="empty">

                            <h3>
                                Belum Ada Soal
                            </h3>

                            <p style="margin-top: 8px;">
                                Guru belum menambahkan soal
                                ke dalam ujian ini.
                            </p>

                        </div>

                    @endif

                </form>

            </div>

            <!-- =========================
                 KOLOM KANAN
            ========================= -->

            @if($exam->questions->count() > 0)

                <div class="right-column">

                    <div class="number-panel">

                        <h3>
                            Nomor Soal
                        </h3>

                        <p>
                            Pilih nomor untuk berpindah soal
                        </p>

                        <div class="number-grid">

                            @foreach($exam->questions as $index => $question)

                                <button
                                    type="button"
                                    class="number-btn {{ $index === 0 ? 'active' : '' }}"
                                    data-number="{{ $index }}"
                                >
                                    {{ $index + 1 }}
                                </button>

                            @endforeach

                        </div>

                        <!-- KETERANGAN WARNA -->

                        <div class="legend">

                            <div class="legend-item">

                                <div class="legend-box green"></div>

                                Sudah dijawab

                            </div>

                            <div class="legend-item">

                                <div class="legend-box"></div>

                                Belum dijawab

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </main>

    <!-- =========================
         JAVASCRIPT
    ========================= -->

    <script>

        /* =========================
           DATA SOAL
        ========================= */

        let currentQuestion = 0;

        const questions =
            document.querySelectorAll('.question-card');

        const numberButtons =
            document.querySelectorAll('.number-btn');

        const soalNoBadge =
            document.getElementById('soalNoBadge');

        const prevButton =
            document.getElementById('prevButton');

        const nextButton =
            document.getElementById('nextButton');

        const examForm =
            document.getElementById('examForm');

        const tabWarning =
            document.getElementById('tabWarning');

        let sudahSubmit = false;
        let sedangMengirim = false;


        /* =========================
           TAMPILKAN SOAL
        ========================= */

        function showQuestion(index) {

            index = Number(index);

            if (
                index < 0 ||
                index >= questions.length
            ) {
                return;
            }

            currentQuestion = index;

            questions.forEach(function(question, i) {

                if (i === index) {
                    question.classList.add('active');
                } else {
                    question.classList.remove('active');
                }

            });

            numberButtons.forEach(function(button, i) {

                if (i === index) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }

            });

            if (soalNoBadge) {

                soalNoBadge.textContent =
                    String(index + 1);

            }

            updateNavButtons();
        }


        /* =========================
           KLIK NOMOR SOAL
        ========================= */

        numberButtons.forEach(function(button) {

            button.addEventListener(
                'click',
                function() {

                    const index =
                        Number(
                            this.dataset.number
                        );

                    showQuestion(index);

                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });

                }
            );

        });


        /* =========================
           SOAL SEBELUMNYA
        ========================= */

        function previousQuestion() {

            if (currentQuestion > 0) {

                showQuestion(
                    currentQuestion - 1
                );

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

            }

        }


        /* =========================
           SOAL SELANJUTNYA
        ========================= */

        function nextQuestion() {

            if (
                currentQuestion <
                questions.length - 1
            ) {

                showQuestion(
                    currentQuestion + 1
                );

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

            }

        }


        /* =========================
           UPDATE NAVIGASI
        ========================= */

        function updateNavButtons() {

            if (prevButton) {

                prevButton.disabled =
                    currentQuestion === 0;

            }

            if (nextButton) {

                const isLastQuestion =
                    currentQuestion ===
                    questions.length - 1;

                nextButton.textContent =
                    isLastQuestion
                        ? 'Submit'
                        : 'Soal Selanjutnya';

            }

        }


        /* =========================
           TOMBOL NEXT / SUBMIT
        ========================= */

        function handleNextOrSubmit() {

            const isLastQuestion =
                currentQuestion ===
                questions.length - 1;

            if (!isLastQuestion) {

                nextQuestion();

                return;
            }

            if (sudahSubmit) {
                return;
            }

            const yakin =
                confirm(
                    'Yakin ingin mengirim jawaban ujian?\n\n' +
                    'Jawaban tidak dapat diubah setelah dikirim.'
                );

            if (!yakin) {
                return;
            }

            sudahSubmit = true;

            if (nextButton) {

                nextButton.disabled = true;

                nextButton.textContent =
                    'Mengirim Jawaban...';

            }

            if (examForm) {
                examForm.requestSubmit();
            }

        }


        /* =========================
           UPDATE STATUS JAWABAN
        ========================= */

        function updateAnsweredStatus(questionCard) {

            const checked =
                questionCard.querySelector(
                    'input[type="radio"]:checked'
                );

            const index =
                Number(
                    questionCard.dataset.question
                );

            const numberButton =
                document.querySelector(
                    '.number-btn[data-number="' +
                    index +
                    '"]'
                );

            if (!numberButton) {
                return;
            }

            if (checked) {

                numberButton.classList.add(
                    'answered'
                );

            } else {

                numberButton.classList.remove(
                    'answered'
                );

            }

        }


        /* =========================
           KETIKA SISWA MEMILIH JAWABAN
        ========================= */

        const radioButtons =
            document.querySelectorAll(
                '.question-card input[type="radio"]'
            );

        radioButtons.forEach(function(input) {

            input.addEventListener(
                'change',
                function() {

                    const questionCard =
                        this.closest(
                            '.question-card'
                        );

                    updateAnsweredStatus(
                        questionCard
                    );

                }
            );

        });


        /* =========================
           STATUS AWAL
        ========================= */

        questions.forEach(function(question) {

            updateAnsweredStatus(
                question
            );

        });

        updateNavButtons();


        /* =========================
           TIMER UJIAN
        ========================= */

        let sisaDetik = 0;

        const examTimerEl =
            document.getElementById(
                'examTimer'
            );

        if (examTimerEl) {

            const durasiMenit =
                parseInt(
                    examTimerEl.dataset.durasiMenit,
                    10
                ) || 0;

            sisaDetik =
                durasiMenit * 60;

        }


        function tampilkanTimer() {

            if (!examTimerEl) {
                return;
            }

            const jam =
                Math.floor(
                    sisaDetik / 3600
                );

            const menit =
                Math.floor(
                    (sisaDetik % 3600) / 60
                );

            const detik =
                sisaDetik % 60;

            examTimerEl.textContent =
                String(jam).padStart(2, '0') +
                ':' +
                String(menit).padStart(2, '0') +
                ':' +
                String(detik).padStart(2, '0');

            if (sisaDetik <= 60) {

                examTimerEl.classList.add(
                    'low'
                );

            }

        }


        tampilkanTimer();


        const examTimerInterval =
            setInterval(function() {

                if (sudahSubmit) {

                    clearInterval(
                        examTimerInterval
                    );

                    return;
                }

                sisaDetik--;

                if (sisaDetik <= 0) {

                    sisaDetik = 0;

                    tampilkanTimer();

                    clearInterval(
                        examTimerInterval
                    );

                    autoSubmitUjian(
                        'Waktu ujian telah habis.'
                    );

                    return;
                }

                tampilkanTimer();

            }, 1000);


        /* =========================
           AUTO SUBMIT
        ========================= */

        function autoSubmitUjian(alasan) {

            if (
                sudahSubmit ||
                sedangMengirim
            ) {
                return;
            }

            if (!examForm) {
                return;
            }

            sedangMengirim = true;
            sudahSubmit = true;

            if (tabWarning) {

                tabWarning.style.display =
                    'block';

                if (alasan) {

                    tabWarning.innerHTML =
                        alasan +
                        '<br>Jawaban sedang dikirim...';

                }

            }

            if (nextButton) {

                nextButton.disabled =
                    true;

                nextButton.textContent =
                    'Ujian Dikumpulkan...';

            }

            examForm.requestSubmit();

        }


        /* =========================
           SUBMIT MANUAL
        ========================= */

        if (examForm) {

            examForm.addEventListener(
                'submit',
                function() {

                    if (
                        sudahSubmit === false
                    ) {

                        sudahSubmit = true;

                        if (nextButton) {

                            nextButton.disabled =
                                true;

                            nextButton.textContent =
                                'Mengirim Jawaban...';

                        }

                    }

                }
            );

        }


        /* =========================
           DETEKSI PINDAH TAB
        ========================= */

        document.addEventListener(
            'visibilitychange',
            function() {

                if (
                    document.hidden &&
                    !sudahSubmit
                ) {

                    autoSubmitUjian(
                        'Kamu meninggalkan halaman ujian.'
                    );

                }

            }
        );


        /* =========================
           DETEKSI BROWSER BLUR
        ========================= */

        window.addEventListener(
            'blur',
            function() {

                if (
                    !sudahSubmit &&
                    document.visibilityState ===
                    'hidden'
                ) {

                    autoSubmitUjian(
                        'Kamu meninggalkan halaman ujian.'
                    );

                }

            }
        );


        /* =========================
           PAGE HIDE
        ========================= */

        window.addEventListener(
            'pagehide',
            function() {

                if (!sudahSubmit) {

                    autoSubmitUjian(
                        'Halaman ujian ditinggalkan.'
                    );

                }

            }
        );


        /* =========================
           BLOK BACK BROWSER
        ========================= */

        history.pushState(
            null,
            '',
            location.href
        );

        window.addEventListener(
            'popstate',
            function() {

                if (!sudahSubmit) {

                    autoSubmitUjian(
                        'Kamu meninggalkan halaman ujian.'
                    );

                }

            }
        );


        /* =========================
           BEFORE UNLOAD
        ========================= */

        window.addEventListener(
            'beforeunload',
            function(event) {

                if (!sudahSubmit) {

                    event.preventDefault();

                    event.returnValue = '';

                }

            }
        );


        /* =========================
           MULAI DARI SOAL PERTAMA
        ========================= */

        showQuestion(0);

    </script>

</body>

</html>