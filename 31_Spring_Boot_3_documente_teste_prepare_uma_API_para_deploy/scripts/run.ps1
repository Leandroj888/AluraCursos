$requiredMajor = 23

$javaVersionOutput = & java -version 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Error "Java não encontrado no PATH."
    exit 1
}

$versionLine = $javaVersionOutput | Select-Object -First 1

if ($versionLine -notmatch '"(\d+)\.') {
    Write-Error "Não foi possível identificar a versão do Java."
    exit 1
}

$installedMajor = [int]$matches[1]

if ($installedMajor -ne $requiredMajor) {
    Write-Error "Java $requiredMajor é obrigatório. Versão atual: $installedMajor."
    exit 1
}

Write-Host "Java $installedMajor validado com sucesso."

Set-Location ".\api"

if (-not (Test-Path "mvnw.cmd")) {
    Write-Error "mvnw.cmd não encontrado na pasta api."
    exit 1
}

.\mvnw.cmd spring-boot:run