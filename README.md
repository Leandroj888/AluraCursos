# Git comandos

## Clonar o diretório

```bash
git clone git@github.com:Leandroj888/AluraCursos.git
```

## Atualizar arquivos

```bash
git pull
```

## Adicionar modificações

```bash
git add .
```

## Comitar modificações

```bash
git commit -m "Envy-2023-01-13-01"
git commit -m "Pavilion-2023-01-13-01"
```

## Enviar modificações

```bash
git push
```

# SSH

## Criar chave
ssh-keygen -t ed25519 -C "email@servido.com.br"

## Pegar key
cat ~/.ssh/id_ed25519.pub

## Adicionar ssh
https://github.com/settings/keys -> new ssh key

## Testar conexão
ssh -T git@github.com


# Usuario Git
git config --global user.name "Your Name"
git config --global user.email "youremail@yourdomain.com"