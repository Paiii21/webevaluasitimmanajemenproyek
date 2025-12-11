<x-mail::message>
# Undangan Bergabung ke Proyek

Halo,

Anda telah diundang untuk bergabung ke proyek **{{ $invitation->project->name }}** oleh {{ $invitation->inviter->name }}.

**Peran yang ditetapkan untuk Anda:** {{ ucfirst($invitation->role) }}

Deskripsi Proyek:
{{ $invitation->project->description ?: 'Tidak ada deskripsi' }}

<x-mail::button :url="route('project-invitations.accept', $invitation->token)">
Terima Undangan
</x-mail::button>

Undangan ini akan kedaluwarsa pada {{ $invitation->expires_at->format('d M Y H:i') }}.

Jika Anda tidak ingin menerima undangan ini, Anda dapat mengabaikan email ini.

Terima kasih,<br>
Tim Sistem Evaluasi Tim
</x-mail::message>