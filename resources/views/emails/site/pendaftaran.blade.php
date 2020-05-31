@component('mail::message')
# Introduction

@if($terima == 1)
    Selamat Anda Diterima Magang di PT. Garuda Cyber Indonesia <br>
    Silahkan datang ke kantor pada hari pertama magang.
@else
    Mohon Maaf Anda Ditolak
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
