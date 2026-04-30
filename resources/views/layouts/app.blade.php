<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NHM Hridyam Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-hover: #0284c7;
            --accent: #10b981;
            --background-start: #f0f9ff;
            --background-end: #e0f2fe;
            --surface: rgba(255, 255, 255, 0.95);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 16px;
            --shadow: 0 10px 25px -5px rgba(14, 165, 233, 0.1), 0 8px 10px -6px rgba(14, 165, 233, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, var(--background-start) 0%, var(--background-end) 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-attachment: fixed;
        }

        .header {
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            text-align: center;
            margin-bottom: 2rem;
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 1px solid rgba(255,255,255,0.5);
        }

        .header h1 {
            font-size: 1.75rem;
            color: var(--primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .container {
            width: 100%;
            max-width: 650px;
            background: var(--surface);
            backdrop-filter: blur(20px);
            padding: 3rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2.5rem;
            position: relative;
            padding: 0 10px;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 20px;
            right: 20px;
            height: 3px;
            background: #e0f2fe;
            z-index: 1;
            border-radius: 3px;
            transform: translateY(-50%);
        }

        .step {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e0f2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            color: #94a3b8;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .step.active {
            border-color: var(--primary);
            color: white;
            background: var(--primary);
            box-shadow: 0 0 0 6px rgba(14, 165, 233, 0.2);
            transform: scale(1.1);
        }

        .step.completed {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }
        
        .step.completed::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.8rem;
        }
        .step.completed {
            font-size: 0; /* hides the number when completed */
        }

        h2 {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        h2 i {
            color: var(--primary);
            background: #e0f2fe;
            padding: 0.5rem;
            border-radius: 10px;
            font-size: 1.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        input[type="file"],
        select, textarea {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            outline: none;
            background: #f8fafc;
            color: var(--text-main);
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
        }

        input[type="radio"], input[type="checkbox"] {
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .alert-error {
            background: #fef2f2;
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }

        .token-info {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: #0369a1;
            padding: 1.25rem;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-top: 2rem;
            text-align: center;
            border: 1px dashed #7dd3fc;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .token-info strong {
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: var(--primary);
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            display: inline-block;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <header class="header">
        <h1><i class="fa-solid fa-heart-pulse"></i> NHM Hridyam</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem; font-weight: 500; margin-top: 0.25rem;">Congenital Heart Disease (CHD) Care Registration</p>
    </header>

    <main class="container">
        @yield('content')
    </main>
    
    <script>
        // Optional script to inject FontAwesome icons into headers dynamically based on content
        document.addEventListener("DOMContentLoaded", () => {
            const h2 = document.querySelector('h2');
            if(h2 && !h2.querySelector('i')) {
                const text = h2.innerText.toLowerCase();
                let iconClass = 'fa-pen-to-square';
                if(text.includes('basic')) iconClass = 'fa-user';
                if(text.includes('residential')) iconClass = 'fa-house';
                if(text.includes('socio')) iconClass = 'fa-users';
                if(text.includes('medical')) iconClass = 'fa-stethoscope';
                if(text.includes('clinical')) iconClass = 'fa-heart-crack';
                if(text.includes('diagnosis')) iconClass = 'fa-file-medical';
                if(text.includes('successful')) iconClass = 'fa-circle-check';
                
                h2.innerHTML = `<i class="fa-solid ${iconClass}"></i> ` + h2.innerHTML;
            }

            const btn = document.querySelector('form > button.btn[type="submit"]');
            if(btn && !btn.querySelector('i') && btn.innerText.includes('Next')) {
                btn.innerHTML += ` <i class="fa-solid fa-arrow-right"></i>`;
            }
        });
    </script>
</body>
</html>
