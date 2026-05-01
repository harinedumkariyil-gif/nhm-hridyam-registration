<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile | NHM Hridyam</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --sidebar-bg: #1e293b;
            --bg-light: #f1f5f9;
            --card-bg: #ffffff;
            --text-main: #334155;
            --text-muted: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --border: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Outfit', sans-serif; background: var(--bg-light); color: var(--text-main); display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 260px; background: var(--sidebar-bg); color: white; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-header { padding: 2rem; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-menu { padding: 1rem 0; flex-grow: 1; overflow-y: auto; }
        .menu-item { padding: 0.75rem 1.5rem; display: flex; align-items: center; gap: 0.75rem; color: #94a3b8; text-decoration: none; font-size: 0.9rem; transition: all 0.2s; }
        .menu-item:hover, .menu-item.active { background: rgba(255,255,255,0.05); color: white; }
        .menu-item i { width: 20px; text-align: center; }

        /* Main Content */
        .main { flex-grow: 1; display: flex; flex-direction: column; overflow-x: hidden; }
        .top-bar { height: 60px; background: white; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; position: sticky; top: 0; z-index: 100; }
        .search-box { background: #f8fafc; border: 1px solid var(--border); padding: 0.5rem 1rem; border-radius: 8px; display: flex; align-items: center; gap: 0.5rem; width: 400px; }
        .search-box input { border: none; background: transparent; outline: none; width: 100%; font-size: 0.875rem; }

        .content-area { padding: 1.5rem 2rem; }
        .breadcrumb { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.5rem; }
        .action-buttons { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .btn-action { padding: 0.5rem 1rem; background: white; border: 1px solid var(--border); border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; color: var(--text-main); transition: all 0.2s; }
        .btn-action:hover { background: #f8fafc; border-color: var(--primary); color: var(--primary); }

        /* Dashboard Grid */
        .dashboard-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; }
        .card { background: white; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 1.5rem; }
        .card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); font-weight: 700; font-size: 0.95rem; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }

        /* Patient Info Section */
        .patient-info { display: flex; padding: 1.5rem; gap: 1.5rem; }
        .patient-photo { width: 120px; height: 140px; background: #f1f5f9; border-radius: 8px; border: 1px solid var(--border); object-fit: cover; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem 2rem; flex-grow: 1; }
        .info-item label { display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600; margin-bottom: 0.1rem; }
        .info-item div { font-size: 0.9rem; font-weight: 600; }

        .status-badge { background: #dcfce7; color: #166534; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.7rem; font-weight: 700; }
        
        /* Timer Card */
        .timer-box { background: #fef2f2; border: 1px solid #fee2e2; padding: 1.5rem; border-radius: 12px; text-align: center; margin-top: 1rem; }
        .timer-box h4 { font-size: 0.75rem; color: var(--danger); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 1px; }
        .timer-display { font-size: 1.5rem; font-weight: 800; color: var(--danger); font-family: monospace; }

        /* Donut Progress */
        .progress-card { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; height: 100%; }
        .donut { width: 150px; height: 150px; border-radius: 50%; background: conic-gradient(var(--primary) 0% 25%, var(--success) 25% 50%, #f59e0b 50% 75%, #ef4444 75% 100%); position: relative; }
        .donut::after { content: '85%'; position: absolute; width: 100px; height: 100px; background: white; border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%, -50%); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; }

        /* Table Styling */
        .data-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
        .data-table th, .data-table td { padding: 0.75rem 1.5rem; text-align: left; border-bottom: 1px solid var(--border); }
        .data-table th { background: #f8fafc; color: var(--text-muted); font-weight: 600; }

        /* Document list */
        .doc-item { display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1.5rem; font-size: 0.85rem; color: var(--primary); text-decoration: none; }
        .doc-item:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2 style="color: white; font-size: 1.25rem;"><i class="fa-solid fa-heart-pulse"></i> NHM Hridyam</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('pediatrician.dashboard') }}" class="menu-item"><i class="fa-solid fa-home"></i> Home</a>
            <a href="#" class="menu-item active"><i class="fa-solid fa-user-doctor"></i> Evaluated Cases</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-clipboard-check"></i> Expert Opinions</a>
        </nav>
        <div style="padding: 1rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.7rem; color: #64748b; text-align: center;">
            © 2026 Kerala Health Services
        </div>
    </aside>

    <main class="main">
        <header class="top-bar">
            <div class="search-box">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Search Case No or Name...">
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="text-align: right;">
                    <div style="font-size: 0.85rem; font-weight: 700;">Welcome, {{ Auth::user()->name }}</div>
                    <div style="font-size: 0.7rem; color: var(--text-muted);">{{ Auth::user()->district }} Pediatrician</div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="content-area">
            <div class="breadcrumb">Home > Profile > {{ $registration->patient_name }}</div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h1 style="font-size: 1.5rem;">Patient Profile</h1>
                <div class="action-buttons">
                    <button class="btn-action"><i class="fa-solid fa-print"></i> Print Case</button>
                    @if($registration->status == 'Forwarded to Pediatrician')
                    <form action="{{ route('pediatrician.markOpinion', $registration->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="opinion" value="1">
                        <button type="submit" class="btn-action" style="background: var(--primary); color: white; border-color: var(--primary);"><i class="fa-solid fa-stethoscope"></i> Request Expert Opinion</button>
                    </form>
                    <form action="{{ route('pediatrician.markOpinion', $registration->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="opinion" value="0">
                        <button type="submit" class="btn-action" style="background: var(--success); color: white; border-color: var(--success);"><i class="fa-solid fa-check"></i> No Opinion Required</button>
                    </form>
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 600;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="dashboard-grid">
                <!-- Column 1 -->
                <div class="left-col">
                    <div class="card">
                        <div class="card-header"><i class="fa-solid fa-user-nurse"></i> Patient Information</div>
                        <div class="patient-info">
                            <div class="patient-photo" style="display: flex; align-items: center; justify-content: center; font-size: 3.5rem; color: #94a3b8; background: #e2e8f0;">
                                <i class="fa-solid fa-baby"></i>
                            </div>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Case ID</label>
                                    <div>{{ $registration->case_id ?? 'Not Assigned' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Status</label>
                                    <div><span class="status-badge">{{ $registration->status }}</span></div>
                                </div>
                                <div class="info-item">
                                    <label>Full Name</label>
                                    <div>{{ $registration->patient_name }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Gender</label>
                                    <div>{{ $registration->gender }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Date of Birth</label>
                                    <div>{{ \Carbon\Carbon::parse($registration->dob)->format('d-m-Y') }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Contact</label>
                                    <div>{{ $registration->mobile }}</div>
                                </div>
                                <div class="info-item" style="grid-column: span 2;">
                                    <label>Address</label>
                                    <div>{{ $registration->address_line_1 }}, {{ $registration->address_line_2 }}, {{ $registration->address_line_3 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><i class="fa-solid fa-people-roof"></i> Family & Demographics</div>
                        <div style="padding: 1.5rem;">
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Father's Name</label>
                                    <div>{{ $registration->father_name ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Mother's Name</label>
                                    <div>{{ $registration->mother_name ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>RCH ID</label>
                                    <div>{{ $registration->rch_id ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Email</label>
                                    <div>{{ $registration->email ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Living In</label>
                                    <div>{{ $registration->living_in ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Economic Status</label>
                                    <div>{{ $registration->bpl_apl ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Religion/Caste</label>
                                    <div>{{ $registration->caste ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><i class="fa-solid fa-baby"></i> Birth History</div>
                        <div style="padding: 1.5rem;">
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Birth Weight</label>
                                    <div>{{ $registration->birth_weight ?? 'N/A' }} kg</div>
                                </div>
                                <div class="info-item">
                                    <label>Delivery Type</label>
                                    <div>{{ $registration->delivery_type ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Antenatal Diagnosis</label>
                                    <div>{{ $registration->antenatal_diagnosis ? 'Yes' : 'No' }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Consanguinity</label>
                                    <div>{{ $registration->consanguinity ? 'Yes' : 'No' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><i class="fa-solid fa-heart-circle-check"></i> Present Clinical Status</div>
                        <table class="data-table">
                            <tr><th>Parameter</th><th>Value</th><th>Status</th></tr>
                            <tr><td>Baby Color</td><td>{{ $registration->baby_color }}</td><td>Normal</td></tr>
                            <tr><td>Heart Rate</td><td>{{ $registration->heart_rate }} BPM</td><td><i class="fa-solid fa-circle-check text-success"></i></td></tr>
                            <tr><td>SpO2 (Room Air)</td><td>{{ $registration->spo2 }}%</td><td><i class="fa-solid fa-circle-check text-success"></i></td></tr>
                            <tr><td>Liver</td><td>{{ $registration->liver }}</td><td>Normal</td></tr>
                            <tr><td>Femoral Pulse</td><td>{{ $registration->femoral_pulse }}</td><td>Normal</td></tr>
                        </table>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="right-col">
                    <div class="card" style="padding-bottom: 1rem;">
                        <div class="card-header"><i class="fa-solid fa-chart-pie"></i> Registration Progress</div>
                        <div class="progress-card">
                            <div class="donut"></div>
                            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 1rem; text-align: center;">Verified by DEIC Staff on {{ now()->format('d M') }}</p>
                        </div>
                    </div>

                    <div class="timer-box">
                        <h4>Time Left for Intervention</h4>
                        <div class="timer-display" id="countdown">119d : 11h : 29m : 15s</div>
                    </div>

                    <div class="card" style="margin-top: 1.5rem;">
                        <div class="card-header"><i class="fa-solid fa-file-pdf"></i> Documents Attached</div>
                        <div style="padding-bottom: 1rem;">
                            @if($registration->medical_report_path)
                                <a href="#" class="doc-item"><i class="fa-solid fa-file-pdf"></i> Medical_Report.pdf</a>
                            @endif
                            @if($registration->aadhaar_path)
                                <a href="#" class="doc-item"><i class="fa-solid fa-file-image"></i> Aadhaar_Card.jpg</a>
                            @endif
                            <a href="#" class="doc-item"><i class="fa-solid fa-file-pdf"></i> Referral_Letter.pdf</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><i class="fa-solid fa-user-doctor"></i> Expert Opinion</div>
                        <div style="padding: 1rem 1.5rem;">
                            <label style="font-size: 0.7rem; color: var(--text-muted); font-weight: 700;">HIGHEST SUGGESTED CATEGORY</label>
                            <div style="background: #eff6ff; color: #1d4ed8; padding: 0.5rem; border-radius: 6px; font-weight: 800; text-align: center; margin-top: 0.5rem; border: 1px solid #bfdbfe;">
                                CATEGORY II
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Simple mock countdown
        let seconds = 119 * 24 * 3600 + 11 * 3600 + 29 * 60 + 15;
        setInterval(() => {
            seconds--;
            let d = Math.floor(seconds / (24 * 3600));
            let h = Math.floor((seconds % (24 * 3600)) / 3600);
            let m = Math.floor((seconds % 3600) / 60);
            let s = seconds % 60;
            document.getElementById('countdown').innerText = `${d}d : ${h}h : ${m}m : ${s}s`;
        }, 1000);
    </script>
</body>
</html>
