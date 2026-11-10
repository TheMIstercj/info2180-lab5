# Download the official dataset used in INFO2180 Lab 5.
$source = 'https://raw.githubusercontent.com/uwi-info2180/info2180-lab5/master/world.sql'
$destination = Join-Path $PSScriptRoot 'world.sql'
Invoke-WebRequest -Uri $source -OutFile $destination -ErrorAction Stop
if ((Get-Item $destination).Length -lt 100000) {
    throw 'Download appears incomplete. Download world.sql manually from the official source.'
}
Write-Host "Saved world.sql to $destination"
