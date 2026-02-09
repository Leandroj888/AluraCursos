Write-Host "Parando e removendo containers..."
docker compose down

Write-Host "Removendo volume..."
docker volume rm mysql_data 2>$null

Write-Host "Removendo container..."
docker rm mysql-db 2>$null

Write-Host "Subindo ambiente limpo..."
docker compose up -d

