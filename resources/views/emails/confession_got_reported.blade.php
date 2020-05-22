@component('mail::message')
# Confession Got Reported

One of the user from the website reported particular confession saying:<br>
{{ $reportedConfession->body }}

@component('mail::button', ['url' => ''])
View Confession
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
