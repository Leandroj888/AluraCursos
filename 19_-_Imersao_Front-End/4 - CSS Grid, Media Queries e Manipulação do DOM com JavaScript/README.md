# Links

# Anotações
- CDN (Servidores geograficamente distribuídos com copias dos arquivos)
- DOM (Documnet Object Model - representação em arvore do html )
- 
## criar tabela sem tabel
```css
.class {
    display: grid; /* Monta uma tabela de acordo com o espaço*/
    justify-items: center;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr; /* 1fr representa 1 colouna nesse caso são 5*/
    grid-gap: 16px; /*modo antigo de definir espaçamento entre frações*/
    gap: 16px; /*modo novo de definir espaçamento entre frações*/
    margin-bottom: 16px; 
}
```

## Mocar apis back
- json server
    - npm i json-server -g '-g é para global' (caso n trouxer resultados digite npm install -g json-server@0.17.4 )
    - criar arquivo json com todo o formato do retorno
    - json-server --watch api-artists/artists.json --port 3000 'executa na porta 3000 a api artists retornando o arquivo'