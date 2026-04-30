@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="margin-bottom: 0.25rem;"><i class="fa-solid fa-chart-line"></i> DEIC Dashboard</h2>
        <p style="color: var(--text-muted); font-size: 0.875rem;">District: <strong>{{ Auth::user()->district }}</strong></p>
    </div>
    <form action="{{ route('deic.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn" style="background: var(--text-muted); width: auto; font-size: 0.875rem; padding: 0.5rem 1rem;">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </button>
    </form>
</div>

<div style="background: white; border-radius: var(--radius); border: 1px solid var(--border); overflow: hidden; box-shadow: var(--shadow);">
    <div style="padding: 1.5rem; border-bottom: 1px solid var(--border); background: #f8fafc; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-main);">Recent Registrations</h3>
        <span style="background: var(--primary); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">{{ $registrations->count() }} Total</span>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; background: #f1f5f9;">
                    <th style="padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted);">Token</th>
                    <th style="padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted);">Patient Name</th>
                    <th style="padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted);">DOB</th>
                    <th style="padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted);">Status</th>
                    <th style="padding: 1rem; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted);">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $reg)
                <tr style="border-bottom: 1px solid var(--border);">
                    <td style="padding: 1rem; font-weight: 600; color: var(--primary);">{{ $reg->token }}</td>
                    <td style="padding: 1rem;">{{ $reg->patient_name }}</td>
                    <td style="padding: 1rem;">{{ \Carbon\Carbon::parse($reg->dob)->format('d-m-Y') }}</td>
                    <td style="padding: 1rem;">
                        <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">
                            {{ $reg->status }}
                        </span>
                    </td>
                    <td style="padding: 1rem;">
                        <a href="{{ route('deic.profile', $reg->id) }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.875rem; display: flex; align-items: center; gap: 0.25rem;">
                            View Profile <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                        <i class="fa-solid fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 1rem; opacity: 0.5;"></i>
                        No registrations found for this district.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
